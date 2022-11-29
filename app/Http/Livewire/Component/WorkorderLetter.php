<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class WorkorderLetter extends Component
{
    public function render()
    {
        return view('livewire.component.workorder-letter')->layout('layouts.base');
    }
}
