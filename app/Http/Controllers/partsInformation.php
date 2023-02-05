<?php

namespace App\Http\Controllers;

use App\Models\PartsInfo;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class partsInformation extends Controller
{
    public $searchTerm;
    public function addPartsInformation(Request $request)
    {
        $request->validate(
            [
                'vehicle_code' => 'required',
                'vehicle_name' => 'required',
                'parts_code' => 'required|unique:parts_infos,parts_code',
                'parts_name' => 'required',
                'parts_manufacture' => 'required',
                'parts_unit' => 'required',
                // 'parts_price' => 'required',
                'parts_date' => 'required|date'
            ],
            ['validateOnly' => true]
        );
        $parts = new PartsInfo();
        $parts->vehicle_code = $request->vehicle_code;
        $parts->vehicle_id = $request->vehicle_id;
        $parts->vehicle_name = $request->vehicle_name;
        $parts->parts_code = $request->parts_code;
        $parts->parts_name = $request->parts_name;
        $parts->parts_manufacture = $request->parts_manufacture;
        $parts->parts_unit = $request->parts_unit;
        // $parts->parts_price = $request->parts_price;
        $parts->parts_date = $request->parts_date;
        $parts->save();
        session()->flash('message', 'Parts Information added successfully');
        return redirect()->route('parts-information');
    }

    public function deletePartsInfo($id)
    {
        $parts = PartsInfo::find($id);
        $parts->delete();
        session()->flash('message', 'Parts has been deleted successfully');
        return redirect()->route('parts-information');
    }
    public function render()
    {
        if (request('searchTerm')) {
            $searchTerm = request('searchTerm');
            $vehicles = Vehicle::all();
            $parts = PartsInfo::where('id', $searchTerm)->orwhere('parts_code', $searchTerm)->orwhere('parts_name', $searchTerm)->orwhere('parts_unit', $searchTerm)->paginate(10);
            return view('livewire.parts-api-component', compact(['parts', 'vehicles']));
        }
        $parts = PartsInfo::orderBy('id', 'DESC')->paginate(10);
        $vehicles = Vehicle::all();
        return view('livewire.parts-api-component', compact(['parts', 'vehicles']));
    }

    //generate vehicle data by json format
    public function findVehicleParts(Request $request)
    {
        $parent_id = $request->vehicle_code;
        $vehicledetails = Vehicle::select('vehicle_name', 'id')->where('vehicle_code', $parent_id)->first();
        return response()->json($vehicledetails);
    }
}
