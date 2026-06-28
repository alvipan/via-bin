<?php

use App\Models\Member;
use Livewire\Component;

new class extends Component
{
    public $search;

    public function mount(
        $search = ''
    )
    {
        $this->search = $search;
    }

    public function render()
    {
        return $this->view([
            'members' => Member::query()
                ->search($this->search)
                ->paginate(),
        ]);
    }
};