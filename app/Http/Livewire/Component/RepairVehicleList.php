<?php

namespace App\Http\Livewire\Component;

use App\Models\FiscalYear;
use App\Models\WorkOrder;
use Livewire\Component;

class RepairVehicleList extends Component
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
        if (request('fiscal_year')) {
            $searchVehicleName = request('fiscal_year');
            $quotations = WorkOrder::select('vehicle_type','fiscal_year')->groupBy('vehicle_type','fiscal_year')->get();
            $fiscalYear = FiscalYear::find(1);
            return view('livewire.component.repair-vehicle-list', compact('quotations','fiscalYear'))->layout('layouts.base');
        } else {
            $fiscalYear = FiscalYear::find(1);
            $quotations = WorkOrder::select('vehicle_type','fiscal_year')->groupBy('vehicle_type','fiscal_year')->get();
        }
        return view('livewire.component.repair-vehicle-list', ['quotations' => $quotations,'fiscalYear' =>$fiscalYear])->layout('layouts.base');
    }
}
