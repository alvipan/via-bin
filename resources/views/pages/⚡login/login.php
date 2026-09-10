<?php

use Livewire\Component;

new class extends Component
{
    function render()
    {
        return $this->view()->layout('layouts::member.auth');
    }
};
