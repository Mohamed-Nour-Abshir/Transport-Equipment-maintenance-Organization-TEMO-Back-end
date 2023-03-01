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
        // If there is set date, find the quotations
        if (request('vehicle_name') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('vehicle_name');
            $searchFromDate = request('from_date');
            $searchToDate = request('to_date');

            $quotations = Quotation::where('vehicle_name', $searchVehicleName)
                                    ->select('parts_code', 'vehicle_code', 'parts_name', 'vehicle_name', 'parts_id',DB::raw('GROUP_CONCAT(company) as company'), DB::raw('GROUP_CONCAT(supplier_name) as supplier_name'), DB::raw('MIN(company) as minimum_price'))
                                    ->groupBy('parts_code', 'vehicle_code', 'vehicle_name', 'parts_name', 'parts_id')->get();

            $vehicles = Vehicle::all();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.comperative-statement-quotation-price-base', compact('quotations', 'searchVehicleName', 'searchFromDate', 'searchToDate', 'vehicles', 'fiscal_year'))->layout('layouts.base');
        }

        $quotations = Quotation::orderBy('company', 'ASC')->get();
        $vehicles = Vehicle::all();
        $fiscal_year = FiscalYear::all();
        return view('livewire.component.comperative-statement-quotation-price-base', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
