<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ViaAccountAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController
{
    public function __construct(
        private readonly ViaAccountAuthService $authService,
    ) {}

    public function redirectToViaAccount(): RedirectResponse
    {
        return redirect()->away(
            $this->authService->authorizationUrl()
        );
    }

    public function handleCallback(Request $request): RedirectResponse
    {
        $request->validate([
            'code' => ['required', 'string'],
            'state' => ['nullable', 'string'],
        ]);

        if (! $this->validateState($request)) {
            return redirect()->route('auth.redirect');
        }

        $tokenResponse = $this->authService->exchangeAuthorizationCode(
            $request->input('code')
        );

        if (! isset($tokenResponse['access_token'])) {
            Log::error('ViaAccount callback missing access token', [
                'response' => $tokenResponse,
            ]);

            abort(500, 'OAuth token exchange failed.');
        }

        session([
            'viaaccount_access_token' => $tokenResponse['access_token'],
            'viaaccount_refresh_token' => $tokenResponse['refresh_token'] ?? null,
            'viaaccount_expires_at' => now()->addSeconds(
                $tokenResponse['expires_in'] ?? 3600
            ),
        ]);

        $profile = $this->authService->fetchUserProfile(
            $tokenResponse['access_token']
        );

        if (! isset($profile['id'], $profile['email'], $profile['name'])) {
            Log::error('ViaAccount profile invalid', [
                'profile' => $profile,
            ]);

            return redirect()->route('auth.redirect');
        }

        $user = $this->resolveUser($profile);

        Auth::login($user);

        if ($user->tenants()->exists()) {
            return redirect()->intended(route('dashboard'));
        }

        return redirect()->route('onboarding');
    }

    private function validateState(Request $request): bool
    {
        $state = $request->input('state');
        $expected = session()->pull('viaaccount_oauth_state');

        if ($expected && $state !== $expected) {
            Log::warning('ViaAccount OAuth state mismatch', [
                'expected' => $expected,
                'received' => $state,
            ]);

            return false;
        }

        return true;
    }

    private function resolveUser(array $profile): User
    {
        $user = User::where('via_account_id', $profile['id'])->first();

        if (! $user) {
            $user = User::where('email', $profile['email'])->first();
        }

        if ($user) {
            $user->update([
                'via_account_id' => $profile['id'],
                'name' => $profile['name'],
                'email' => $profile['email'],
            ]);

            return $user;
        }

        return User::create([
            'via_account_id' => $profile['id'],
            'name' => $profile['name'],
            'email' => $profile['email'],
        ]);
    }
}
