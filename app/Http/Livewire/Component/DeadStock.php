<?php

namespace App\Http\Livewire\Component;

use App\Models\WorkOrder;
use Livewire\Component;

class DeadStock extends Component
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
       if (request('fiscal_year') || request('from_date') || request('to_date')) {
           $searchVehicleName = request('fiscal_year');
           $searchFromDate = request('from_date');
           $searchToDate = request('to_date');
           $quotations = WorkOrder::latest('order_date')->where('fiscal_year', $searchVehicleName)->orWhere('quotation_from', $searchFromDate)->orWhere('quotation_to', $searchToDate)->get();
           return view('livewire.component.dead-stock', compact('quotations'))->layout('layouts.base');
       } else {
           $quotations = WorkOrder::latest('order_date')->get();
       }
        return view('livewire.component.dead-stock', ['quotations' => $quotations])->layout('layouts.base');
    }
}
