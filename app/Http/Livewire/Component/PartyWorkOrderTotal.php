<?php

namespace App\Http\Livewire\Component;

use App\Models\FiscalYear;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PartyWorkOrderTotal extends Component
{
    public function render()
    {
        // Set timezone
        date_default_timezone_set('Asia/Dhaka');
        // If there is set date, find the doctors
        if (request('supplier_name') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('supplier_name');
            $searchFromDate = request('from_date');
            $searchToDate = request('to_date');
            $quotations = WorkOrder::where('supplier_name', $searchVehicleName)->select('order_no','order_date','supplier_id','supplier_name','vehicle_type','parts_price','parts_code','parts_name','parts_id','fiscal_year',DB::raw('SUM(parts_qty) as parts_qty'), DB::raw('SUM(order_parts_price) as order_parts_price'))->groupBy('order_no','order_date','supplier_id','supplier_name','vehicle_type','parts_price','parts_code','parts_name','parts_id','fiscal_year')->get();
            // $quotations = WorkOrder::latest('order_date')->where('parts_code', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $vehicles = WorkOrder::select('supplier_name','fiscal_year')->groupBy('supplier_name','fiscal_year')->get();
            $fiscal_year = FiscalYear::all();
            $sum = WorkOrder::sum('order_parts_price');
            $fiscalYear = FiscalYear::find(1);
            return view('livewire..component.party-work-order-total', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate','sum','fiscalYear'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::select('parts_code','fiscal_year')->groupBy('parts_code','fiscal_year')->get();
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
        }

        return view('livewire.component.party-work-order-total', compact('quotations', 'vehicles', 'fiscal_year','fiscalYear'))->layout('layouts.base');
    }
}
