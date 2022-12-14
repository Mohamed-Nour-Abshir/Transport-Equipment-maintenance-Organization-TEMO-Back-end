<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleInformationComponent extends Component
{
    public $vehicle_code;
    public $vehicle_type;
    public $vehicle_name;
    public $madein;
    public $vehicle_ed;

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
    public function addVehicleInformation()
    {
        $this->validate([
            'vehicle_code' => 'required',
            'vehicle_type' => 'required',
            'vehicle_name' => 'required',
            'madein' => 'required',
            'vehicle_ed' => 'required'
        ]);
        $vehicle = new Vehicle();
        $vehicle->vehicle_code = $this->vehicle_code;
        $vehicle->vehicle_type = $this->vehicle_type;
        $vehicle->vehicle_name = $this->vehicle_name;
        $vehicle->vehicle_madein = $this->madein;
        $vehicle->date = $this->vehicle_ed;
        $vehicle->save();
        session()->flash('message', 'Vehicle added successfully');
        return redirect()->route('vehicle-information');
    }

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
