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
        // If there is set date, find the quotations
        if (request('vehicle_name') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('vehicle_name');
            $searchFromDate = request('from_date');
            $searchToDate = request('to_date');

            $quotations = Quotation::join(DB::raw('(SELECT parts_code, vehicle_code,vehicle_name,parts_name, parts_id, MIN(company) as min_price FROM quotations GROUP BY parts_code, vehicle_code, vehicle_name, parts_name, parts_id) as t'), function($join) use ($searchVehicleName) {
                $join->on('quotations.parts_code', '=', 't.parts_code')
                     ->on('quotations.vehicle_code', '=', 't.vehicle_code')
                     ->on('quotations.parts_id', '=', 't.parts_id')
                     ->on('quotations.company', '=', 't.min_price')
                     ->where('t.vehicle_name', '=', $searchVehicleName);
            })
            // ->select('parts.code', 'parts.name', 't.vehicle_name', 't.parts_name', 't.min_price')
            ->get();

            $fiscal_year = FiscalYear::all();
            $vehicles = Vehicle::all();
            return view('livewire.component.quotation-lowest-price', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName', 'searchFromDate', 'searchToDate'))->layout('layouts.base');
        }
        $vehicles = Vehicle::all();
        $fiscal_year = FiscalYear::all();
        $quotations = Quotation::orderBy('id', 'asc')->get();
        return view('livewire.component.quotation-lowest-price', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
