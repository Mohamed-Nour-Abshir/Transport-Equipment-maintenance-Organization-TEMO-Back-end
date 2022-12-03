<div>
    <!-- main-section Start -->
    <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        @endif
    <div class="row">
      <div class="col-md-12">
        <h1 class="h1 mb-5">Vehicle Information Setup</h1>
        {{-- <div class="input-group mb-3 float-none text-center mb-5">
          <input type="text" class="form-control" placeholder="Search Supplier data" aria-label="Search Supplier data" aria-describedby="button-addon2" wire:model='searchTerm'>
          <button class="btn btn-primary" type="button" id="button-addon2">
            Serach
          </button>
        </div> --}}
        <div class="row">
            <div class="d-flex justify-content-between">
                <p class="">All Vehicles Information</p>
                <a href="{{ route('pdf.all-vehicles') }}" class="btn btn-warning btn-sm mb-4">Generate Pdf <i class="fas fa-download"></i></a>
                <a href="{{route('add.vehicle')}}" class="btn btn-primary float-end mb-3">Add Vehicle Information</a>
            </div>
        </div>
        <table class="table table-bordered text-light p-5">
          <thead>
            <tr>
              <th>SL No.</th>
              <th>Vehicle Code</th>
              <th>Vehicle Type</th>
              <th>Vehicle Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{$vehicle->id}}</td>
                    <td>{{$vehicle->vehicle_code}}</td>
                    <td>{{$vehicle->vehicle_type}}</td>
                    <td>{{$vehicle->vehicle_name}}</td>
                    <td>
                    <a href="{{route('edit.vehicle',['vehicle_id'=>$vehicle->id])}}" title="Edit"><i class="fas fa-edit text-primary fa-1x"></i></a>
                    <a href="" onclick="confirm('Are you sure to Delete this Information?') || event.stopImmediatePropagation()" wire:click.prevent="deleteVehicle({{ $vehicle->id }})" title="delete"><i class="fas fa-remove text-danger fa-1x"></i></a>
                    <a href="{{route('pdf.vehicle',['vehicle_id'=>$vehicle->id])}}" title="Print"><i class="fas fa-print text-warning fa-1x"></i></a>
                    </td>
                </tr>
            @endforeach

          </tbody>
        </table>
        <div class="d-flex">
            {{ $vehicles->links() }}
        </div>
      </div>
    </div>
  </div>

  <!-- main-section End -->
</div>

