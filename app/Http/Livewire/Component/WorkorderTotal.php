<?php

namespace App\Http\Livewire\Component;

use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WorkorderTotal extends Component
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
        if (request('vehicle_type') || request('from_date') || request('to_date') || request('order_no')) {
            $searchVehicleName = request('vehicle_type');
            $searchFromDate = request('from_date');
            $searchToDate = request('todate');
            $searchOrderNo = request('order_no');
            // $quotations = WorkOrder::latest('order_date')->Where('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $quotations = WorkOrder::where('supplier_name', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->select('order_no','order_date','supplier_name','parts_price','fiscal_year', DB::raw('SUM(parts_qty) as parts_qty'),  DB::raw('SUM(order_parts_price) as order_parts_price'))->groupBy('order_no','order_date','parts_price','supplier_name','fiscal_year')->orderBy('id')->get();
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
            $sum = WorkOrder::sum('order_parts_price');
            // dd($sum);
            return view('livewire.component.workorder-total', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate', 'sum','fiscalYear'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
        }
        return view('livewire.component.workorder-total', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year,'fiscalYear' =>$fiscalYear])->layout('layouts.base');
    }
}
