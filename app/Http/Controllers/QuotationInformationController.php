<?php

namespace App\Http\Controllers;

use App\Models\FiscalYear;
use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class QuotationInformationController extends Controller
{
    //
    public function index(Request $request)
    {
        if (request('searchTerm')) {
            $searchTerm = request('searchTerm');
            $suppliers = Supplier::all();
            $parts = PartsInfo::all();
            $vehicles = Vehicle::all();
            $fiscalyears = FiscalYear::where('id',1)->get();
            $password = FiscalYear::find(1);
            $fiscalYear = FiscalYear::find(1);
            $quotations = Quotation::where('id', $searchTerm)->orwhere('supplier_id', $searchTerm)->orwhere('parts_name', $searchTerm)->orwhere('vehicle_name', $searchTerm)->orwhere('supplier_name', $searchTerm)->paginate(10);
            return view('livewire.quotation-information-api-component', compact('quotations', 'suppliers', 'parts', 'vehicles', 'fiscalyears','password','fiscalYear'));
        }
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = Vehicle::all();
        $fiscalyears = FiscalYear::where('id',1)->get();
        $quotations = Quotation::paginate(10);
        $password = FiscalYear::find(1);
        $fiscalYear = FiscalYear::find(1);
        return view('livewire.quotation-information-api-component', compact('quotations', 'suppliers', 'parts', 'vehicles', 'fiscalyears','password','fiscalYear'));
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
        $quotation->supplier_id = $request->supplier_id;
        $quotation->supplier_name = $request->supplier_name;
        $quotation->vehicle_code = $request->vehicle_code;
        $quotation->vehicle_name = $request->vehicle_name;
        $quotation->parts_code = $request->parts_code;
        $quotation->parts_name = $request->parts_name;
        $quotation->company = $request->company;
        $fiscalYear = date('01-07-Y', strtotime('-1 year'));
        $quotation->fiscal_year = $fiscalYear;
        $quotation->parts_id = $request->parts_id;
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
        $year = FiscalYear::find(1);
        $year->start_date = $request->start_date;
        $year->end_date = $request->end_date;
        // $year->password = Hash::make($request->password);
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
        $vehicledetails['parts'] = PartsInfo::where('vehicle_code', $parent_id)->get();
        return response()->json($vehicledetails);
    }

    //generate vehicle data by json format
    public function findPrtsQuotation(Request $request)
    {
        $parent_id = $request->parts_code;
        $vehicledetails = PartsInfo::where('parts_code', $parent_id)->first();
        return response()->json($vehicledetails);
    }

    public function checkPassword(Request $request, FiscalYear $password)
    {
        // validate input data
        $validatedData = $request->validate([
            'password' => 'required',
        ]);

        $password = FiscalYear::find(1);
        // check if password is correct
        if (Hash::check($validatedData['password'], $password->password)) {
            // password is correct, show the fiscalyear
            $fiscalyears = FiscalYear::where('id',1)->get();
            return view('livewire.fiscalyear-component',compact('fiscalyears'));
        } else {
            // password is incorrect, show an error message
            return back()->with('password','Incorrect password');
        }
    }
    public function changePassword(Request $request)
    {
        $fiscalyear = FiscalYear::find(1);

        $currentPassword = $request->current_password;
        $newPassword = $request->password;

        if (Hash::check($currentPassword, $fiscalyear->password)) {
            $fiscalyear->password = Hash::make($newPassword);
            $fiscalyear->save();
            return back()->with('message','Password updated successfully!');
        } else {
            return back()->with('password','Incorrect password');
        }
    }


}
