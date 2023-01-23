<?php

namespace App\Http\Livewire;

use App\Models\PartsInfo;
use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Http\Request;

class PartsInformationComponent extends Component
{
    public $searchTerm;
    public $vehicle_code;
    public $vehicle_name;
    public $parts_code;
    public $parts_name;
    public $parts_manufacture;
    public $parts_unit;
    public $parts_price;
    public $parts_date;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'vehicle_code' => 'required',
            'vehicle_name' => 'required',
            'parts_code' => 'required|unique:parts_infos,parts_code',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_price' => 'required',
            'parts_date' => 'required|date'
        ]);
    }
    public function addPartsInformation()
    {
        $this->validate([
            'vehicle_code' => 'required',
            'vehicle_name' => 'required',
            'parts_code' => 'required|unique:parts_infos,parts_code',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_price' => 'required',
            'parts_date' => 'required|date'
        ]);
        $parts = new PartsInfo();
        $parts->vehicle_code = $this->vehicle_code;
        $parts->vehicle_name = $this->vehicle_name;
        $parts->parts_code = $this->parts_code;
        $parts->parts_name = $this->parts_name;
        $parts->parts_manufacture = $this->parts_manufacture;
        $parts->parts_unit = $this->parts_unit;
        $parts->parts_price = $this->parts_price;
        $parts->parts_date = $this->parts_date;
        $parts->save();
        session()->flash('message', 'Parts Information added successfully');
        return redirect()->route('parts-information');
    }

    public function deletePartsInfo($id)
    {
        $parts = PartsInfo::find($id);
        $parts->delete();
        session()->flash('message', 'Parts has been deleted successfully');
    }
    public function render()
    {
        $parts = PartsInfo::orderBy('id', 'DESC')->paginate(10);
        $vehicles = Vehicle::all();
        return view('livewire.parts-information-component', ['parts' => $parts, 'vehicles' => $vehicles])->layout('layouts.base');
    }

    //generate vehicle data by json format
    public function findVehicleParts(Request $request)
    {
        $parent_id = $request->vehicle_code;
        $vehicledetails = Vehicle::select('vehicle_name')->where('vehicle_code', $parent_id)->first();
        return response()->json($vehicledetails);
    }
}
