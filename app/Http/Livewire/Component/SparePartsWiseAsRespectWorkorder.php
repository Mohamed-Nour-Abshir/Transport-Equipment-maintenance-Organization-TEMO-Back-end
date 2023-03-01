<?php

namespace App\Http\Livewire\Component;

use App\Models\Quotation;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SparePartsWiseAsRespectWorkorder extends Component
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
        if (request('parts_code') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('parts_code');
            $searchFromDate = request('from_date');
            $searchToDate = request('todate');
            $quotations = WorkOrder::where('vehicle_type', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->select('order_no','order_date','supplier_name','vehicle_type','parts_price',DB::raw('SUM(parts_qty) as parts_qty'))->groupBy('order_no','order_date','supplier_name','vehicle_type','parts_price')->get();
            // $quotations = WorkOrder::latest('order_date')->where('parts_code', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $vehicles = WorkOrder::select('parts_code')->groupBy('parts_code')->get();
            $fiscal_year = FiscalYear::all();
            $sum = WorkOrder::sum('order_parts_price');
            return view('livewire.component.spare-parts-wise-as-respect-workorder', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate','sum'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::select('parts_code')->groupBy('parts_code')->get();
            $fiscal_year = FiscalYear::all();
        }
        // $quotations = WorkOrder::latest('order_date')->get();
        return view('livewire.component.spare-parts-wise-as-respect-workorder', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
