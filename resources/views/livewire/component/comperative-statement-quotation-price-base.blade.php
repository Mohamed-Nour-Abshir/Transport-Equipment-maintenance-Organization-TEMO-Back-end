<div>
    <!-- main-section Start -->
    <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        <h1 class="p-1">Comperative Statement Quotation Price</h1>
        <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="comperative-statement-quotation-price-base" method="GET">
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
              <label for="supplier_id" class="form-label">Vehicle Name</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="vehicle_name" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($vehicles as $vehicle)
                      <option value="{{$vehicle->vehicle_name}}">{{$vehicle->vehicle_name}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
            </div>
        </form>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <a class="btn btn-warning mt-5 text-center printComporative">Generate Pdf <i class="fas fa-download"></i></a>
    </div>

    <div class="container p-5" id="Comperative">
    @if(isset($searchVehicleName))
    <div class="d-flex justify-content-between">
        @isset($searchVehicleName) <p>Comperative Statement for  {{$searchVehicleName}} </p>@endisset
        {{-- @isset($searchFromDate) <h1 class="h4">{{$searchFromDate}} - {{$searchToDate}}</h1> @endisset --}}
            <h1 class="h5">{{ date('Y', strtotime($searchFromDate)) }} - {{ date('Y', strtotime($searchToDate)) }}  YEAR</h1>
        {{-- <a href="{{route('pdf.comparartive-statement')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
        <p></p>
    </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SL NO.</th>
            <th>Parts Code</th>
            <th>Parts Name</th>
            <th>Manufacture</th>
            <th>Parts Unit</th>
            @foreach ($workOrders as $supplier)
                <th>{{$supplier->supplier_name}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
            @forelse ($workOrders as $item)
            {{-- @if ($item->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year'))) --}}


            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->parts_code}}</td>
                <td>{{$item->parts_name}}</td>
                <td>{{$item->parts->parts_manufacture}}</td>
                <td>{{$item->parts->parts_unit}}</td>
                @foreach ($workOrders as $workOrder)
                  <td @if($workOrder->company === $minNumber) class="bg-secondary text-dark" @endif>{{$workOrder->company}}</td>
                @endforeach
            </tr>
            {{-- @endif --}}
            @empty
                <td>No data available</td>
            @endforelse

        </tbody>
      </table>
      {{-- <p>Lowest Price Submission: </p> --}}
      @endif
    </div>

    <!-- main-section End -->

</div>



