<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Dead Stock Report</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
        <div class="col-auto">
              <label for="fiscalYear" class="mt-2">Fiscal Year</label>
         </div>
        <div class="col-auto">
              <input type="text" class="form-control" id="fiscalYear" name="fiscal_year">
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
          <a href="{{route('dead-stock-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
      </div>
      <h1 class="h4">Fiscal Year: <?php echo date("Y");?>-<?php echo date('Y', strtotime('+1 year'));?></h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order No</th>
          <th>Order Date</th>
          <th>Vehicle Type</th>
          <th>Parts Name</th>
          <th>Unit</th>
          <th>Quantity</th>
          <th>Remarks</th>
          {{-- <th>Action</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($quotations as $quotation)
        @if ($quotation->fiscal_year !== date("Y")."-".date('Y', strtotime('+1 year')))
            <tr>
              <td>{{$quotation->id}}</td>
              <td>{{$quotation->order_date}}</td>
              <td>{{$quotation->vehicle_type}}</td>
              <td>{{$quotation->parts_name}}</td>
              <td>{{$quotation->parts->parts_unit}}</td>
              <td>{{$quotation->parts_qty}}</td>
              <td></td>
              {{-- <td><a href="{{route('pdf.quotation',['quotation_id'=>$quotation->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
              @endif
            </tr>
        @endforeach
      </tbody>
    </table>
    {{-- @endif --}}
  </div>

  <!-- main-section End -->
</div>
