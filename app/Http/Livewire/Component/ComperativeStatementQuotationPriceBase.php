<?php

namespace App\Http\Livewire\Component;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ComperativeStatementQuotationPriceBase extends Component
{
    public $showTableQuotationTable;
    public $min_price;
    public $max_price;
    public $searchTerm;

    public function mount()
    {
        $this->min_price = 1;
        $this->max_price = 10000000000;
    }
    public function showQuotation()
    {
        $this->showTableQuotationTable = true;
    }
    public function render()
    {
        // $quotations = Quotation::whereBetween('company', [$this->min_price, $this->max_price])->orderBy('company', 'ASC')->get();
        $search = '%' . $this->searchTerm . '%';
        $quotations = Quotation::where('parts_name', 'LIKE', $search)->get();
        $minNumber = DB::table('quotations')->min('company');
        $from_date = DB::table('quotations')->date('from_date');
        return view('livewire.component.comperative-statement-quotation-price-base', ['quotations' => $quotations, 'minNumber' => $minNumber, 'from_date' => $from_date])->layout('layouts.base');
    }
}
