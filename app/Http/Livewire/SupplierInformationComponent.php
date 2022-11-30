<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use Livewire\Component;
use PDF;

class SupplierInformationComponent extends Component
{
    public $searchTerm;

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
            ->orwhere('supplier_phone', 'LIKE', $search)
            ->orwhere('date', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(5);
        // $suppliers = Supplier::paginate(5);
        return view('livewire.supplier-information-component', ['suppliers' => $suppliers])->layout('layouts.base');
    }
}
