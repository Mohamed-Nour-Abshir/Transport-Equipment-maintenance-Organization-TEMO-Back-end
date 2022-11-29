<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class DeadStock extends Component
{
    public function render()
    {
        return view('livewire.component.dead-stock')->layout('layouts.base');
    }
}
