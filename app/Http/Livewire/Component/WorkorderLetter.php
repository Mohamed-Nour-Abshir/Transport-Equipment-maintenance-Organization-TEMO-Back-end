<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
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
        $parts = PartsInfo::orderBy('parts_date')->latest()->get();
        return view('livewire.component.workorder-letter', ['parts' => $parts])->layout('layouts.base');
    }
}
