<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Supplier;

class AdminAddSupplierInformation extends Component
{
    public $supplier_name;
    public $supplier_phone;
    public $supplier_email;
    public $supplier_address;
    public $date;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'supplier_name' => 'required',
            'supplier_phone' => 'required|numeric',
            'supplier_email' => 'required|email',
            'supplier_address' => 'required',
            'date' => 'required|date',
        ]);
    }
    public function addSupplierInformation()
    {
        $this->validate([
            'supplier_name' => 'required',
            'supplier_phone' => 'required|numeric',
            'supplier_email' => 'required|email',
            'supplier_address' => 'required',
            'date' => 'required|date',
        ]);
        $supplier = new Supplier();
        $supplier->supplier_name = $this->supplier_name;
        $supplier->supplier_phone = $this->supplier_phone;
        $supplier->supplier_email = $this->supplier_email;
        $supplier->supplier_address = $this->supplier_address;
        $supplier->date = $this->date;
        $supplier->save();
        session()->flash('message', 'Supplier Information has been added successfully');
        return redirect()->route('supplier-information');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-supplier-information')->layout('layouts.base');
    }
}
