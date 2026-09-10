<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ViaAccountAuthService
{
    public function authorizationUrl(): string
    {
        $config = config('services.viaaccount');

        $state = bin2hex(random_bytes(16));

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

        $response = Http::asForm()
            ->acceptJson()
            ->post($config['token_endpoint'], [
                'grant_type' => 'authorization_code',
                'client_id' => $config['client_id'],
                'client_secret' => $config['client_secret'],
                'redirect_uri' => $config['redirect'],
                'code' => $code,
            ]);

        if (! $response->successful()) {
            Log::error('ViaAccount token endpoint failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        }

        return $response->json() ?? [];
    }

    public function fetchUserProfile(string $accessToken): array
    {
        $config = config('services.viaaccount');

        $response = Http::withToken($accessToken)
            ->acceptJson()
            ->get($config['user_endpoint']);

        if (! $response->successful()) {
            Log::error('ViaAccount user endpoint failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return [];
        }

        return $response->json() ?? [];
    }
}
