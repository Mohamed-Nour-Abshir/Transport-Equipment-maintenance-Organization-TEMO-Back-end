<div>
    <!-- main-section Start -->
    <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        <h1 class="p-1">Comperative Statement Quotation Price</h1>
        <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="comperative-statement-quotation-price-base" method="GET">
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
            <label for="vehiclename" class="mt-2">Vehicle Name</label>
            </div>
            <div class="col-auto">
            <input type="text" class="form-control" id="vehiclename" name="vehicle_name">
            </div>
            <div class="col-auto">
            <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
            </div>
        </form>
        </div>
    </div>

    <div class="container p-5">
    {{-- @if($showTableQuotationTable) --}}
    <div class="d-flex justify-content-between">
        <h1 class="h4">Fiscal Year: <?php echo date("Y");?>-<?php echo date('Y', strtotime('+1 year'));?></h1>
        <a href="{{route('pdf.comparartive-statement')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
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
            @foreach ($quotations as $supplier)
                <th>{{$supplier->supplier_name}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
        @if(isset($searchVehicleName))
            @forelse ($quotations as $item)
            @if ($item->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year')))


            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->parts_code}}</td>
                <td>{{$item->parts_name}}</td>
                <td>{{$item->parts->parts_manufacture}}</td>
                <td>{{$item->parts->parts_unit}}</td>
                @foreach ($quotations as $quotation)
                  <td @if($quotation->order_parts_price === $minNumber) class="bg-secondary text-dark" @endif>{{$quotation->order_parts_price}}</td>
                @endforeach
            </tr>
            @endif
            @empty
                <td>No data available</td>
            @endforelse
            @endif

        </tbody>
      </table>
      {{-- <p>Lowest Price Submission: </p> --}}
      {{-- @endif --}}
    </div>

    <!-- main-section End -->

</div>
