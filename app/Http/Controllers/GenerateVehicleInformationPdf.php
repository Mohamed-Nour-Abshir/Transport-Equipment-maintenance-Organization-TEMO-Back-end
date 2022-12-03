<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class GenerateVehicleInformationPdf extends Controller
{
    //generate pdf single data
    public function vehicleInformation($vehicle_id)
    {
        if (Vehicle::where('id', $vehicle_id)->exists()) {
            $vehicle = Vehicle::find($vehicle_id);
            $data = [
                'vehicle' => $vehicle,
            ];
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('livewire.admin.pdf.vehicle-information-generate-pdf', $data);
            return  $pdf->stream('Vehiclermation.pdf');
        }
    }

    public function allVehicleInformation()
    {

        $vehicles = Vehicle::all();
        $data = [
            'vehicles' => $vehicles,
        ];
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('livewire.admin.pdf.all-vehicles-information-generate-pdf', $data);
        return  $pdf->stream('All vehicles Information.pdf');
    }
}
