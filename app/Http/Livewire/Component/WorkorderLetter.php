<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use Livewire\Component;

class WorkorderLetter extends Component
{
    public $showTableQuotationTable;
    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function render()
    {
        // $search = '%' . $this->searchTerm . '%';
        $quotations = Quotation::orderBy('from_date')->get();
        return view('livewire.component.workorder-letter', ['quotations' => $quotations])->layout('layouts.base');
    }
}
