<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\Unit;
use App\Models\User;
use App\Models\WasteCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleTenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = Tenant::updateOrCreate(
            ['slug' => 'viabin-demo'],
            [
                'name' => 'ViaBin Demo',
                'status' => 'active',
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@viabin.test'],
            [
                'name' => 'ViaBin Admin',
                'password' => Hash::make('password'),
            ]
        );

        $tenant->users()->syncWithoutDetaching([
            $admin->id => [
                'role' => 'owner',
                'status' => 'active',
            ],
        ]);

        $kg = Unit::where('symbol', 'kg')->first();

        if ($kg) {
            WasteCategory::withoutGlobalScopes()->updateOrCreate(
                [
                    'tenant_id' => $tenant->id,
                    'code' => 'PLASTIC',
                ],
                [
                    'unit_id' => $kg->id,
                    'name' => 'Plastic',
                    'default_price' => 1500,
                    'is_active' => true,
                ]
            );
        }
    }
}
