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
            $quotations = WorkOrder::where('order_parts_price', '=', $this->minNumber)->where('vehicle_name', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.workorder-letter', compact('quotations', 'minNumber','vehicles','fiscal_year','searchVehicleName','searchFromDate','searchToDate'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::where('order_parts_price', '=', $this->minNumber)->orderBy('id', 'asc')->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
        }
        // $quotations =  Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        return view('livewire.component.workorder-letter', ['quotations' => $quotations,'vehicles' =>$vehicles,'fiscal_year' =>$fiscal_year])->layout('layouts.base');
    }
}
