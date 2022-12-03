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

        $parts = PartsInfo::all();
        $data = [
            'parts' => $parts,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.all-parts-information-generate-pdf', $data);
        return  $pdf->stream('All parts Information.pdf');
    }
}
