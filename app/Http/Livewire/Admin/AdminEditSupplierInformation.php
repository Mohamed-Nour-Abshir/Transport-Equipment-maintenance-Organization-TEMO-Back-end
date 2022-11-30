<?php

namespace App\Http\Livewire\Admin;

use App\Models\Supplier;
use Livewire\Component;

class AdminEditSupplierInformation extends Component
{
    public $supplier_name;
    public $supplier_phone;
    public $supplier_email;
    public $supplier_address;
    public $date;
    public $supplier_id;
    public $supplierid;

    public function mount($supplierid)
    {
        $supplier = Supplier::find($supplierid);
        $this->supplier_name = $supplier->supplier_name;
        $this->supplier_phone = $supplier->supplier_phone;
        $this->supplier_email = $supplier->supplier_email;
        $this->supplier_address = $supplier->supplier_address;
        $this->date = $supplier->date;
        $this->supplier_id = $supplier->supplier_id;
        $this->supplierid = $supplier->id;
    }

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
    public function updateSupplierInformation()
    {
        $this->validate([
            'supplier_name' => 'required',
            'supplier_phone' => 'required|numeric',
            'supplier_email' => 'required|email',
            'supplier_address' => 'required',
            'date' => 'required|date',
        ]);

        $supplier = Supplier::find($this->supplierid);
        $supplier->supplier_name = $this->supplier_name;
        $supplier->supplier_phone = $this->supplier_phone;
        $supplier->supplier_email = $this->supplier_email;
        $supplier->supplier_address = $this->supplier_address;
        $supplier->date = $this->date;
        $supplier->save();
        session()->flash('message', 'Supplier Information has been updated successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-supplier-information')->layout('layouts.base');
    }
}
