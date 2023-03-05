<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Repaired Vehicle List</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
        <div class="col-auto">
              <label for="fiscalYear" class="mt-2">Fiscal Year</label>
         </div>
        <div class="col-auto">
              <input type="text" class="form-control" id="fiscalYear" name="fiscal_year">
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
        </div>
  </div>

  <div class="d-flex justify-content-center mt-5">
    <a class="btn btn-warning mb-3 text-center vehicleList">Generate Pdf <i class="fas fa-download"></i></a>
  </div>

  <div class="container p-5" id="vehicleList">
    {{-- @if(isset($searchVehicleName)) --}}
      <div class="d-flex justify-content-center">
        <h1 class="text-decoration-underline text-center mb-5 h5"><b>Repaired Vehicle List</b> </h1>
          {{-- <a href="{{route('repairVehicleList-reportPdf')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
      </div>
      <div class="d-flex justify-content-end">
          <p>Print Date : {{date('d/m/Y')}}</p>
      </div>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Sl No</th>
          <th>Vehicle Type</th>
          <th>Organization Name</th>
          <th>Remarks</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 0;
        ?>
        @foreach ($quotations as $quotation)
        @if ($quotation->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))

            <tr>
              <td>{{++ $i}}</td>
              <td>{{$quotation->vehicle_type}}</td>
              <td></td>
              <td></td>
            </tr>
            @endif
        @endforeach
      </tbody>
    </table>
    {{-- @endif --}}
  </div>

  <!-- main-section End -->
</div>
