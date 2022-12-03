<?php

namespace App\Http\Livewire\Admin;

use App\Models\PartsInfo;
use Livewire\Component;

class AdminAddPartsInformation extends Component
{
    public $vehicle_code;
    public $parts_code;
    public $parts_name;
    public $parts_manufacture;
    public $parts_unit;
    public $parts_date;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'vehicle_code' => 'required',
            'parts_code' => 'required',
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
            'parts_code' => 'required',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_date' => 'required|date'
        ]);
        $parts = new PartsInfo();
        $parts->vehicle_code = $this->vehicle_code;
        $parts->parts_code = $this->parts_code;
        $parts->parts_name = $this->parts_name;
        $parts->parts_manufacture = $this->parts_manufacture;
        $parts->parts_unit = $this->parts_unit;
        $parts->parts_date = $this->parts_date;
        $parts->save();
        session()->flash('message', 'Parts Information added successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-parts-information')->layout('layouts.base');
    }
}
