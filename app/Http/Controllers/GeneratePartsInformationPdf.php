<?php

namespace App\Http\Controllers;

use App\Models\PartsInfo;
use Illuminate\Http\Request;

class GeneratePartsInformationPdf extends Controller
{
    //generate single parts info
    public function partInformation($partid)
    {
        if (PartsInfo::where('id', $partid)->exists()) {
            $part = PartsInfo::find($partid);
            $data = [
                'part' => $part,
            ];
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('livewire.admin.pdf.parts-information-generate-pdf', $data);
            return  $pdf->stream('partsInformation.pdf');
        }
    }

    public function allPartsInformation()
    {
        $min_price = 1;
        $max_price = 10000000;


        $parts = PartsInfo::whereBetween('parts_price', [$min_price, $max_price])->orderBy('parts_price', 'ASC')->get();
        $data = [
            'parts' => $parts,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.all-parts-information-generate-pdf', $data);
        return  $pdf->stream('All parts Information.pdf');
    }
}
