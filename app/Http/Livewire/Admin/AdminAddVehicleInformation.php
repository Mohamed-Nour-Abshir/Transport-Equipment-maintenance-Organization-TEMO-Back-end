<?php

namespace App\Http\Livewire\Admin;

use App\Models\Vehicle;
use Livewire\Component;

class AdminAddVehicleInformation extends Component
{
    public $vehicle_code;
    public $vehicle_type;
    public $vehicle_name;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'vehicle_code' => 'required',
            'vehicle_type' => 'required',
            'vehicle_name' => 'required'
        ]);
    }
    public function addVehicleInformation()
    {
        $this->validate([
            'vehicle_code' => 'required',
            'vehicle_type' => 'required',
            'vehicle_name' => 'required'
        ]);
        $vehicle = new Vehicle();
        $vehicle->vehicle_code = $this->vehicle_code;
        $vehicle->vehicle_type = $this->vehicle_type;
        $vehicle->vehicle_name = $this->vehicle_name;
        $vehicle->save();
        session()->flash('message', 'Vehicle added successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-vehicle-information')->layout('layouts.base');
    }
}
