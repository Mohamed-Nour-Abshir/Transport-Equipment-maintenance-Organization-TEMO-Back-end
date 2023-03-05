<div>
    <!-- main-section Start -->
    <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        <h1 class="p-1">Quotation Lowest Price</h1>
        <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="quotation-lowest-price" method="GET">
            <div class="col-auto">
                <label for="fromdate" class="mt-2">From Date</label>
                </div>
                <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="from_date" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($fiscal_year as $item)
                      <option value="{{$item->start_date}}">{{date("d/m/Y", strtotime($item->start_date))}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-auto">
              <label for="todate" class="mt-2">To Date</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="to_date" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($fiscal_year as $item)
                      <option value="{{$item->end_date}}">{{date("d/m/Y", strtotime($item->end_date))}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-auto">
              <label for="supplier_id" class="form-label">Vehicle Name</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="vehicle_name" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($vehicles as $vehicle)
                  @if ($vehicle->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
                      <option value="{{$vehicle->vehicle_name}}">{{$vehicle->vehicle_name}}</option>
                  @endif
                  @endforeach
              </select>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
            </div>
          </form>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a class="btn btn-warning mb-3 text-center printQuotationLowestPrice">Generate Pdf <i class="fas fa-download"></i></a>
    </div>

    <div class="container p-5" id="Quotation">
    @if(isset($searchVehicleName))
    <div>
        <h1 class="text-decoration-underline text-center mb-2 h5">Vehicle Wise</h1>
        <p class="text-center mb-3"><span class="me-5"> Period From: {{date("d/m/Y", strtotime($searchFromDate))}}</span>   <span class="">To: {{date("d/m/Y", strtotime($searchToDate))}}</span></p>
    </div>
    <div class="d-flex justify-content-between">
        <h1 class="h6"><b>Fiscal Year: {{ date('Y', strtotime($searchFromDate)) }} - {{ date('Y', strtotime($searchToDate)) }}</b></h1>
        {{-- <a href="{{route('pdf.quotationLowestPrice')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
        <p>Print {{date("d-m-Y")}}</p>
    </div>
    <p class="mb-2 mt-2">Lowest Price for Comperative statment for {{$searchVehicleName}}</p>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Parts Code</th>
            <th>Parts Name</th>
            <th>Manufacture</th>
            <th>Parts Unit</th>
            <th>Price</th>
            <th>Party Name</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($quotations as $item)
            @if ($item->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
            <tr>
                <td>{{$item->parts_code}}</td>
                <td>{{$item->parts_name}}</td>
                <td>{{$item->parts->parts_manufacture}}</td>
                <td>{{$item->parts->parts_unit}}</td>
                <td>{{$item->company}}</td>
               <td>{{$item->supplier_name}}</td>
            </tr>
            @endif
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
