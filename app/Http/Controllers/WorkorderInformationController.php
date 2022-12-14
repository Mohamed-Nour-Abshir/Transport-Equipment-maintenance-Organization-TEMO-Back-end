<?php

namespace App\Http\Controllers;
use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Svg\Tag\Rect;

class WorkorderInformationController extends Controller
{
    //
    public $searchTerm;
    public $quotation_from;
    public $quotation_to;
    public $supplier_id;
    public $supplier_name;
    public $vehicle_code;
    public $vehicle_name;
    public $vehicle_type;
    public $parts_code;
    public $parts_name;
    public $parts_price;
    public $parts_qty;
    public $order_parts_price;
    public $order_date;
    public $parts_id;

    public function updated(Request $request, $fields)
    {
        $request->validateOnly($fields, [
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
    }
    public function addWorkorderInformation(Request $request)
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

        $workorder = new WorkOrder();
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
        $fiscalYear = date("Y");
        $fiscalYear2 = date('Y', strtotime('+1 year'));
        $workorder->fiscal_year = $fiscalYear."-".$fiscalYear2;
        $workorder->parts_id = $request->parts_id;
        $workorder->save();
        session()->flash('message', 'Workorder has been added successfully');
        return redirect()->route('workorder-information');
    }

    public function deleteWorkorder($id)
    {
        $workorder = WorkOrder::find($id);
        $workorder->delete();
        session()->flash('message', 'Workorder has been deleted successfully');
        return redirect()->route('workorder-information');
    }
    public function render(Request $request)
    {
        $search = '%' . $request->searchTerm . '%';
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = Vehicle::all();
        $workorders = WorkOrder::where('supplier_id', 'LIKE', $search)
            ->orwhere('supplier_name', 'LIKE', $search)
            ->orwhere('parts_code', 'LIKE', $search)
            ->orwhere('vehicle_code', 'LIKE', $search)
            ->orwhere('order_date', 'LIKE', $search)
            ->orwhere('id', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.workorder-api-component', compact(['suppliers', 'parts','vehicles', 'workorders']));
    }

    //generate supplier data by json format
    public function findSupplier(Request $request){
        $parent_id = $request->supplier_id;
        $supplierdetails = Supplier::select('supplier_name')->where('id', $parent_id)->first();
        return response()->json($supplierdetails);

    }

    //generate vehicle data by json format
    public function findVehicle(Request $request){
        $parent_id = $request->vehicle_code;
        $vehicledetails = Vehicle::select('vehicle_name','vehicle_type')->where('vehicle_code', $parent_id)->first();
        return response()->json($vehicledetails);

    }
    //generate parts data by json format
    public function findParts(Request $request){
        $parent_id = $request->parts_code;
        $partsdetails = PartsInfo::select('parts_name','parts_price','id')->where('parts_code', $parent_id)->first();
        return response()->json($partsdetails);

    }
}
