<?php

use App\Enums\TenantRole;
use App\Enums\TenantUserStatus;
use App\Models\TenantUser;
use App\Services\TenantUserService;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    public string $search = '';

    public ?int $userId = null;
    public ?int $deleteId = null;

    public bool $showFormModal = false;
    public bool $showDeleteModal = false;

    public string $email = '';
    public string $role = 'cashier';
    public string $status = 'active';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Modal
    |--------------------------------------------------------------------------
    */

    public function create(): void
    {
        $this->resetForm();

        $this->showFormModal = true;
    }

    public function edit(int $id): void
    {
        $membership = $this->membership($id);

        $this->userId = $membership->id;
        $this->email = $membership->user->email;
        $this->role = $membership->role->value;
        $this->status = $membership->status->value;

        $this->showFormModal = true;
    }

    public function confirmDelete(int $id): void
    {
        $this->deleteId = $id;

        $this->showDeleteModal = true;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function save(TenantUserService $service): void
    {
        $this->validate([
            'email' => ['required', 'email'],
            'role' => ['required'],
            'status' => ['required'],
        ]);

        try {

            if ($this->userId) {

                $service->updateMembership(
                    $this->membership($this->userId),
                    TenantRole::from($this->role),
                    TenantUserStatus::from($this->status),
                );

            } else {

                $service->invite(
                    tenant(),
                    $this->email,
                    TenantRole::from($this->role),
                );

            }

            $this->showFormModal = false;

            $this->resetForm();

        } catch (RuntimeException $e) {

            $this->addError('email', $e->getMessage());

        }
    }

    public function delete(TenantUserService $service): void
    {
        $service->removeMembership(
            $this->membership($this->deleteId)
        );

        $this->showDeleteModal = false;

        $this->reset('deleteId');

        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        return $this->view([
            'users' => $this->query()->paginate(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    protected function query(): Builder
    {
        return TenantUser::query()
            ->whereBelongsTo(tenant())
            ->with('user')
            ->when(
                filled($this->search),
                fn (Builder $query) => $query->whereHas(
                    'user',
                    fn (Builder $query) => $query
                        ->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%")
                )
            )
            ->latest();
    }

    protected function membership(?int $id): TenantUser
    {
        return TenantUser::query()
            ->whereBelongsTo(tenant())
            ->with('user')
            ->findOrFail($id);
    }

    protected function resetForm(): void
    {
        $this->reset([
            'userId',
            'email',
            'role',
            'status',
        ]);

        $this->role = TenantRole::Cashier->value;
        $this->status = TenantUserStatus::Active->value;
    }
};