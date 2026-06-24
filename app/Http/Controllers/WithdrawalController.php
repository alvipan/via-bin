<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Services\WithdrawalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class WithdrawalController
{
    public function approve(Withdrawal $withdrawal, WithdrawalService $service): RedirectResponse
    {
        $service->approve($withdrawal, Auth::id());

        return redirect()->route('withdrawals.show', $withdrawal);
    }
}
