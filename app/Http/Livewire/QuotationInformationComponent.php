<?php

namespace App\Http\Livewire;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
use Livewire\Component;

class QuotationInformationComponent extends Component
{
    public $searchTerm;
    public $from_date;
    public $to_date;
    public $parts_id;
    public $vehicle_id;
    public $supplier_id;
    public $supplier_name;
    public $vehicle_code;
    public $vehicle_name;
    public $parts_code;
    public $parts_name;
    public $company_price;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'from_date' => 'required',
            'to_date' => 'required',
            'supplier_id' => 'required',
            'supplier_name' => 'required',
            'vehicle_code' => 'required',
            'vehicle_name' => 'required',
            'parts_code' => 'required',
            'parts_name' => 'required',
            'company_price' => 'required'
        ]);
    }
    public function addQuotationInformation()
    {
        $this->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'supplier_id' => 'required',
            'supplier_name' => 'required',
            'vehicle_code' => 'required',
            'vehicle_name' => 'required',
            'parts_code' => 'required',
            'parts_name' => 'required',
            'company_price' => 'required'
        ]);

        // $quotations = Quotation::all();
        $quotation = new Quotation();
        $quotation->parts_id = $this->parts_id;
        $quotation->vehicle_id = $this->vehicle_id;
        $quotation->from_date = $this->from_date;
        $quotation->to_date = $this->to_date;
        $quotation->supplier_id = $this->supplier_id;
        $quotation->supplier_name = $this->supplier_name;
        $quotation->vehicle_code = $this->vehicle_code;
        $quotation->vehicle_name = $this->vehicle_name;
        $quotation->parts_code = $this->parts_code;
        $quotation->parts_name = $this->parts_name;
        $quotation->company = $this->company_price;
        $quotation->save();
        session()->flash('message', 'Quotation added successfully');
        return redirect()->route('quotation-information');
    }


    public function deleteQuotation($id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();
        session()->flash('message', 'Quotation has been deleted successfully');
    }
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $quotations = Quotation::where('supplier_id', 'LIKE', $search)
            ->orwhere('supplier_name', 'LIKE', $search)
            ->orwhere('vehicle_code', 'LIKE', $search)
            ->orwhere('vehicle_name', 'LIKE', $search)
            ->orwhere('parts_code', 'LIKE', $search)
            ->orwhere('parts_name', 'LIKE', $search)
            ->orwhere('from_date', 'LIKE', $search)
            ->orwhere('to_date', 'LIKE', $search)
            ->orwhere('id', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = Vehicle::all();
        return view('livewire.quotation-information-component', ['quotations' => $quotations, 'suppliers' => $suppliers, 'parts' => $parts, 'vehicles' => $vehicles])->layout('layouts.base');
    }
}
