<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VehicleRegWiseAsRespectWorkorder extends Component
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
            $searchToDate = request('to_date');
            $quotations = WorkOrder::where('vehicle_type', $searchVehicleName)->select('order_no', 'parts_name', 'parts_id', 'parts_price', 'order_date', 'supplier_name','fiscal_year', DB::raw('SUM(parts_qty) as parts_qty'), DB::raw('SUM(order_parts_price) as order_parts_price'))->groupBy('parts_name', 'parts_id', 'parts_price', 'order_no', 'order_date', 'supplier_name','fiscal_year')->get();
            $vehicles = WorkOrder::select('vehicle_type','fiscal_year')->groupBy('vehicle_type','fiscal_year')->get();
            $fiscal_year = FiscalYear::all();
            $sum = WorkOrder::sum('order_parts_price');
            $fiscalYear = FiscalYear::find(1);
            return view('livewire.component.vehicle-reg-wise-as-respect-workorder', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate', 'sum','fiscalYear'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::select('vehicle_type','fiscal_year')->groupBy('vehicle_type','fiscal_year')->get();
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
        }
        // $quotations = WorkOrder::latest('order_date')->get();
        return view('livewire.component.vehicle-reg-wise-as-respect-workorder', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year, 'fiscalYear' => $fiscalYear])->layout('layouts.base');
    }
}
