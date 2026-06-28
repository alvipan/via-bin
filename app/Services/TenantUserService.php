<?php

namespace App\Services;

use App\Enums\TenantRole;
use App\Enums\TenantUserStatus;
use App\Models\Tenant;
use App\Models\TenantUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TenantUserService
{
    public function __construct(
        protected ViaAccountService $viaAccount,
    ) {}

    /**
     * Invite user into tenant.
     */
    public function invite(
        Tenant $tenant,
        string $email,
        TenantRole $role,
    ): TenantUser {
        return DB::transaction(function () use ($tenant, $email, $role) {

            $account = $this->viaAccount->findUserByEmail($email);

            if (! $account) {
                throw new RuntimeException(
                    'User belum terdaftar di ViaAccount.'
                );
            }

            // Sinkronkan user ke database ViaBin
            $user = User::updateOrCreate(
                [
                    'via_account_id' => $account['id'],
                ],
                [
                    'name'  => $account['name'],
                    'email' => $account['email'],
                ],
            );

            $membership = TenantUser::query()
                ->where('tenant_id', $tenant->id)
                ->where('user_id', $user->id)
                ->first();

            if ($membership) {
                throw new RuntimeException(
                    'User sudah menjadi anggota tenant.'
                );
            }

            return TenantUser::create([
                'tenant_id' => $tenant->id,
                'user_id'   => $user->id,
                'role'      => $role,
                'status'    => TenantUserStatus::Active,
            ]);
        });
    }

    /**
     * Update membership.
     */
    public function updateMembership(
        TenantUser $membership,
        TenantRole $role,
        TenantUserStatus $status,
    ): TenantUser {
        return DB::transaction(function () use (
            $membership,
            $role,
            $status,
        ) {

            $membership->update([
                'role' => $role,
                'status' => $status,
            ]);

            return $membership->fresh();
        });
    }

    /**
     * Remove member from tenant.
     */
    public function removeMembership(
        TenantUser $membership,
    ): void {
        DB::transaction(function () use ($membership) {

            if ($membership->isOwner()) {
                throw new RuntimeException(
                    'Owner tenant tidak dapat dihapus.'
                );
            }

            $membership->delete();
        });
    }
}