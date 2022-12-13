{{-- <div>
        <!-- main-section Start -->
        <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            <h1 class="p-1">Comperative Statement Quotation Price</h1>
            <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
              <div class="col-auto">
                <label for="fromdate" class="mt-2">From Date</label>
              </div>
              <div class="col-auto">
                <input type="date" class="form-control" id="fromdate">
              </div>
              <div class="col-auto">
                <label for="todate" class="mt-2">To Date</label>
              </div>
              <div class="col-auto">
                <input type="date" class="form-control" id="todate">
              </div>
              <div class="col-auto">
                <label for="vehiclename" class="mt-2">Vehicle Name</label>
              </div>
              <div class="col-auto">
                <input type="text" class="form-control" id="vehiclename">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
              </div>
            </form>
        </div>

        <div class="container p-5">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Parts Code</th>
                <th>Parts Name</th>
                <th>Manufacture</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Party Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>

        <!-- main-section End -->
</div> --}}


<div>
    <!-- main-section Start -->
    <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        <h1 class="p-1">Comperative Statement Quotation Price</h1>
        <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
          <div class="col-auto">
            <label for="fromdate" class="mt-2">From Date</label>
          </div>
          <div class="col-auto">
            <input type="date" class="form-control" id="fromdate">
          </div>
          {{-- <div class="col-auto">
            <label for="vehiclename" class="mt-2">Vehicle Name</label>
          </div>
          <div class="col-auto">
            <input type="text" class="form-control" id="vehiclename" wire:model="vehicle_name">
          </div> --}}
          <div class="col-auto">
            <button type="button" class="btn btn-outline-light mb-3" wire:click="showQuotation">Preview</button>
          </div>
        </form>
    </div>

    <div class="container p-5">
    @if($showTableQuotationTable)
    <div class="d-flex justify-content-between">
        <p></p>
        <a href="{{route('pdf-generate-all-parts-information')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
        <p></p>
    </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Parts Code</th>
            <th>Parts Name</th>
            <th>Manufacture</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($parts as $item)
            <tr>
                <td>{{$item->parts_code}}</td>
                <td>{{$item->parts_name}}</td>
                <td>{{$item->parts_manufacture}}</td>
                <td>{{$item->parts_unit}}</td>
                <td>{{$item->parts_price}}</td>
                <td>{{$item->parts_date}}</td>
                <td><a href="{{route('pdf-generate-parts-information',['parts_id'=>$item->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td>
            </tr>
            @endforeach

        </tbody>
      </table>
      <p>Lowest Price Submission: </p>
      @endif
    </div>

    <!-- main-section End -->

</div>
