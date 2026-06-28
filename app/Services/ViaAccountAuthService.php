<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaAccountAuthService
{
    public function authorizationUrl(): string
    {
        $config = config('services.viaaccount');
        $state = bin2hex(random_bytes(16));

        // store state in session for later validation
        session()->put('viaaccount_oauth_state', $state);

        $query = http_build_query([
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect'],
            'response_type' => 'code',
            'scope' => 'profile email',
            'state' => $state,
        ]);

        return rtrim($config['authorization_endpoint'], '/') . '?' . $query;
    }

    public function exchangeAuthorizationCode(string $code): array
    {
        $config = config('services.viaaccount');

        $payload = [
            'grant_type' => 'authorization_code',
            'client_id' => $config['client_id'],
            'client_secret' => $config['client_secret'],
            'redirect_uri' => $config['redirect'],
            'code' => $code,
        ];

        // First try: client credentials in body (some providers accept this)
        $response = Http::asForm()->post($config['token_endpoint'], $payload);

        // If provider rejects client authentication, try HTTP Basic auth as fallback
        if (! $response->successful()) {
            $body = $response->body();
            logger()->warning('ViaAccount token endpoint first attempt failed', ['status' => $response->status(), 'body' => $body]);

            // Try Basic auth (Authorization: Basic base64(client_id:client_secret))
            $responseBasic = Http::withBasicAuth($config['client_id'], $config['client_secret'])
                ->asForm()
                ->post($config['token_endpoint'], [
                    'grant_type' => 'authorization_code',
                    'redirect_uri' => $config['redirect'],
                    'code' => $code,
                ]);

            if ($responseBasic->successful()) {
                return $responseBasic->json();
            }

            logger()->warning('ViaAccount token endpoint basic auth attempt failed', ['status' => $responseBasic->status(), 'body' => $responseBasic->body()]);

            return [];
        }

        return $response->json();
    }

    public function fetchUserProfile(string $accessToken): array
    {
        $config = config('services.viaaccount');

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->get($config['user_endpoint']);

        return $response->successful() ? $response->json() : [];
    }
}
