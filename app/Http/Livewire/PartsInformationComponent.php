<?php

namespace App\Http\Livewire;

use App\Models\PartsInfo;
use App\Models\Vehicle;
use Livewire\Component;

class PartsInformationComponent extends Component
{
    public $searchTerm;
    public $vehicle_code;
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
            'parts_code' => 'required|unique:parts_infos,parts_code',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_date' => 'required|date'
        ]);
    }
    public function addPartsInformation()
    {
        $this->validate([
            'vehicle_code' => 'required',
            'parts_code' => 'required|unique:parts_infos,parts_code',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_date' => 'required|date'
        ]);
        $parts = new PartsInfo();
        $parts->vehicle_id = $this->vehicle_code;
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
        $search = '%' . $this->searchTerm . '%';
        $parts = PartsInfo::where('id', 'LIKE', $search)
            ->orwhere('parts_code', 'LIKE', $search)
            ->orwhere('parts_name', 'LIKE', $search)
            ->orwhere('parts_date', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        $vehicles = Vehicle::all();
        return view('livewire.parts-information-component', ['parts' => $parts, 'vehicles' => $vehicles])->layout('layouts.base');
    }
}
