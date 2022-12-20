<?php

namespace App\Http\Livewire\Component;

use App\Models\Quotation;
use Livewire\Component;

class SparePartsWiseAsRespectWorkorder extends Component
{
    public $showTableQuotationTable;

    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function render()
    {
        $quotations = Quotation::orderBy('from_date')->get();
        return view('livewire.component.spare-parts-wise-as-respect-workorder', ['quotations' => $quotations])->layout('layouts.base');
    }
}
