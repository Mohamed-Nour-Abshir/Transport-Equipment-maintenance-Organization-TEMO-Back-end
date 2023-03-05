<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Repair report</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="repair" method="GET">
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
  <div class="d-flex justify-content-center mt-5">
    <a class="btn btn-warning mb-3 text-center repair">Generate Pdf <i class="fas fa-download"></i></a>
  </div>
  <div class="container p-5" id="repair">
    @if(isset($searchVehicleName))
      <div class="d-flex justify-content-center">
          {{-- <a href="{{route('repair-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
      </div>
      <div>
        <h1 class="text-decoration-underline text-center mb-5 h5"><b>Repair Report</b> </h1>
    </div>
    <table class="table table-bordered">
        <div class="d-flex justify-content-between mb-2">
            <p class="mb-2"><b>Vehicle Name : </b> {{$searchVehicleName}}</p>
            <p><b>Department : </b></p>
            <p><b>Entry Date : </b></p>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <p><b>Repair Done By : </b></p>
            <p><b>Let. Ref. : </b></p>
        </div>
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
        <?php
            $i = 0;
            ?>
        @foreach ($quotations as $quotation)
        {{-- @if ($quotation->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year'))) --}}
            <tr>
              <td>{{++ $i}}</td>
              <td>{{$quotation->parts_name}}</td>
              <td>{{$quotation->parts->parts_unit}}</td>
              <td>{{$quotation->parts_qty}}</td>
              <td>{{$quotation->parts_price}}</td>
              <td>{{ $quotation->parts_price * $quotation->parts_qty}}</td>
              {{-- <td><a href="{{route('pdf.quotation',['quotation_id'=>$quotation->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
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
    <h1 class="text-center float-end" style="margin-left: 350px;">Order Total (TK.) : <b>{{ $totalPrice}}</b></h1>
    <table class="table ">
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Taka</th>
            </tr>
        </thead>
        <tbody class="">
            <tr>
                <td>Engin Oil</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Kerosine</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Break Oil</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Gear Oil</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Steerin Oil</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Hydraulic</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Grease</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Petrol</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Diesel</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-between mt-5">
        <h1 class="h6"><b>Prepared By</b></h1>
        <h1 class="h6"><b>Compared By</b></h1>
    </div>
    @endif
  </div>

  <!-- main-section End -->
</div>
