<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class GenerateSupplierInformationPdf extends Controller
{
    public function supplierInformation($supplierid)
    {
        if (Supplier::where('id', $supplierid)->exists()) {
            $supplier = Supplier::find($supplierid);
            $data = [
                'supplier' => $supplier,
            ];
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('livewire.admin.supplier-information-generate-pdf', $data);
            return  $pdf->stream('SupplierInformation.pdf');
        }
    }
}
