<?php

use App\Services\MemberAuthService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public string $tenantCode = '';
    public string $memberCode = '';

    public function mount(): void
    {
        if (Auth::guard('member')->check()) {
            $this->redirectRoute('member.dashboard');
        }
    }

    public function login(MemberAuthService $auth): mixed
    {
        $this->validate([
            'tenantCode' => ['required'],
            'memberCode' => ['required'],
        ]);

        try {
            $auth->login(
                $this->tenantCode,
                $this->memberCode,
            );

            return $this->redirectRoute('member.dashboard');

        } catch (RuntimeException $e) {
            $this->addError('memberCode', $e->getMessage());
        }
    }

    public function render()
    {
        return $this->view()->layout('layouts::member.auth');
    }
};