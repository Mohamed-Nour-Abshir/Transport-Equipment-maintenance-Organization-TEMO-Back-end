<?php

namespace App\Http\Livewire\Admin;

use App\Models\Vehicle;
use Livewire\Component;

class AdminEditVehicleInformation extends Component
{
    public $vehicle_code;
    public $vehicle_type;
    public $vehicle_name;
    public $vehicle_id;

    public function mount($vehicle_id)
    {
        $vehicle = Vehicle::find($this->vehicle_id);
        $this->vehicle_code = $vehicle->vehicle_code;
        $this->vehicle_type = $vehicle->vehicle_type;
        $this->vehicle_name = $vehicle->vehicle_name;
        $this->vehicle_id = $vehicle->id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'vehicle_code' => 'required',
            'vehicle_type' => 'required',
            'vehicle_name' => 'required'
        ]);
    }
    public function updateVehicleInformation()
    {
        $this->validate([
            'vehicle_code' => 'required',
            'vehicle_type' => 'required',
            'vehicle_name' => 'required'
        ]);
        $vehicle = Vehicle::find($this->vehicle_id);
        $vehicle->vehicle_code = $this->vehicle_code;
        $vehicle->vehicle_type = $this->vehicle_type;
        $vehicle->vehicle_name = $this->vehicle_name;
        $vehicle->save();
        session()->flash('message', 'Vehicle has been updated successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-vehicle-information')->layout('layouts.test');
    }
}
