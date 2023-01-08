<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Repair report</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
        {{-- <div class="col-auto">
              <label for="fiscalYear" class="mt-2">Fiscal Year</label>
         </div>
        <div class="col-auto">
              <input type="text" class="form-control" id="fiscalYear">
        </div> --}}
        <div class="col-auto">
              <label for="vehicletype" class="mt-2">Vehicle Type</label>
         </div>
        <div class="col-auto">
              <input type="text" class="form-control" id="vehicletype" name="vehicle_type">
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
          <a href="{{route('repair-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
      </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Sl No</th>
          <th>Parts Name</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>U/Price</th>
          <th>Amount</th>
          {{-- <th>Action</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($quotations as $quotation)
        @if ($quotation->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year')))
            <tr>
              <td>{{$quotation->id}}</td>
              <td>{{$quotation->parts_name}}</td>
              <td>{{$quotation->parts->parts_unit}}</td>
              <td>{{$quotation->parts_qty}}</td>
              <td>{{$quotation->order_parts_price}}</td>
              <td>{{ number_format($quotation->order_parts_price  * $quotation->parts_qty) }}</td>
              {{-- <td><a href="{{route('pdf.quotation',['quotation_id'=>$quotation->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
            </tr>
            @endif
        @endforeach
      </tbody>
    </table>
    {{-- @endif --}}
  </div>

  <!-- main-section End -->
</div>
