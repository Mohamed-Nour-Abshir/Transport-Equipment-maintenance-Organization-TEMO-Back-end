<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Supplier report</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="supplier-report" method="GET">
        {{-- <div class="col-auto">
              <label for="fiscalYear" class="mt-2">Fiscal Year</label>
         </div>
        <div class="col-auto">
              <input type="text" class="form-control" id="fiscalYear">
        </div> --}}
        <div class="col-auto">
              <label for="partyName" class="mt-2">Party Name</label>
         </div>
        <div class="col-auto">
              <input type="text" class="form-control" id="partyName" name="supplier_name">
        </div>
        <div class="col-auto">
          <label for="fromdate" class="mt-2">From Date</label>
        </div>
        <div class="col-auto">
          <input type="date" class="form-control" id="fromdate" name="from_date">
        </div>
        <div class="col-auto">
          <label for="todate" class="mt-2">To Date</label>
        </div>
        <div class="col-auto">
          <input type="date" class="form-control" id="todate" name="to_date">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
        </div>
      </form>
  </div>

  <div class="container p-5">
    {{-- @if($showTableQuotationTable) --}}
      <div class="d-flex justify-content-center">
          <a href="{{route('supplier-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
      </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order No</th>
          <th>Workorder Date</th>
          <th>Vehicle Type</th>
          <th>Parts Code</th>
          <th>Parts Name</th>
          <th>Menufacture</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>U/Price</th>
          <th>Amount</th>
          {{-- <th>Action</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($quotations as $workorder)
            <tr>
              <td>{{$workorder->order_no}}</td>
              <td>{{$workorder->quotation_from}}</td>
              <td>{{$workorder->vehicle_type}}</td>
              <td>{{$workorder->parts_code}}</td>
              <td>{{$workorder->parts_name}}</td>
              <td>{{$workorder->parts->parts_manufacture}}</td>
              <td>{{$workorder->parts->parts_unit}}</td>
              <td>{{$workorder->parts_qty}}</td>
              <td>{{$workorder->order_parts_price}}</td>
              <td>{{ number_format($workorder->order_parts_price  * $workorder->parts_qty) }}</td>
              {{-- <td><a href="{{route('pdf.workorder',['workorder_id'=>$workorder->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
            </tr>
        @endforeach
      </tbody>
    </table>
    {{-- @endif --}}
  </div>

  <!-- main-section End -->
</div>
