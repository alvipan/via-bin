<?php

namespace App\Http\Controllers\Member;

use App\Services\MemberAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LogoutController
{
    public function __invoke(
        Request $request,
        MemberAuthService $memberAuthService,
    ): RedirectResponse {
        $memberAuthService->logout($request);

        return redirect()->route('member.login');
    }
}