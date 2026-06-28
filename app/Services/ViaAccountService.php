<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ViaAccountService
{
    protected array $config;

    public function __construct()
    {
        $this->config = config('services.viaaccount');
    }

    /*
    |--------------------------------------------------------------------------
    | OAuth
    |--------------------------------------------------------------------------
    */

    public function authorizationUrl(): string
    {
        $state = bin2hex(random_bytes(16));

        session()->put('viaaccount_oauth_state', $state);

        return $this->config['authorization_endpoint'].'?'.http_build_query([
            'client_id'     => $this->config['client_id'],
            'redirect_uri'  => $this->config['redirect'],
            'response_type' => 'code',
            'scope'         => 'profile email',
            'state'         => $state,
        ]);
    }

    public function validateState(?string $state): bool
    {
        return hash_equals(
            session()->pull('viaaccount_oauth_state', ''),
            $state ?? '',
        );
    }

    /**
     * @throws RequestException
     */
    public function exchangeAuthorizationCode(string $code): array
    {
        return $this->oauthRequest([
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'redirect_uri'  => $this->config['redirect'],
            'code'          => $code,
        ]);
    }

    /**
     * @throws RequestException
     */
    public function refreshAccessToken(string $refreshToken): array
    {
        return $this->oauthRequest([
            'grant_type'    => 'refresh_token',
            'client_id'     => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'refresh_token' => $refreshToken,
        ]);
    }

    /**
     * @throws RequestException
     */
    public function revokeToken(string $accessToken): bool
    {
        if (blank($this->config['revoke_endpoint'])) {
            return false;
        }

        $this->client()
            ->withToken($accessToken)
            ->post($this->config['revoke_endpoint'])
            ->throw();

        return true;
    }

    /**
     * @throws RequestException
     */
    public function fetchUserProfile(string $accessToken): array
    {
        return $this->request(
            'GET',
            $this->config['user_endpoint'],
            accessToken: $accessToken,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Internal API
    |--------------------------------------------------------------------------
    */

    /**
     * @throws RequestException
     */
    public function findUserByEmail(string $email): ?array
    {
        $response = $this->request(
            'GET',
            $this->config['users_endpoint'],
            [
                'email' => $email,
            ],
            $this->accessToken(),
        );

        return $response['data'] ?? null;
}

    /*
    |--------------------------------------------------------------------------
    | HTTP
    |--------------------------------------------------------------------------
    */

    /**
     * @throws RequestException
     */
    public function request(
        string $method,
        string $url,
        array $data = [],
        ?string $accessToken = null,
    ): array {
        $request = $this->client();

        if ($accessToken) {
            $request->withToken($accessToken);
        }

        return $request
            ->send($method, $url, [
                'query' => strtoupper($method) === 'GET' ? $data : [],
                'json'  => strtoupper($method) !== 'GET' ? $data : [],
            ])
            ->throw()
            ->json();
    }

    /**
     * @throws RequestException
     */
    protected function oauthRequest(array $payload): array
    {
        $response = Http::asForm()
            ->acceptJson()
            ->post($this->config['token_endpoint'], $payload);

        if ($response->successful()) {
            return $response->json();
        }

        return Http::withBasicAuth(
                $this->config['client_id'],
                $this->config['client_secret'],
            )
            ->asForm()
            ->acceptJson()
            ->post($this->config['token_endpoint'], [
                'grant_type'    => $payload['grant_type'],
                'redirect_uri'  => $payload['redirect_uri'] ?? null,
                'code'          => $payload['code'] ?? null,
                'refresh_token' => $payload['refresh_token'] ?? null,
            ])
            ->throw()
            ->json();
    }

    protected function accessToken(): ?string
    {
        return session('viaaccount_access_token');
    }

    protected function client(): PendingRequest
    {
        return Http::acceptJson();
    }
}