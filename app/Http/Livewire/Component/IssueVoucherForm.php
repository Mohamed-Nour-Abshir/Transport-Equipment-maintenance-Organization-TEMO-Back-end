<?php

namespace App\Http\Livewire\Component;

use App\Models\FiscalYear;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IssueVoucherForm extends Component
{
    public function render()
    {
        // Set timezone
        date_default_timezone_set('Asia/Dhaka');
        // If there is set date, find the doctors
        if (request('vehicle_type') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('vehicle_type');
            $searchFromDate = request('from_date');
            $searchToDate = request('to_date');
            // $quotations = WorkOrder::latest('order_date')->where('vehicle_type', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $quotations = WorkOrder::latest('order_date')->where('vehicle_type', $searchVehicleName)->select('parts_name', 'parts_id', 'parts_price','fiscal_year','order_no', DB::raw('SUM(parts_qty) as parts_qty'),  DB::raw('SUM(order_parts_price) as order_parts_price'))->groupBy('parts_name', 'parts_id', 'parts_price','fiscal_year','order_no')->get();
            $vehicles = WorkOrder::select('vehicle_type','fiscal_year')->groupBy('vehicle_type','fiscal_year')->get();
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
            return view('livewire.component.issue-voucher-form', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName','fiscalYear','searchFromDate','searchToDate'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::select('vehicle_type','fiscal_year')->groupBy('vehicle_type','fiscal_year')->get();
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
        }
        return view('livewire.component.issue-voucher-form', compact('quotations', 'vehicles', 'fiscal_year', 'fiscalYear'))->layout('layouts.base');
    }
}
