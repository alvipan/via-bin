<?php

namespace App\Services;

use App\Models\Member;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RuntimeException;

class MemberAuthService
{
    public function login(
        string $tenantCode,
        string $memberCode,
    ): Member {
        $tenant = Tenant::query()
            ->where('tenant_code', strtoupper($tenantCode))
            ->first();

        if (! $tenant) {
            throw new RuntimeException('Kode tenant tidak ditemukan.');
        }

        $member = Member::query()
            ->where('tenant_id', $tenant->id)
            ->where('member_code', strtoupper($memberCode))
            ->first();

        if (! $member) {
            throw new RuntimeException('Kode member tidak ditemukan.');
        }

        Auth::guard('member')->login($member);

        return $member;
    }

    public function logout(Request $request): void
    {
        Auth::guard('member')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}