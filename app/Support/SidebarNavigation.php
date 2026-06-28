<?php

namespace App\Support;

use App\Enums\TenantModule;
use App\Enums\TenantRole;

class SidebarNavigation
{
    public function items(): array
    {
        return [
            [
                'group' => 'Utama',
                'items' => [
                    [
                        'label' => 'Dasbor',
                        'icon' => 'home',
                        'route' => 'dashboard',
                        'active' => 'dashboard',
                    ],
                ],
            ],

            [
                'group' => 'Operasional',
                'items' => [
                    [
                        'label' => 'Anggota',
                        'icon' => 'users',
                        'route' => 'members.index',
                        'active' => 'members.*',
                        'module' => TenantModule::Members,
                    ],
                    [
                        'label' => 'Jenis Sampah',
                        'icon' => 'trash',
                        'route' => 'wastes.index',
                        'active' => 'wastes.*',
                        'module' => TenantModule::WasteTypes,
                    ],
                    [
                        'label' => 'Setoran',
                        'icon' => 'arrow-down-tray',
                        'route' => 'deposits.index',
                        'active' => 'deposits.*',
                        'module' => TenantModule::Deposits,
                    ],
                    [
                        'label' => 'Lots',
                        'icon' => 'archive-box',
                        'route' => 'lots.index',
                        'active' => 'lots.*',
                        'module' => TenantModule::Lots,
                    ],
                    [
                        'label' => 'Penjualan',
                        'icon' => 'banknotes',
                        'route' => 'sales.index',
                        'active' => 'sales.*',
                        'module' => TenantModule::Sales,
                    ],
                    [
                        'label' => 'Pencairan',
                        'icon' => 'arrow-up-tray',
                        'route' => 'withdrawals.index',
                        'active' => 'withdrawals.*',
                        'module' => TenantModule::Withdrawals,
                    ],
                ],
            ],

            [
                'group' => 'Manajemen',
                'items' => [
                    [
                        'label' => 'Tim',
                        'icon' => 'users',
                        'route' => 'users.index',
                        'active' => 'users.*',
                        'module' => TenantModule::Users,
                        'roles' => [TenantRole::Owner, TenantRole::Admin],
                    ],
                    [
                        'label' => 'Settings',
                        'icon' => 'cog-6-tooth',
                        'route' => 'settings',
                        'active' => 'settings',
                        'module' => TenantModule::Settings,
                        'roles' => [TenantRole::Owner],
                    ],
                ],
            ],
        ];
    }

    public function visibleItems(): array
    {
        return collect($this->items())
            ->map(function ($group) {

                $items = collect($group['items'])
                    ->filter(function ($item) {

                        // module check
                        if (isset($item['module']) && ! tenant_can($item['module'])) {
                            return false;
                        }

                        // role check
                        if (isset($item['roles'])) {
                            return in_array(
                                membership()->role,
                                $item['roles'],
                                true
                            );
                        }

                        return true;
                    })
                    ->values()
                    ->all();

                return [
                    'group' => $group['group'],
                    'items' => $items,
                ];
            })
            ->filter(fn ($group) => count($group['items']) > 0)
            ->values()
            ->all();
    }
}