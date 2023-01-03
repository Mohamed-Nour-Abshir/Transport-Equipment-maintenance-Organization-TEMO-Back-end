<?php

namespace App\Http\Controllers\ReportsPDF;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompretiveReoportPDF extends Controller
{
    //
    public function ComparativeStatementPDF()
    {

        $quatations = WorkOrder::orderBy('order_parts_price', 'ASC')->get();
        $minNumber = DB::table('work_orders')->min('order_parts_price');
        $data = [
            'quatations' => $quatations,
            'minNumber' => $minNumber,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.comparative-statement-pdf', $data);
        return  $pdf->stream('All quatations Information.pdf');
    }
}
