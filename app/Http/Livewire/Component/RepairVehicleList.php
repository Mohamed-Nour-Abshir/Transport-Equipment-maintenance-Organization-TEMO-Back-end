<?php

namespace App\Http\Livewire\Component;

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
            $quotations = WorkOrder::select('vehicle_type')->groupBy('vehicle_type')->get();
            return view('livewire.component.repair-vehicle-list', compact('quotations'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::select('vehicle_type')->groupBy('vehicle_type')->get();
        }
        return view('livewire.component.repair-vehicle-list', ['quotations' => $quotations])->layout('layouts.base');
    }
}
