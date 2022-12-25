<div>
    <div class="container p-5 mt-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form wire:submit.prevent="updateVehicleInformation">
                    <h1 class="h1 text-center">Edit Vehicle Information</h1>
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
                        <label for="phone-no" class="form-label">Vehicle Name</label>
                        <input type="text" id="phone-no" class="form-control" wire:model="vehicle_name">
                        @error('vehicle_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
                    <div class="form-group mb-3">
                        <label for="madein" class="form-label">Madein</label>
                        <input type="text" id="madein" class="form-control" wire:model="madein">
                        @error('madein')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ed" class="form-label">Vehicle ED</label>
                        <input type="text" id="ed" class="form-control" wire:model="vehicle_ed">
                        @error('vehicle_ed')<span class="text-danger">{{ $message }}</span>@enderror <br>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit fa-lg"></i>&nbsp;Update</button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
</div>

