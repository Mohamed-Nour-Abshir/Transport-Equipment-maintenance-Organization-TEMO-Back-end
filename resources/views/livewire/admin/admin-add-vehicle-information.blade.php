<div>
    <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        @endif
        <form wire:submit.prevent="addVehicleInformation">
            <h1 class="h1 text-center"> Vehicle Information Setup</h1>
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
            <button type="submit" class="btn btn-primary btn-sm">Add Vehicle</button>
        </form>
    </div>
</div>

