<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class DemandForm extends Component
{
    public function render()
    {
        return view('livewire.component.demand-form')->layout('layouts.base');
    }
}
