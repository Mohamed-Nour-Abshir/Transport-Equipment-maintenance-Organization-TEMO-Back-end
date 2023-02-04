<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
use App\Models\Vehicle;
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
            $quotations = Quotation::where('vehicle_name', $searchVehicleName)->orWhere('from_date', $searchFromDate)->orWhere('to_date', $searchToDate)->orderBy('company','ASC')->get();
            $minNumber = DB::table('quotations')->min('company');

            $minimumPrices = Quotation::select('parts_code', 'vehicle_code','parts_name','company', DB::raw('MIN(company) as minimum_price'))
            ->groupBy('parts_code', 'vehicle_code','parts_name','company')
            ->get();

            $company = Quotation::select('company')->get();

            $vehicles = Vehicle::all();
            $parts = PartsInfo::where('vehicle_name', $searchVehicleName)->get();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.comperative-statement-quotation-price-base', compact('quotations', 'minNumber', 'searchVehicleName', 'searchFromDate', 'searchToDate', 'vehicles', 'fiscal_year','parts','minimumPrices','company'))->layout('layouts.base');
        } else {
            // $quotations = Quotation::whereBetween('company', [$this->min_price, $this->max_price])->orderBy('company', 'ASC')->get();
            $quotations = Quotation::orderBy('company', 'ASC')->get();
            $minNumber = DB::table('quotations')->min('company');
            $vehicles = Vehicle::all();
            $fiscal_year = FiscalYear::all();
        }
        // $date = WorkOrder::select('order_date')->first();
        // $order_date = date_format($date,'Y');
        return view('livewire.component.comperative-statement-quotation-price-base', ['quotations' => $quotations, 'minNumber' => $minNumber, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
