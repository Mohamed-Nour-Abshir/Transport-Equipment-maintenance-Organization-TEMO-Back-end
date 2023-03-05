<?php

namespace App\Http\Livewire;

use App\Models\FiscalYear;
use App\Models\Vehicle;
use Livewire\Component;

class VehicleInformationComponent extends Component
{
    public $searchTerm;
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
        $fiscalYear = date('01-07-Y', strtotime('-1 year'));
        $vehicle->fiscal_year = $fiscalYear;
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
        $search = '%' . $this->searchTerm . '%';
        $vehicles = Vehicle::where('vehicle_code', 'LIKE', $search)
            ->orwhere('vehicle_type', 'LIKE', $search)
            ->orwhere('vehicle_name', 'LIKE', $search)
            ->orwhere('id', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        $fiscalYear = FiscalYear::find(1);
        return view('livewire.vehicle-information-component', ['vehicles' => $vehicles ,'fiscalYear' =>$fiscalYear])->layout('layouts.base');
    }
}
