<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class QuotationLowestPrice extends Component
{
    // public $searchTerm;
    public $showTableQuotationTable;
    public $min_price;
    public $max_price;
    public $minNumber;
    public function mount()
    {
        $this->min_price = 1;
        $this->max_price = 10000000;
        $this->minNumber = DB::table('work_orders')->min('order_parts_price');
    }
    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
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
            return view('livewire.component.quotation-lowest-price', compact('quotations', 'minNumber'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::where('order_parts_price', '=', $this->minNumber)->orderBy('id', 'asc')->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
        }
        // $quotations =  WorkOrder::where('order_parts_price', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        return view('livewire.component.quotation-lowest-price', ['quotations' => $quotations])->layout('layouts.base');
    }
}
