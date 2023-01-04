<?php

namespace App\Http\Controllers\ReportsPDF;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class GeneratePDFall extends Controller
{
    //vehicle-reg-wise as respected workorder pdf
    public function vehicleRegWiseAsRespectedWorkorder()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.vehicle-reg-wise-as-respected-workorder-pdf', $data);
        return  $pdf->stream('vehicle-reg-wise as respected workorder.pdf');
    }


    //spare-parts wise as respected workorder pdf
    public function sparePartsWiseAsRespectedWorkorder()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.spareparts-reg-wise-as-respected-workorder-pdf', $data);
        return  $pdf->stream('spareParts-reg-wise as respected workorder.pdf');
    }


    //supplier report pdf
    public function supplierReportPdf()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.supplier-reportPdf', $data);
        return  $pdf->stream('supplier report.pdf');
    }


    //supplier report pdf
    public function repairReportPdf()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.repair-reportPdf', $data);
        return  $pdf->stream('repair report.pdf');
    }


    //demand form report pdf
    public function demandFormReoprtPdf()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.demand-from-report-pdf', $data);
        return  $pdf->stream('Demand From report.pdf');
    }


    //Workorder total report pdf
    public function workorderTotal()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.workorder-total-report-pdf', $data);
        return  $pdf->stream('workorder Total report.pdf');
    }


    //repair vehicle list report pdf
    public function repairVehicleList()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.repair-vehicle-list-report-pdf', $data);
        return  $pdf->stream('repair Vehicle List report.pdf');
    }


    //Dead Stock report pdf
    public function deadStock()
    {

        $workorders = WorkOrder::all();
        $data = [
            'workorders' => $workorders,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.ReportsPDF.dead-stock-report-pdf', $data);
        return  $pdf->stream('dead stock report.pdf');
    }
}
