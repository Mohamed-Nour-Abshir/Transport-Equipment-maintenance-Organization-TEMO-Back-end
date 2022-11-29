<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class QuotationLowestPrice extends Component
{
    public function render()
    {
        return view('livewire.component.quotation-lowest-price')->layout('layouts.base');
    }
}
