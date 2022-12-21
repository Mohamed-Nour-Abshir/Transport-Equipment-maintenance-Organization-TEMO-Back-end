<?php

namespace App\Http\Controllers\ReportsPDF;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkorderLetterReportPDF extends Controller
{
    //work-order-letter-pdf
    public $minNumber;
    public function workorderLetterPDF()
    {
        $this->minNumber = DB::table('quotations')->min('company');
        $quotations =  Quotation::where('company', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        $data = [
            'quotations' => $quotations,
            'minNumber' => $this->minNumber,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.work-order-letter-pdf', $data);
        return  $pdf->stream('All quatations Information.pdf');
    }
}
