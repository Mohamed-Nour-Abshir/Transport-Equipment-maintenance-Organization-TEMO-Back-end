<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

class GenerateWorkorderInformationPDF extends Controller
{
    //
    public function allWorkorders()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.all-workorders-information-generate-pdf', $data);
        return  $pdf->stream('All workorders Information.pdf');
    }
}
