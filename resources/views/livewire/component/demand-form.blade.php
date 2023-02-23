<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Demand Form report</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="demand-form" method="GET">
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
    <a class="btn btn-warning mb-3 text-center demand-from">Generate Pdf <i class="fas fa-download"></i></a>
  </div>
  <div class="container p-5" id="demandFrom">
    @if(isset($searchVehicleName))
      <div class="d-flex justify-content-center">
          {{-- <a href="{{route('demandForm-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
      </div>
      <div>
        <h1 class="text-decoration-underline text-center mb-2 h5">Demand From</h1>
        <p>Date : {{$searchFromDate}}</p>
        <div class="d-flex justify-content-between">
            <p class="mt-3">Vehicle Reg. No : {{$searchVehicleName}}</p>
            <h1 class="h4">Fiscal Year: {{ date('Y', strtotime($searchFromDate)) }} - {{ date('Y', strtotime($searchToDate)) }}</h1>
            <p>Let. Ref. :</p>
        </div>
    </div>
    <table class="table table-bordered mb-5">
      <thead>
        <tr>
          <th>Sl No</th>
          <th>Parts Name</th>
          <th>Unit</th>
          <th>Quantity</th>
          {{-- <th>Action</th> --}}
        </tr>
      </thead>
      <tbody>
        <?php
            $i = 0;
            ?>
        @foreach ($quotations as $quotation)
        @if ($quotation->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year')))
            <tr>
              <td>{{++ $i}}</td>
              <td>{{$quotation->parts_name}}</td>
              <td>{{$quotation->parts->parts_unit}}</td>
              <td>{{$quotation->parts_qty}}</td>
            </tr>
            @endif
        @endforeach
      </tbody>
    </table>

    <div class="d-flex justify-content-between mt-5">
        <h1><b>Requested By:</b></h1>
        <h1><b>Forwarded By:</b></h1>
        <h1><b>Approved  By:</b></h1>
    </div>
    @endif
  </div>

  <!-- main-section End -->
</div>
