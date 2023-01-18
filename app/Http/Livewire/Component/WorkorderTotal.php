<?php

namespace App\Http\Livewire\Component;

use App\Models\WorkOrder;
use App\Models\FiscalYear;
use Livewire\Component;

class WorkorderTotal extends Component
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
        if (request('vehicle_type') || request('from_date') || request('to_date') || request('order_no')) {
            $searchVehicleName = request('vehicle_type');
            $searchFromDate = request('from_date');
            $searchToDate = request('to_date');
            $searchOrderNo = request('order_no');
            $quotations = WorkOrder::latest('order_date')->where('vehicle_type', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->orWhere('order_no',$searchOrderNo)->get();
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
            return view('livewire.component.workorder-total', compact('quotations','vehicles','fiscal_year'))->layout('layouts.base');
        } else {
            $quotations = WorkOrder::latest('order_date')->get();
            $vehicles = WorkOrder::all();
            $fiscal_year = FiscalYear::all();
        }
        return view('livewire.component.workorder-total', ['quotations' => $quotations,'vehicles' =>$vehicles,'fiscal_year' =>$fiscal_year])->layout('layouts.base');
    }
}
