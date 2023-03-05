<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Dead Stock Report</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
        {{-- <div class="col-auto">
              <label for="fiscalYear" class="mt-2">Fiscal Year</label>
         </div>
        <div class="col-auto">
              <input type="text" class="form-control" id="fiscalYear" name="fiscal_year">
        </div> --}}
        <div class="col-auto">
            <label for="fromdate" class="mt-2">From Date</label>
            </div>
            <div class="col-auto">
            <select class="form-select selectpicker" aria-label="Default select example" name="from_date" data-live-search="true" data-style="py-0" id="supplier_id">
                @foreach ($fiscal_year as $item)
                    <option value="{{$item->start_date}}">{{$item->start_date}}</option>
                @endforeach
            </select>
          </div>
          <div class="col-auto">
            <label for="todate" class="mt-2">To Date</label>
          </div>
          <div class="col-auto">
            <select class="form-select selectpicker" aria-label="Default select example" name="todate" data-live-search="true" data-style="py-0" id="supplier_id">
                @foreach ($fiscal_year as $item)
                    <option value="{{$item->end_date}}">{{$item->end_date}}</option>
                @endforeach
            </select>
          </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
        </div>
      </form>
  </div>

    <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-warning mb-3 text-center deadStock">Generate Pdf <i class="fas fa-download"></i></a>
    </div>

  <div class="container p-5" id="deadStock">
    {{-- @if(isset($searchVehicleName)) --}}
      {{-- <div class="d-flex justify-content-center">
          <a href="{{route('dead-stock-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
      </div> --}}
      {{-- <h1 class="h4">Fiscal Year: {{ date('Y', strtotime($searchFromDate)) }} - {{ date('Y', strtotime($searchToDate)) }}</h1>
      <h1 class="h6 text-center"><span class="me-5"> Period From: {{$searchFromDate}}</span>   <span class="">To: {{$searchToDate}}</span></h1> --}}
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
        <?php
            $i = 0;
        ?>
        @foreach ($quotations as $quotation)
        @if ($quotation->fiscal_year !== date('d-m-Y',strtotime($fiscalYear->start_date)))
            <tr>
              <td>{{++ $i}}</td>
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
