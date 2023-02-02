<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
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
        $this->minNumber = DB::table('quotations')->min('company');
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
            $quotations = Quotation::where('company', '=', $this->minNumber)->where('vehicle_name', $searchVehicleName)->orWhere('from_date', $searchFromDate)->orWhere('to_date', $searchToDate)->get();
            $minNumber = DB::table('quotations')->min('company');
            $vehicles = Quotation::all();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.quotation-lowest-price', compact('quotations', 'minNumber', 'vehicles', 'fiscal_year', 'searchVehicleName','searchFromDate','searchToDate'))->layout('layouts.base');
        } else {
            $quotations = Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
            $minNumber = DB::table('quotations')->min('company');
            $vehicles = Quotation::all();
            $fiscal_year = FiscalYear::all();
        }
        // $quotations =  WorkOrder::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        return view('livewire.component.quotation-lowest-price', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
