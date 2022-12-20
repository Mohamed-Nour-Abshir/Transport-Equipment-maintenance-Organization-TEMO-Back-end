<div>
  <!-- main-section Start -->
  <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
      <h1 class="p-1">Repaired Vehicle List</h1>
      <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-outline-light mb-3" wire:click="showQuotation">Preview</button>
        </div>
      </form>
  </div>

  <div class="container p-5">
    @if($showTableQuotationTable)
      <div class="d-flex justify-content-center">
          <a href="{{route('pdf-generate-all-parts-information')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
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
        @foreach ($quotations as $quotation)
            <tr>
              <td>{{$quotation->id}}</td>
              <td>{{$quotation->vehicle->vehicle_type}}</td>
              <td></td>
              <td></td>
            </tr>
        @endforeach
      </tbody>
    </table>
    @endif
  </div>

  <!-- main-section End -->
</div>
