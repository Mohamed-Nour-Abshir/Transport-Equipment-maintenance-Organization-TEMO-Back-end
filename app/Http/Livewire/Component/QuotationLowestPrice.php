<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
use App\Models\Vehicle;
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
            $vehicles = Vehicle::all();
            $parts = PartsInfo::where('vehicle_name', $searchVehicleName)->get();
            $fiscal_year = FiscalYear::all();
            $minimumPrices = Quotation::select('parts_code', 'vehicle_code', 'parts_name', DB::raw('MIN(company) as minimum_price'))
                ->groupBy('parts_code', 'vehicle_code', 'parts_name')
                ->get();

            // $data = DB::table('quotations')->pluck('supplier_name');

            return view('livewire.component.quotation-lowest-price', compact('parts', 'quotations', 'minNumber', 'vehicles', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate', 'minimumPrices'))->layout('layouts.base');
        } else {
            $quotations = Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
            $minNumber = DB::table('quotations')->min('company');
            $vehicles = Vehicle::all();
            $fiscal_year = FiscalYear::all();
        }
        // $quotations =  Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        return view('livewire.component.quotation-lowest-price', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
