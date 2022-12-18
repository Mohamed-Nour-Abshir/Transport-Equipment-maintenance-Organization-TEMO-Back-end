<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use Livewire\Component;

class QuotationLowestPrice extends Component
{
    // public $searchTerm;
    public $showTableQuotationTable;
    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->min_price = 1;
        $this->max_price = 10000000;
    }
    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function render()
    {
        // $search = '%' . $this->searchTerm . '%';
        $quotations = Quotation::whereBetween('company', [$this->min_price, $this->max_price])->orderBy('company', 'ASC')->limit(8)->get();
        return view('livewire.component.quotation-lowest-price', ['quotations' => $quotations])->layout('layouts.base');
    }
}
