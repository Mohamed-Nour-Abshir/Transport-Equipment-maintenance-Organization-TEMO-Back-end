<div>
    <!-- main-section Start -->
    <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
    <div class="row">
      <div class="col-md-12">
        <h1 class="h1 mb-5">Vehicle Information Setup</h1>
        <div class="input-group mb-3 float-none text-center mb-5">
            <input type="text" class="form-control" placeholder="Search Vehicles data by ID, vehicle type, vehicle name, vehicle code"
                aria-label="Search Vehicles data" aria-describedby="button-addon2" wire:model="searchTerm" />
        </div>
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="d-flex justify-content-between">
                <p class="">All Vehicles Information</p>
                <a href="{{ route('pdf.all-vehicles') }}" class="btn btn-warning btn-sm mb-4">Generate Pdf <i class="fas fa-download"></i></a>
                <a href="" data-bs-toggle="modal" data-bs-target="#VehicleInformation" class="btn btn-primary float-end mb-3">Add Vehicle Information</a>
            </div>
        </div>
        <table class="table table-bordered text-light p-5">
          <thead>
            <tr>
              <th>SL No.</th>
              <th>Vehicle Code</th>
              <th>Vehicle Type</th>
              <th>Vehicle Name</th>
              <th>Madein</th>
              <th>Vehicle ED</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $i = 0;
            ?>
            @foreach ($vehicles as $vehicle)
            {{-- @if ($vehicle->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date))) --}}
                <tr>
                    <td>{{++ $i}}</td>
                    <td>{{$vehicle->vehicle_code}}</td>
                    <td>{{$vehicle->vehicle_type}}</td>
                    <td>{{$vehicle->vehicle_name}}</td>
                    <td>{{$vehicle->vehicle_madein}}</td>
                    <td>{{$vehicle->date}}</td>
                    <td>
                    <a href="{{route('edit.vehicle',['vehicle_id'=>$vehicle->id])}}" title="Edit"><i class="fas fa-edit text-primary fa-1x"></i></a>
                    <a href="" onclick="confirm('Are you sure to Delete this Information?') || event.stopImmediatePropagation()" wire:click.prevent="deleteVehicle({{ $vehicle->id }})" title="delete"><i class="fas fa-remove text-danger fa-1x"></i></a>
                    <a href="{{route('pdf.vehicle',['vehicle_id'=>$vehicle->id])}}" title="Print"><i class="fas fa-print text-warning fa-1x"></i></a>
                    </td>
                </tr>
            {{-- @endif --}}
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

      <!-- Modal vehicles Information Modal-->
      <div
      class="modal fade"
      id="VehicleInformation"
      tabindex="-1"
      aria-labelledby="VehicleInformationLabel"
      aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="VehicleInformationLabel">
              Vehicles Information Setup
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
            <div class="modal-body">
                <form wire:submit.prevent="addVehicleInformation">
                    <div class="form-group mb-3">
                        <label for="supplier-id" class="form-label">Vehicle Code</label>
                        <input type="text" id="supplier-id" class="form-control" wire:model="vehicle_code">
                        @error('vehicle_code')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
                    <div class="form-group mb-3">
                        <label for="supplier-name" class="form-label">Vehicle Type</label>
                        <input type="text" id="supplier-name" class="form-control" wire:model="vehicle_type">
                        @error('vehicle_type')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
                    <div class="form-group mb-3">
                        <label for="vehicle-name" class="form-label">Vehicle Name</label>
                        <input type="text" id="vehicle-name" class="form-control" wire:model="vehicle_name">
                        @error('vehicle_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
                    <div class="form-group mb-3">
                        <label for="madein" class="form-label">Madein</label>
                        <input type="text" id="madein" class="form-control" wire:model="madein">
                        @error('madein')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ed" class="form-label">Vehicle ED</label>
                        <input type="date" id="ed" class="form-control" wire:model="vehicle_ed">
                        @error('vehicle_ed')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
      </div>
    </div>
</div>

