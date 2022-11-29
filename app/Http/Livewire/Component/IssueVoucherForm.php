<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class IssueVoucherForm extends Component
{
    public function render()
    {
        return view('livewire.component.issue-voucher-form')->layout('layouts.base');
    }
}
