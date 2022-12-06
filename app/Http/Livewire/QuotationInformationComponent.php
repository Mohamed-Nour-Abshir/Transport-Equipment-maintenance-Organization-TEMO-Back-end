<?php

namespace App\Http\Livewire;

use App\Models\Quotation;
use Livewire\Component;

class QuotationInformationComponent extends Component
{
    public $searchTerm;
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $quotations = Quotation::where('supplier_id', 'LIKE', $search)
            ->orwhere('supplier_name', 'LIKE', $search)
            ->orwhere('vehicle_code', 'LIKE', $search)
            ->orwhere('vehicle_name', 'LIKE', $search)
            ->orwhere('parts_code', 'LIKE', $search)
            ->orwhere('parts_name', 'LIKE', $search)
            ->orwhere('from_date', 'LIKE', $search)
            ->orwhere('to_date', 'LIKE', $search)
            ->orwhere('id', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.quotation-information-component', ['quotations' => $quotations])->layout('layouts.base');
    }
}
