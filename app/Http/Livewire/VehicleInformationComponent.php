<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleInformationComponent extends Component
{
    public function deleteVehicle($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        session()->flash('message', 'Vehicle has been deleted successfully');
    }
    public function render()
    {
        $vehicles = Vehicle::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.vehicle-information-component', ['vehicles' => $vehicles])->layout('layouts.base');
    }
}
