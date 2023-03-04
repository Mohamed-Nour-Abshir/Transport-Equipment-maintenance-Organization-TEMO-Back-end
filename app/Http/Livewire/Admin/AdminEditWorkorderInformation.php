<?php

namespace App\Http\Livewire\Admin;

use App\Models\PartsInfo;
use App\Models\Quotation;
use App\Models\Supplier;
use App\Models\Vehicle;
use App\Models\WorkOrder;
use Livewire\Component;

class AdminEditWorkorderInformation extends Component
{
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
    public $order_no;
    public $workorder_id;

    public function mount()
    {
        $workorder = WorkOrder::find($this->workorder_id);
        $this->quotation_from = $workorder->quotation_from;
        $this->quotation_to = $workorder->quotation_to;
        $this->supplier_id = $workorder->supplier_id;
        $this->supplier_name = $workorder->supplier_name;
        $this->vehicle_code = $workorder->vehicle_code;
        $this->vehicle_name = $workorder->vehicle_name;
        $this->vehicle_type = $workorder->vehicle_type;
        $this->parts_code = $workorder->parts_code;
        $this->parts_name = $workorder->parts_name;
        $this->parts_price = $workorder->parts_price;
        $this->parts_qty = $workorder->parts_qty;
        $this->order_parts_price = $workorder->order_parts_price;
        $this->order_date = $workorder->order_date;
        $this->order_no = $workorder->order_no;
        $this->workorder_id = $workorder->id;
    }

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

        $workorder = WorkOrder::find($this->workorder_id);
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
        $workorder->order_no = $this->order_no;
        $workorder->save();
        session()->flash('message', 'Workorder has been Updated successfully');
        return redirect()->route('workorder-information');
    }
    public function render()
    {
        $suppliers = Supplier::all();
        $parts = PartsInfo::all();
        $vehicles = Vehicle::all();
        return view('livewire.admin.admin-edit-workorder-information', ['suppliers' => $suppliers, 'parts' => $parts, 'vehicles' => $vehicles])->layout('layouts.test');
    }
}
