<?php

namespace App\Http\Controllers;
use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Vehicle;
use App\Models\Supplier;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    //
    public $searchTerm;
    public $from_date;
    public $to_date;
    public $supplier_id;
    public $supplier_name;
    public $vehicle_code;
    public $vehicle_name;
    public $parts_code;
    public $parts_name;
    public $company_price;
    public $iteration = 0;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
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
    }
    public function addQuotationInformation(Request $request)
    {
        $validated = $request->validate([
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

        // $quotations = Quotation::all();
        $quotation = new Quotation();
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
        session()->flash('message', 'Quotation added successfully');
        return redirect()->route('quotation-information');
    }


    public function deleteQuotation($id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();
        session()->flash('message', 'Quotation has been deleted successfully');
        return redirect()->route('quotation-information');
    }

    public function render(Request $request)
    {
        $search = '%' . $request->searchTerm . '%';
        $quotations = Quotation::where('supplier_id', 'LIKE', $search)
            ->orwhere('supplier_name', 'LIKE', $search)
            ->orwhere('vehicle_code', 'LIKE', $search)
            ->orwhere('vehicle_name', 'LIKE', $search)
            ->orwhere('parts_code', 'LIKE', $search)
            ->orwhere('parts_name', 'LIKE', $search)
            ->orwhere('from_date', 'LIKE', $search)
            ->orwhere('to_date', 'LIKE', $search)
            ->orwhere('id', 'LIKE', $search)
            ->orderBy('id', 'DESC')->paginate(10);
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = Vehicle::all();
        return view('livewire.quotation-api-component', compact(['quotations', 'suppliers', 'parts','vehicles']));
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
            $vehicledetails = Vehicle::select('vehicle_name')->where('vehicle_code', $parent_id)->first();
            return response()->json($vehicledetails);

        }
        //generate parts data by json format
        public function findParts(Request $request){
            $parent_id = $request->parts_code;
            $partsdetails = PartsInfo::select('parts_name')->where('parts_code', $parent_id)->first();
            return response()->json($partsdetails);

        }
}
