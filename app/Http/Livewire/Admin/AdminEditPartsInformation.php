<?php

namespace App\Http\Livewire\Admin;

use App\Models\PartsInfo;
use Livewire\Component;

class AdminEditPartsInformation extends Component
{
    public $vehicle_code;
    public $vehicle_name;
    public $parts_code;
    public $parts_name;
    public $parts_manufacture;
    public $parts_unit;
    public $parts_date;
    public $parts_price;
    public $parts_id;
    public function mount($parts_id)
    {
        $parts = PartsInfo::find($parts_id);
        $this->vehicle_code = $parts->vehicle_code;
        $this->vehicle_name = $parts->vehicle_name;
        $this->parts_code = $parts->parts_code;
        $this->parts_name = $parts->parts_name;
        $this->parts_manufacture = $parts->parts_manufacture;
        $this->parts_unit = $parts->parts_unit;
        $this->parts_price = $parts->parts_price;
        $this->parts_date = $parts->parts_date;
        $this->parts_id = $parts->id;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'vehicle_code' => 'required',
            'parts_code' => 'required',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_price' => 'required',
            'parts_date' => 'required|date'
        ]);
    }
    public function updatePartsInformation()
    {
        $this->validate([
            'vehicle_code' => 'required',
            'parts_code' => 'required',
            'parts_name' => 'required',
            'parts_manufacture' => 'required',
            'parts_unit' => 'required',
            'parts_price' => 'required',
            'parts_date' => 'required|date'
        ]);
        $parts = PartsInfo::find($this->parts_id);
        $parts->vehicle_code = $this->vehicle_code;
        $parts->vehicle_name = $this->vehicle_name;
        $parts->parts_code = $this->parts_code;
        $parts->parts_name = $this->parts_name;
        $parts->parts_manufacture = $this->parts_manufacture;
        $parts->parts_unit = $this->parts_unit;
        $parts->parts_price = $this->parts_price;
        $parts->parts_date = $this->parts_date;
        $parts->save();
        session()->flash('message', 'Parts Information has been updated successfully');
        return redirect()->route('parts-information');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-parts-information')->layout('layouts.test');
    }
}
