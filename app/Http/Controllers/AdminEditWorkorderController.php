<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\WorkOrder;
class AdminEditWorkorderController extends Controller
{
    public function editWorkorderInformation(Request $request, $id)
    {
        $request->validate([
            'quotation_from' => 'required',
            'quotation_to' => 'required',
            'supplier_id' => 'required',
            'supplier_name' => 'required',
            'vehicle_code' => 'required',
            'vehicle_name' => 'required',
            'vehicle_type' => 'required',
            'parts_code' => 'required',
            'parts_name' => 'required',
            'parts_price' => 'required',
            'parts_qty' => 'required',
            'order_parts_price' => 'required',
            'order_date' => 'required|date'
        ]);

        $workorder = WorkOrder::find($id);
        $workorder->quotation_from = $request->quotation_from;
        $workorder->quotation_to = $request->quotation_to;
        $workorder->supplier_id = $request->supplier_id;
        $workorder->supplier_name = $request->supplier_name;
        $workorder->vehicle_code = $request->vehicle_code;
        $workorder->vehicle_name = $request->vehicle_name;
        $workorder->vehicle_type = $request->vehicle_type;
        $workorder->parts_code = $request->parts_code;
        $workorder->parts_name = $request->parts_name;
        $workorder->parts_price = $request->parts_price;
        $workorder->parts_qty = $request->parts_qty;
        $workorder->order_parts_price = $request->order_parts_price;
        $workorder->order_date = $request->order_date;
        $workorder->order_no = $request->order_no;
        $workorder->save();
        session()->flash('message', 'Workorder has been Updated successfully');
        return redirect()->route('workorder-information');
    }
    public function render($id)
    {
        $workorder = WorkOrder::find($id);
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = Vehicle::all();
        return view('livewire.admin.admin-edit-workorder-information', compact('suppliers','parts','vehicles','workorder'));
    }

    //generate supplier data by json format
    public function findSupplierWorkorder(Request $request)
    {
        $parent_id = $request->supplier_id;
        $supplierdetails = Supplier::select('supplier_name')->where('id', $parent_id)->first();
        return response()->json($supplierdetails);
    }

    //generate vehicle data by json format
    public function findVehicleWorkorderEdit(Request $request)
    {
        $parent_id = $request->vehicle_code;
        $vehicledetails = Vehicle::select('vehicle_name', 'vehicle_type')->where('vehicle_code', $parent_id)->first();
        return response()->json($vehicledetails);
    }
    //generate parts data by json format
    public function findPartsWorkorder(Request $request)
    {
        $parent_id = $request->parts_code;
        $partsdetails = PartsInfo::select('parts_name')->where('parts_code', $parent_id)->first();
        return response()->json($partsdetails);
    }
}
