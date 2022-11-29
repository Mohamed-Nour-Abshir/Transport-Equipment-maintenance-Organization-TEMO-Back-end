<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class RepairVehicleList extends Component
{
    public function render()
    {
        return view('livewire.component.repair-vehicle-list')->layout('layouts.base');
    }
}
