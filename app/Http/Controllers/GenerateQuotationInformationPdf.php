<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;

class GenerateQuotationInformationPdf extends Controller
{
    //
    //generate single parts info
    public function quotationInformation($quotation_id)
    {
        if (Quotation::where('id', $quotation_id)->exists()) {
            $quotation = Quotation::find($quotation_id);
            $data = [
                'quotation' => $quotation,
            ];
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('livewire.admin.pdf.quotation-information-generate-pdf', $data);
            return  $pdf->stream('quotationInformation.pdf');
        }
    }

    public function allquotationsInformation()
    {

        $quatations = Quotation::all();
        $data = [
            'quatations' => $quatations,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.all-quatations-information-generate-pdf', $data);
        return  $pdf->stream('All quatations Information.pdf');
    }
}
