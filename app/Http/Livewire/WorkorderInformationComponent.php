<?php

namespace App\Http\Livewire;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use Livewire\Component;

class WorkorderInformationComponent extends Component
{
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

    public function updated($fields)
    {
        $this->validateOnly($fields, [
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
    public function addWorkorderInformation()
    {
        $this->validate([
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
        $workorder->quotation_from = $this->quotation_from;
        $workorder->quotation_to = $this->quotation_to;
        $workorder->supplier_id = $this->supplier_id;
        $workorder->supplier_name = $this->supplier_name;
        $workorder->vehicle_code = $this->vehicle_code;
        $workorder->vehicle_name = $this->vehicle_name;
        $workorder->vehicle_type = $this->vehicle_type;
        $workorder->parts_code = $this->parts_code;
        $workorder->parts_name = $this->parts_name;
        $workorder->parts_price = $this->parts_price;
        $workorder->parts_qty = $this->parts_qty;
        $workorder->order_parts_price = $this->order_parts_price;
        $workorder->order_date = $this->order_date;
        $workorder->parts_id = $this->parts_id;
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
    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
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
        return view('livewire.workorder-information-component', ['suppliers' => $suppliers, 'parts' => $parts, 'vehicles' => $vehicles, 'workorders' => $workorders])->layout('layouts.base');
    }
}
