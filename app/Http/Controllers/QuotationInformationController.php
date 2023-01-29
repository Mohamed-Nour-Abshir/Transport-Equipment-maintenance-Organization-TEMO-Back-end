<?php

namespace App\Http\Controllers;

use App\Models\FiscalYear;
use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class QuotationInformationController extends Controller
{
    //
    public function index(Request $request)
    {
        if (request('searchTerm')) {
            $searchTerm = request('searchTerm');
            $suppliers = Supplier::all();
            $parts = PartsInfo::all();
            $vehicles = PartsInfo::all();
            $fiscalyears = FiscalYear::all();
            $quotations = Quotation::where('id', $searchTerm)->orwhere('supplier_id', $searchTerm)->orwhere('parts_name', $searchTerm)->orwhere('vehicle_name', $searchTerm)->orwhere('supplier_name', $searchTerm)->paginate(10);
            return view('livewire.quotation-information-api-component', compact('quotations', 'suppliers', 'parts', 'vehicles','fiscalyears'));
        }
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = PartsInfo::all();
        $fiscalyears = FiscalYear::all();
        $quotations = Quotation::paginate(10);
        return view('livewire.quotation-information-api-component', compact('quotations', 'suppliers', 'parts', 'vehicles','fiscalyears'));
    }


    // addQuotationInformation
    public function addQuotation(Request $request)
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
            'company' => 'required'
        ]);
        // Quotation::create($request->all());
        $quotation = new Quotation();
        $quotation->from_date = $request->from_date;
        $quotation->to_date = $request->to_date;
        $quotation->parts_id = $request->parts_id;
        $quotation->supplier_id = $request->supplier_id;
        $quotation->supplier_name = $request->supplier_name;
        $quotation->vehicle_code = $request->vehicle_code;
        $quotation->vehicle_name = $request->vehicle_name;
        $quotation->parts_code = $request->parts_code;
        $quotation->parts_name = $request->parts_name;
        $quotation->company = $request->company;
        $quotation->save();
        // dd($request->supplier_id);
        session()->flash('message', 'Quotation has been added successfully');
        return redirect()->route('quotationInformation');
    }


    // add fiscal_year
    public function addFiscalYear(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $year = new FiscalYear();
        $year->start_date = $request->start_date;
        $year->end_date = $request->end_date;
        $year->save();
        session()->flash('message', 'Fisacal year added successfully');
        return redirect()->route('quotationInformation');
    }



    public function deleteQuotation($id)
    {
        $quotation = Quotation::find($id);
        $quotation->delete();

        session()->flash('message', 'Quotation has been deleted successfully');
        return redirect()->route('quotationInformation');
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
        $vehicledetails = PartsInfo::select('parts_name', 'parts_code', 'vehicle_name')->where('vehicle_code', $parent_id)->first();
        return response()->json($vehicledetails);
    }
}
