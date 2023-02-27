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
            $quotations = WorkOrder::where('order_no', $searchVehicleName)->select('parts_name', 'parts_code', 'parts_id','vehicle_type','parts_price',DB::raw('SUM(parts_qty) as parts_qty'))->groupBy('parts_name', 'parts_code', 'vehicle_type', 'parts_id', 'parts_price')->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
            $workordernos = WorkOrder::select('order_no')->groupBy('order_no')->get();
            $sum = WorkOrder::where('order_no', $searchVehicleName)->sum('order_parts_price');
            $items = WorkOrder::select('supplier_name', 'order_date', 'supplier_id')->groupBy('supplier_name', 'order_date', 'supplier_id')->get();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.workorder-letter', compact('quotations', 'minNumber', 'workordernos', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate', 'sum', 'items'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::where('order_parts_price', '=', $this->minNumber)->orderBy('id', 'asc')->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
            $workordernos = WorkOrder::select('order_no')->groupBy('order_no')->get();
            $items = WorkOrder::select('supplier_name', 'order_date')->groupBy('supplier_name', 'order_date')->get();
            $fiscal_year = FiscalYear::all();
        }
        // $quotations =  Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        return view('livewire.component.workorder-letter', ['quotations' => $quotations, 'workordernos' => $workordernos, 'fiscal_year' => $fiscal_year, 'items' => $items])->layout('layouts.base');
    }
}
