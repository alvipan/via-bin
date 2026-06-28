<?php

namespace App\Services;

use App\Models\Lot;
use App\Models\Member;
use App\Models\MemberLedger;

class MemberDashboardService
{
    public function summary(Member $member): array
    {
        $lots = Lot::query()
            ->with('depositItem.wasteType')
            ->member($member)
            ->open()
            ->get();

        return [
            'balance' => MemberLedger::query()
                ->where('member_id', $member->id)
                ->latest('id')
                ->value('balance') ?? 0,

            'active_lot_count' => $lots->count(),

            'estimated_income' => $lots->sum->estimated_income,

            'active_lots' => $lots,
        ];
    }
}