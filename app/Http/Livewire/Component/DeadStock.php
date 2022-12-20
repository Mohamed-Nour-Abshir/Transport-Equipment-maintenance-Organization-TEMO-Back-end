<?php

namespace App\Http\Livewire\Component;

use App\Models\Quotation;
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
        $quotations = Quotation::orderBy('id')->get();
        return view('livewire.component.dead-stock', ['quotations' => $quotations])->layout('layouts.base');
    }
}
