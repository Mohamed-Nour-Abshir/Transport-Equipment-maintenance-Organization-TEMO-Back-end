<?php

namespace App\Http\Livewire;

use App\Models\PartsInfo;
use Livewire\Component;

class PartsInformationComponent extends Component
{
    public $searchTerm;
    public function deletePartsInfo($id)
    {
        $parts = PartsInfo::find($id);
        $parts->delete();
        session()->flash('message', 'Parts has been deleted successfully');
    }
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        $parts = PartsInfo::where('id', 'LIKE', $search)
            ->orwhere('parts_code', 'LIKE', $search)
            ->orwhere('parts_name', 'LIKE', $search)
            ->orwhere('parts_date', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.parts-information-component', ['parts' => $parts])->layout('layouts.base');
    }
}
