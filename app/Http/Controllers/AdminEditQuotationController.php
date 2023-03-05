<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
class AdminEditQuotationController extends Controller
{
    public function updateQuotationInformation(Request $request, $id)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'supplier_id' => 'required',
            'supplier_name' => 'required',
            'vehicle_code' => 'required',
            'vehicle_name' => 'required',
            'parts_code' => 'required',
            'parts_name' => 'required',
            'company_price' => 'required'
        ]);

        $quotation = Quotation::find($id);
        $quotation->from_date = $request->from_date;
        $quotation->to_date = $request->to_date;
        $quotation->supplier_id = $request->supplier_id;
        $quotation->supplier_name = $request->supplier_name;
        $quotation->vehicle_code = $request->vehicle_code;
        $quotation->vehicle_name = $request->vehicle_name;
        $quotation->parts_code = $request->parts_code;
        $quotation->parts_name = $request->parts_name;
        $quotation->company = $request->company_price;
        $quotation->save();
        session()->flash('message', 'Quotation Updated successfully');
        return redirect()->route('quotationInformation');
    }

    public function render($id)
    {
        $quotation = Quotation::find($id);
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = Vehicle::all();
        return view('livewire.admin.admin-update-quotation-information', ['suppliers' => $suppliers, 'parts' => $parts, 'vehicles' => $vehicles, 'quotation' => $quotation]);
    }

     //generate supplier data by json format
     public function findSupplierQuotation(Request $request)
     {
         $parent_id = $request->supplier_id;
         $supplierdetails = Supplier::select('supplier_name')->where('id', $parent_id)->first();
         return response()->json($supplierdetails);
     }

     //generate vehicle data by json format
     public function findVehicleQuotation(Request $request)
     {
         $parent_id = $request->vehicle_code;
         $vehicledetails = Vehicle::select('vehicle_name')->where('vehicle_code', $parent_id)->first();
         return response()->json($vehicledetails);
     }
     //generate parts data by json format
     public function findPartsQuotation(Request $request)
     {
         $parent_id = $request->parts_code;
         $partsdetails = PartsInfo::select('parts_name')->where('parts_code', $parent_id)->first();
         return response()->json($partsdetails);
     }
}
