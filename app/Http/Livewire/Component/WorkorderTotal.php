<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class WorkorderTotal extends Component
{
    public function render()
    {
        return view('livewire.component.workorder-total')->layout('layouts.base');
    }
}
