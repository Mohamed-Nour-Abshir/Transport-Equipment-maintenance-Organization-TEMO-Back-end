<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Order Total</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
        {{-- <div class="col-auto">
              <label for="supplier_id" class="form-label">Vehicle Type</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="vehicle_type" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($vehicles as $vehicle)
                      <option value="{{$vehicle->vehicle_type}}">{{$vehicle->vehicle_type}}</option>
                  @endforeach
              </select>
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

        {{-- <div class="col-1">
          <label for="from-order" class="mt-2">From Order No</label>
        </div>
        <div class="col-2">
        <select class="form-select selectpicker" aria-label="Default select example" name="order_no" data-live-search="true" data-style="py-0" id="supplier_id">
            @foreach ($vehicles as $vehicle)
                <option value="{{$vehicle->order_no}}">{{$vehicle->order_no}}</option>
            @endforeach
              </select>
        </div> --}}
        {{-- <div class="col-2">
          <label for="to-order" class="mt-2">To Order</label>
        </div>
        <div class="col-2">
          <input type="text" class="form-control" id="to-order">
        </div> --}}
        <div class="col-1">
          <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
        </div>
      </form>
  </div>
  <div class="d-flex justify-content-center mt-5">
    <a class="btn btn-warning mb-3 text-center workorderTotal">Generate Pdf <i class="fas fa-download"></i></a>
  </div>
  <div class="container p-5" id="workorderTotal">
    @if(isset($searchFromDate))
      <div class="d-flex justify-content-center">
          {{-- <a href="{{route('workorder-total-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
      </div>
      <div>
        <h1 class="text-decoration-underline text-center mb-2 h5">Order Total</h1>
        <p class="text-center mb-3"><span class="me-5"> Period From: {{$searchFromDate}}</span>   <span class="">To: {{$searchToDate}}</span></p>
        <h1><b>Fiscal Year : {{ date('Y', strtotime($searchFromDate)) }} - {{ date('Y', strtotime($searchToDate)) }}</b></h1>
    </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Order No</th>
          <th>Workorder Date</th>
          <th>Quantity</th>
          <th>Amount</th>
          <th>Supplier Name</th>
          {{-- <th>Action</th> --}}
        </tr>
      </thead>
      <tbody>
        @foreach ($quotations as $quotation)
        @if ($quotation->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
            <tr>
              <td>{{$quotation->order_no}}</td>
              <td>{{$quotation->order_date}}</td>
              <td>{{$quotation->parts_qty}}</td>
              <td>{{ $quotation->parts_qty * $quotation->parts_price}}</td>
              <td>{{$quotation->supplier_name}}</td>
              {{-- <td><a href="{{route('pdf.quotation',['quotation_id'=>$quotation->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
            </tr>
            @endif
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
    @if ($item->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
        <h1 class="text-center" style="margin-left: 150px;"><span class="float-start">Total Workorder (TK) : </span><b class="" style="margin-left: -130px;">{{$totalPrice}}</b></h1>
    @endif
    @endif
  </div>

  <!-- main-section End -->
</div>
