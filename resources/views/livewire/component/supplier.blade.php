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
              <label for="supplier_id" class="form-label">Party Name</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="supplier_name" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($vehicles as $vehicle)
                      <option value="{{$vehicle->supplier_name}}">{{$vehicle->supplier_name}}</option>
                  @endforeach
              </select>
            </div>
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
              <select class="form-select selectpicker" aria-label="Default select example" name="to_date" data-live-search="true" data-style="py-0" id="supplier_id">
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
  <div class="d-flex justify-content-center mt-5">
    <a  class="btn btn-warning mb-3 text-center supplier">Generate Pdf <i class="fas fa-download"></i></a>
  </div>
  <div class="container p-5" id="supplier">
    @if(isset($searchVehicleName))
      <div class="d-flex justify-content-center">
          {{-- <a href="{{route('supplier-reportPdf')}}" class="btn btn-warning mb-3 text-center supplier">Generate Pdf <i class="fas fa-download"></i></a> --}}
      </div>
      <div>
        <h1 class="text-decoration-underline text-center mb-2 h5">Supplier Report</h1>
        <p class="text-center mb-3"><span class="me-5"> Period From: {{$searchFromDate}}</span>   <span class="">To: {{$searchToDate}}</span></p>
        {{-- <p class="text-center me-5">Fiscal Year</p> --}}
    </div>
    <table class="table table-bordered">
        <p class="text-start">Party Name: {{$searchVehicleName}}</p>
        <p class="text-end">Print Date : {{date("d-m-Y")}}</p>
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
        @if ($workorder->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year')))
            <tr>
              <td>{{$workorder->order_no}}</td>
              <td>{{$workorder->quotation_from}}</td>
              <td>{{$workorder->vehicle_type}}</td>
              <td>{{$workorder->parts_code}}</td>
              <td>{{$workorder->parts_name}}</td>
              <td>{{$workorder->parts->parts_manufacture}}</td>
              <td>{{$workorder->parts->parts_unit}}</td>
              <td>{{$workorder->parts_qty}}</td>
              <td>{{$workorder->parts_price}}</td>
              <td>{{ number_format($workorder->order_parts_price) }}</td>
              {{-- <td><a href="{{route('pdf.workorder',['workorder_id'=>$workorder->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
            </tr>
            @endif
        @endforeach
      </tbody>
    </table>
    @endif
  </div>

  <!-- main-section End -->
</div>
