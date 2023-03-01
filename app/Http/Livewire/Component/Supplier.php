<?php

namespace App\Http\Livewire\Component;

use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Supplier extends Component
{
    public $showTableQuotationTable;

    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function render()
    {
         // Set timezone
         date_default_timezone_set('Asia/Dhaka');
         // If there is set date, find the doctors
         if (request('supplier_name') || request('from_date') || request('to_date')) {
             $searchVehicleName = request('supplier_name');
             $searchFromDate = request('from_date');
             $searchToDate = request('to_date');
             $quotations = WorkOrder::latest('order_date')->where('supplier_name', $searchVehicleName)->select('parts_name', 'parts_code', 'vehicle_type', 'parts_id', 'parts_price','order_no','order_date',DB::raw('SUM(parts_qty) as parts_qty'))->groupBy('parts_name', 'parts_code', 'vehicle_type', 'parts_id', 'parts_price','order_no','order_date')->get();
            //  $quotations = WorkOrder::latest('order_date')->where('supplier_name', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
             $vehicles = WorkOrder::select('supplier_name')->groupBy('supplier_name')->get();
             $fiscal_year = FiscalYear::all();
             return view('livewire.component.supplier', compact('quotations','vehicles','fiscal_year','searchVehicleName','searchFromDate','searchToDate'))->layout('layouts.base');
         } else {
             $quotations = WorkOrder::latest('order_date')->get();
             $vehicles =WorkOrder::select('supplier_name')->groupBy('supplier_name')->get();
             $fiscal_year = FiscalYear::all();
         }
        // $quotations = Quotation::orderBy('from_date')->get();
        return view('livewire.component.supplier', ['quotations' => $quotations,'vehicles' =>$vehicles,'fiscal_year' =>$fiscal_year])->layout('layouts.base');
    }
}
