<div>
        <!-- main-section Start -->
        <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            <h1 class="p-1">Vehcile Reg As Respect Workorder</h1>
            <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="vehcile-reg-as-respect-workorder" method="GET">
                {{-- <div class="col-auto">
                      <label for="fiscalYear" class="mt-2">Fiscal Year</label>
                 </div>
                <div class="col-auto">
                      <input type="text" class="form-control" id="fiscalYear">
                </div> --}}
            <div class="col-auto">
              <label for="supplier_id" class="form-label">Vehicle Type</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="vehicle_type" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($vehicles as $vehicle)
                      <option value="{{$vehicle->vehicle_type}}">{{$vehicle->vehicle_type}}</option>
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
            <a class="btn btn-warning mb-3 text-center printVehicleRegWorkorder">Generate Pdf <i class="fas fa-download"></i></a>
        </div>
        <div class="container p-5" id="vehicleRegAsRespectedWorkorder">
          @if(isset($searchVehicleName))
            <div class="d-flex justify-content-center">
                {{-- <a href="{{route('vehicle-reg-as-respectedWorkorder')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
            </div>
            <div>
                <h1 class="text-decoration-underline text-center mb-2 h5">Vehicle Report Order Wise</h1>
                <p class="text-center mb-3"><span class="me-5"> Period From: {{$searchFromDate}}</span>   <span class="">To: {{$searchToDate}}</span></p>
                <p class="text-start"><b class="me-5"> Reg. No-  {{$searchVehicleName}}</b></p>
                <p class="text-center mb-3"><b class="me-5"> Fiscal Year :   {{ date('Y', strtotime($searchFromDate)) }} - {{ date('Y', strtotime($searchToDate)) }}</b></p>
            </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Parts Name</th>
                <th>Unit</th>
                <th>Qty</th>
                <th>U/Price</th>
                <th>Amount</th>
                <th>Supplier Name</th>
                {{-- <th>Action</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($quotations as $workorder)
              {{-- @if ($workorder->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year'))) --}}
                  <tr>
                    <td>{{$workorder->order_no}}</td>
                    <td>{{$workorder->order_date}}</td>
                    <td>{{$workorder->parts_name}}</td>
                    <td>{{$workorder->parts->parts_unit}}</td>
                    <td>{{$workorder->parts_qty}}</td>
                    <td>{{$workorder->parts_price}}</td>
                    <td>{{ number_format($workorder->parts_price  * $workorder->parts_qty) }}</td>
                    <td>{{$workorder->supplier_name}}</td>
                    {{-- <td><a href="{{route('pdf.quotation',['quotation_id'=>$workorder->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
                  </tr>
                  {{-- @endif --}}
              @endforeach
            </tbody>
          </table>
          @php
          $totalPrice = 0;
        @endphp
          @foreach ($quotations as $item)
              @php
              $totalPrice += $item->order_parts_price;
              @endphp
          @endforeach
          <h1 class="text-center" style="margin-left: 350px;">Order Total (TK.) : <b>{{$totalPrice}}</b></h1>
          @endif
        </div>

        <!-- main-section End -->
</div>
