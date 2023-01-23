<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VehicleRegWiseAsRespectWorkorder extends Component
{
    public $showTableQuotationTable;

    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function render()
    {
        // Set timezone
        date_default_timezone_set('Asia/Dhaka');
        // If there is set date, find the doctors
        if (request('vehicle_type') || request('from_date') || request('to_date')) {
            $searchVehicleName = request('vehicle_type');
            $searchFromDate = request('from_date');
            $searchToDate = request('to_date');
            $quotations = WorkOrder::latest('order_date')->where('vehicle_type', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.vehicle-reg-wise-as-respect-workorder', compact('quotations', 'vehicles', 'fiscal_year', 'searchVehicleName','searchFromDate','searchToDate'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
        }
        // $quotations = WorkOrder::latest('order_date')->get();
        return view('livewire.component.vehicle-reg-wise-as-respect-workorder', ['quotations' => $quotations, 'vehicles' => $vehicles, 'fiscal_year' => $fiscal_year])->layout('layouts.base');
    }
}
