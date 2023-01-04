<?php

namespace App\Http\Livewire\Component;

use App\Models\Quotation;
use App\Models\WorkOrder;
use Livewire\Component;

class Repair extends Component
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
            return view('livewire.component.repair', compact('quotations'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
        }
        return view('livewire.component.repair', ['quotations' => $quotations])->layout('layouts.base');
    }
}
