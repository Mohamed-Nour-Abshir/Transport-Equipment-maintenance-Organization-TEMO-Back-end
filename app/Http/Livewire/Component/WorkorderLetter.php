<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WorkorderLetter extends Component
{
    public $showTableQuotationTable;
    public $minNumber;
    public $searchTerm;
    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function mount()
    {
        $this->minNumber = DB::table('quotations')->min('company');
    }
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $quotations =  Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        return view('livewire.component.workorder-letter', ['quotations' => $quotations])->layout('layouts.base');
    }
}
