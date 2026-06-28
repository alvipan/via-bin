<?php

use App\Enums\TenantModule;
use App\Enums\DepositStatus;
use App\Enums\LotStatus;
use App\Enums\SaleStatus;
use App\Enums\WithdrawalStatus;
use App\Models\Deposit;
use App\Models\Lot;
use App\Models\Member;
use App\Models\MemberLedger;
use App\Models\Sale;
use App\Models\TenantLedger;
use App\Models\Withdrawal;
use App\Models\Concerns\AuthorizesTenant;
use Livewire\Component;

new class extends Component
{
    use AuthorizesTenant;

    public function mount()
    {
        $this->authorizeModule(TenantModule::Dashboard);
    }

    public function render()
    {
        $today = today();

        /*
        |--------------------------------------------------------------------------
        | KPI
        |--------------------------------------------------------------------------
        */

        $totalMembers = Member::count();

        $totalMemberBalance = MemberLedger::query()
            ->orderByDesc('id')
            ->get()
            ->unique('member_id')
            ->sum('balance');

        $openLots = Lot::query()
            ->where('status', LotStatus::Open)
            ->count();

        $activeStock = Lot::query()
            ->where('status', LotStatus::Open)
            ->sum('quantity_remaining');

        $tenantBalance = TenantLedger::query()
            ->latest('id')
            ->value('balance') ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Today
        |--------------------------------------------------------------------------
        */

        $todayDeposits = Deposit::query()
            ->where('status', DepositStatus::Posted)
            ->whereDate('posted_at', $today)
            ->count();

        $todaySales = Sale::query()
            ->where('status', SaleStatus::Posted)
            ->whereDate('posted_at', $today)
            ->count();

        $todayWithdrawals = Withdrawal::query()
            ->where('status', WithdrawalStatus::Posted)
            ->whereDate('posted_at', $today)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Latest Activities
        |--------------------------------------------------------------------------
        */

        $latestDeposits = Deposit::query()
            ->with('member')
            ->latest()
            ->take(5)
            ->get();

        $latestLots = Lot::query()
            ->with([
                'member',
                'depositItem.wasteType',
            ])
            ->latest()
            ->take(5)
            ->get();

        $latestSales = Sale::query()
            ->latest()
            ->take(5)
            ->get();

        $latestWithdrawals = Withdrawal::query()
            ->with('member')
            ->latest()
            ->take(5)
            ->get();

        return $this->view(compact(
            'totalMembers',
            'totalMemberBalance',
            'openLots',
            'activeStock',
            'tenantBalance',

            'todayDeposits',
            'todaySales',
            'todayWithdrawals',

            'latestDeposits',
            'latestLots',
            'latestSales',
            'latestWithdrawals',
        ));
    }
};