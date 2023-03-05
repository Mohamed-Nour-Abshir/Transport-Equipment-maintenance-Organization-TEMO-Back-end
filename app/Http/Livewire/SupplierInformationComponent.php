<?php

namespace App\Http\Livewire;

use App\Models\FiscalYear;
use App\Models\Supplier;
use Livewire\Component;
use PDF;

class SupplierInformationComponent extends Component
{
    public $searchTerm;
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
        $fiscalYear = date('01-07-Y', strtotime('-1 year'));
        $supplier->fiscal_year = $fiscalYear;
        $supplier->save();
        session()->flash('message', 'Supplier Information has been added successfully');
        return redirect()->route('suplier-information');
    }


    public function deleteSupplier($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        session()->flash('message', 'Supplier has been deleted successfully!');
    }


    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $suppliers = Supplier::where('supplier_id', 'LIKE', $search)
            ->orwhere('supplier_name', 'LIKE', $search)
            ->orwhere('supplier_email', 'LIKE', $search)
            ->orwhere('supplier_phone', 'LIKE', $search)
            ->orwhere('supplier_address', 'LIKE', $search)
            ->orwhere('date', 'LIKE', $search)
            ->orwhere('id', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        $fiscalYear = FiscalYear::find(1);
        return view('livewire.supplier-information-component', ['suppliers' => $suppliers,'fiscalYear'=>$fiscalYear])->layout('layouts.base');
    }
}
