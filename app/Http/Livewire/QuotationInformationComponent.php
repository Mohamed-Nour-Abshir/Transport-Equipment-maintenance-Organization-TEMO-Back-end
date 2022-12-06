<?php

namespace App\Http\Livewire;

use App\Models\Quotation;
use Livewire\Component;

class QuotationInformationComponent extends Component
{
    public function render()
    {
        $quotations = Quotation::all();
        return view('livewire.quotation-information-component', ['quotations' => $quotations])->layout('layouts.base');
    }
}
