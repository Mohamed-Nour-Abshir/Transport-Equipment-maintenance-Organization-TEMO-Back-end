<div>
    <div class="container p-5 mt-5 mb-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        @endif
        <form wire:submit.prevent="updatePartsInformation">
            <h1 class="h1 text-center">Edit Parts Information</h1>
            <div class="form-group mb-3">
                <label for="supplier-id" class="form-label">Vehicle Code</label>
                <input type="text" id="supplier-id" class="form-control" wire:model="vehicle_code">
                @error('vehicle_code')<span class="text-danger">{{ $message }}</span>@enderror <br>
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
            <button type="submit" class="btn btn-success btn-sm">Update Parts</button>
        </form>
    </div>
</div>
