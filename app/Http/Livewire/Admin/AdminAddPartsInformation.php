<?php

namespace App\Http\Livewire\Admin;

use App\Models\PartsInfo;
use App\Models\Vehicle;
use Livewire\Component;

class AdminAddPartsInformation extends Component
{
    public $vehicle_code;
    public $parts_code;
    public $parts_name;
    public $parts_manufacture;
    public $parts_unit;
    public $parts_date;
    public $parts_price;
    public $parts_qty;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'vehicle_code' => 'required',
            'parts_code' => 'required|unique:parts_infos,parts_code',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_price' => 'required',
            'parts_qty' => 'required',
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
            'parts_price' => 'required',
            'parts_qty' => 'required',
            'parts_date' => 'required|date'
        ]);
        $parts = new PartsInfo();
        $parts->vehicle_id = $this->vehicle_code;
        $parts->parts_code = $this->parts_code;
        $parts->parts_name = $this->parts_name;
        $parts->parts_manufacture = $this->parts_manufacture;
        $parts->parts_unit = $this->parts_unit;
        $parts->parts_price = $this->parts_price;
        $parts->parts_qty = $this->parts_qty;
        $parts->parts_date = $this->parts_date;
        $parts->save();
        session()->flash('message', 'Parts Information added successfully');
        return redirect()->route('parts-information');
    }
    public function render()
    {
        $vehicles = Vehicle::all();
        return view('livewire.admin.admin-add-parts-information', ['vehicles' => $vehicles])->layout('layouts.base');
    }
}
