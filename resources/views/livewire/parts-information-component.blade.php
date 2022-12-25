<div>
        <!-- main-section Start -->
        <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="row">
          <div class="col-md-12">
            <h1 class="h1 mb-5">Parts Information Setup</h1>
            <div class="input-group mb-3 float-none text-center mb-5">
              <input type="text" class="form-control" placeholder="Search parts information" aria-label="Search Supplier data" aria-describedby="button-addon2" wire:model='searchTerm'>
            </div>
            <div class="row">
                <div class="d-flex justify-content-between">
                    <p class="">All Parts Information</p>
                    <a href="{{ route('pdf-generate-all-parts-information') }}" class="btn btn-warning btn-sm mb-4">Generate Pdf <i class="fas fa-download"></i></a>
                    <a href="" class="btn btn-primary float-end mb-3" data-bs-toggle="modal"
                    data-bs-target="#PartsInformation">Add Parts Information</a>
                </div>
            </div>
            <table class="table table-bordered text-light p-5">
              <thead>
                <tr>
                  <th>SL No.</th>
                  <th>Vehicle Code</th>
                  <th>Parts Code</th>
                  <th>Parts Name</th>
                  <th>Parts Manufacture</th>
                  <th>Parts Unit</th>
                  <th>Parts ED</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($parts as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->vehicle->vehicle_code}}</td>
                        <td>{{$item->parts_code}}</td>
                        <td>{{$item->parts_name}}</td>
                        <td>{{$item->parts_manufacture}}</td>
                        <td>{{$item->parts_unit}}</td>
                        <td>{{$item->parts_date}}</td>
                        <td>
                        <a href="{{route('edit.parts',['parts_id'=>$item->id])}}" title="Edit"><i class="fas fa-edit text-primary fa-1x"></i></a>
                        <a href="" onclick="confirm('Are you sure to Delete this Information?') || event.stopImmediatePropagation()" wire:click.prevent="deletePartsInfo({{ $item->id }})" title="delete"><i class="fas fa-remove text-danger fa-1x"></i></a>
                        <a href="{{route('pdf-generate-parts-information',['parts_id'=>$item->id])}}" title="Print"><i class="fas fa-print text-warning fa-1x"></i></a>
                        </td>
                    </tr>
                @endforeach

              </tbody>
            </table>
            <div class="d-flex">
                {{ $parts->links() }}
            </div>
          </div>
        </div>
      </div>
      <!-- main-section End -->


    <!-- Modal Parts Information List-->
    <div
    class="modal fade"
    id="PartsInformation"
    tabindex="-1"
    aria-labelledby="PartsInformationLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="PartsInformationLabel">
            Parts Information Setup
          </h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="addPartsInformation">
                <div class="form-group mb-3">
                    <label for="vehicle-code" class="form-label">Vehicle Code</label>
                    <select class="form-select bg-danger" id="vehicle-code" aria-label="Default select example" wire:model="vehicle_code">
                        <option value="" selected>Please Select Vehicle code</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{$vehicle->id}}">{{$vehicle->vehicle_code}}</option>
                        @endforeach
                        @error('vehicle_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror <br>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="supplier-name" class="form-label">Parts Code</label>
                    <input type="text" id="supplier-name" class="form-control" wire:model="parts_code">
                    @error('parts_code')<span class="text-danger">{{ $message }}</span>@enderror <br>
                </div>
                <div class="form-group mb-3">
                    <label for="phone-no" class="form-label">Parts Name</label>
                    <input type="text" id="phone-no" class="form-control" wire:model="parts_name">
                    @error('parts_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                </div>
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Parts Manufacture</label>
                    <input type="text" id="email" class="form-control" wire:model="parts_manufacture">
                    @error('parts_manufacture')<span class="text-danger">{{ $message }}</span>@enderror <br>
                </div>
                <div class="form-group mb-3">
                    <label for="address" class="form-label">Parts Unit</label>
                    <input type="text"  id="address" class="form-control" wire:model="parts_unit">
                    @error('parts_unit')<span class="text-danger">{{ $message }}</span>@enderror <br>
                </div>
                <div class="form-group mb-3">
                    <label for="date" class="form-label">Parts ED</label>
                    <input type="date" id="date"  class="form-control" wire:model="parts_date">
                    @error('parts_date')<span class="text-danger">{{ $message }}</span>@enderror <br>
                </div>
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
