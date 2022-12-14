<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ComperativeStatementQuotationPriceBase extends Component
{
    public $showTableQuotationTable;
    public $min_price;
    public $max_price;
    public $searchTerm;

    public function mount()
    {
        $this->min_price = 1;
        $this->max_price = 10000000000;
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
            $quotations = WorkOrder::where('vehicle_name', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
            return view('livewire.component.comperative-statement-quotation-price-base', compact('quotations', 'minNumber', 'searchVehicleName'))->layout('layouts.base');
        } else {
            // $quotations = Quotation::whereBetween('company', [$this->min_price, $this->max_price])->orderBy('company', 'ASC')->get();
            $quotations = WorkOrder::orderBy('order_parts_price', 'ASC')->get();
            $minNumber = DB::table('work_orders')->min('order_parts_price');
        }
        // $date = WorkOrder::select('order_date')->first();
        // $order_date = date_format($date,'Y');
        return view('livewire.component.comperative-statement-quotation-price-base', ['quotations' => $quotations, 'minNumber' => $minNumber])->layout('layouts.base');
    }
}
