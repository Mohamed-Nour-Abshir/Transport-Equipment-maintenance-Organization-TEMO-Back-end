<?php

namespace App\Http\Livewire\Component;

use App\Models\Quotation;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DemandForm extends Component
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
        if (request('vehicle_type') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('vehicle_type');
            $searchFromDate = request('from_date');
            $searchToDate = request('todate');
            $quotations = WorkOrder::latest('order_date')->where('supplier_name', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->select('parts_name', 'parts_id', DB::raw('SUM(parts_qty) as parts_qty'))->groupBy('parts_name', 'parts_id')->get();
            // $quotations = WorkOrder::latest('order_date')->where('vehicle_type', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $vehicles = WorkOrder::select('vehicle_type')->groupBy('vehicle_type')->get();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.demand-form', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::select('vehicle_type')->groupBy('vehicle_type')->get();
            $fiscal_year = FiscalYear::all();
        }
        return view('livewire.component.demand-form', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
