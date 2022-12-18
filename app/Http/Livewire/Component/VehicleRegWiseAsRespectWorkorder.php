<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
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
        $quotations = Quotation::orderBy('from_date')->get();
        return view('livewire.component.vehicle-reg-wise-as-respect-workorder', ['quotations' => $quotations])->layout('layouts.base');
    }
}
