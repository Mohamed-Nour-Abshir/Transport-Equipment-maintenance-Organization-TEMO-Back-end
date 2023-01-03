<?php

namespace App\Http\Controllers\ReportsPDF;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationLowestPriceReportPDF extends Controller
{
    //
    public $minNumber;
    public function quotationLowestPrice()
    {
        $this->minNumber = DB::table('work_orders')->min('order_parts_price');
        $quotations =  WorkOrder::where('order_parts_price', '=', $this->minNumber)->orderBy('id', 'asc')->get();
        $data = [
            'quotations' => $quotations,
            'minNumber' => $this->minNumber,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.quotation-lowest-price-pdf', $data);
        return  $pdf->stream('All quatations Information.pdf');
    }
}
