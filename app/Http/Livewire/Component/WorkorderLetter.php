<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WorkorderLetter extends Component
{
    public $showTableQuotationTable;
    public $minNumber;
    public $searchTerm;
    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function mount()
    {
        $this->minNumber = DB::table('work_orders')->min('order_parts_price');
    }
    public function render()
    {
        // Set timezone
        date_default_timezone_set('Asia/Dhaka');
        // If there is set date, find the doctors
        if (request('vehicle_name') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('vehicle_name');
            $searchFromDate = request('from_date');
            $searchToDate = request('to_date');
            // $parts = WorkOrder::where('order_no', $searchVehicleName)->select('parts_name')->groupBy('parts_name')->get();

            $quotations = WorkOrder::where('order_no', $searchVehicleName)
                ->select('parts_name', 'parts_code', 'parts_id', 'vehicle_type', 'parts_price', 'supplier_id','order_date','fiscal_year', DB::raw('SUM(parts_qty) as parts_qty'), DB::raw('SUM(order_parts_price) as order_parts_price'))
                ->groupBy('parts_name', 'parts_code', 'vehicle_type', 'parts_id', 'parts_price', 'supplier_id','order_date','fiscal_year')->get();

            $workordernos = WorkOrder::select('order_no','fiscal_year')->groupBy('order_no','fiscal_year')->get();
            $sum = WorkOrder::where('order_no', $searchVehicleName)->sum('order_parts_price');
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
            return view('livewire.component.workorder-letter', compact('quotations', 'workordernos', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate', 'sum', 'fiscalYear'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::where('order_parts_price', '=', $this->minNumber)->orderBy('id', 'asc')->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
            $workordernos = WorkOrder::select('order_no','fiscal_year')->groupBy('order_no','fiscal_year')->get();
            $items = WorkOrder::select('supplier_name', 'order_date','fiscal_year')->groupBy('supplier_name', 'order_date','fiscal_year')->get();
            $fiscal_year = FiscalYear::all();
            $fiscalYear = FiscalYear::find(1);
        }
        // $quotations =  Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        return view('livewire.component.workorder-letter', ['quotations' => $quotations, 'workordernos' => $workordernos, 'fiscal_year' => $fiscal_year, 'items' => $items,'fiscalYear' => $fiscalYear])->layout('layouts.base');
    }
}
