<?php

namespace App\Http\Livewire\Admin;

use App\Models\Vehicle;
use Livewire\Component;

class AdminEditVehicleInformation extends Component
{
    public $vehicle_code;
    public $vehicle_type;
    public $vehicle_name;
    public $madein;
    public $vehicle_ed;
    public $vehicle_id;

    public function mount($vehicle_id)
    {
        $vehicle = Vehicle::find($this->vehicle_id);
        $this->vehicle_code = $vehicle->vehicle_code;
        $this->vehicle_type = $vehicle->vehicle_type;
        $this->vehicle_name = $vehicle->vehicle_name;
        $this->madein = $vehicle->vehicle_madein;
        $this->vehicle_ed = $vehicle->date;
        $this->vehicle_id = $vehicle->id;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'vehicle_code' => 'required',
            'vehicle_type' => 'required',
            'vehicle_name' => 'required',
            'madein' => 'required',
            'vehicle_ed' => 'required'
        ]);
    }
    public function updateVehicleInformation()
    {
        $this->validate([
            'vehicle_code' => 'required',
            'vehicle_type' => 'required',
            'vehicle_name' => 'required',
            'madein' => 'required',
            'vehicle_ed' => 'required'
        ]);
        $vehicle = Vehicle::find($this->vehicle_id);
        $vehicle->vehicle_code = $this->vehicle_code;
        $vehicle->vehicle_type = $this->vehicle_type;
        $vehicle->vehicle_name = $this->vehicle_name;
        $vehicle->vehicle_madein = $this->madein;
        $vehicle->date = $this->vehicle_ed;
        $vehicle->save();
        session()->flash('message', 'Vehicle has been updated successfully');
        return redirect()->route('vehicle-information');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-vehicle-information')->layout('layouts.test');
    }
}
