<div>
    <div class="container mt-2">
        <h1 class="bg-success text-light text-center p-2 h1">Update Quotation Information</h1>
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
        @endif
        <form wire:submit.prevent='updateQuotationInformation'>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="form-date" class="form-label">From date</label>
                        <input type="date" id="form-date" class="form-control" wire:model="from_date">
                        @error('from_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror <br>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="to-date" class="form-label">To date</label>
                        <input type="date" id="to-date" class="form-control" wire:model="to_date">
                        @error('to_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror <br>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="supplier-id" class="form-label">Supplier ID</label>
                        <select class="form-select" id="supplier-id" aria-label="Default select example" wire:model="supplier_id">
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->supplier_id}}</option>
                            @endforeach
                            @error('supplier_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="vehicle-code" class="form-label">Vehicle Code</label>
                        <select class="form-select" id="vehicle-code" aria-label="Default select example" wire:model="vehicle_code">
                            @foreach ($vehicles as $vehicle)
                                <option value="{{$vehicle->vehicle_code}}">{{$vehicle->vehicle_code}}</option>
                            @endforeach
                            @error('vehicle_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="supplier-name" class="form-label">Supplier Name</label>
                        <select class="form-select" id="supplier-name" aria-label="Default select example" wire:model="supplier_name">
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</option>
                            @endforeach
                            @error('supplier_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="vehicle-name" class="form-label">Vehicle Name</label>
                        <select class="form-select" id="vehicle-name" aria-label="Default select example" wire:model="vehicle_name">
                            @foreach ($vehicles as $vehicle)
                                <option value="{{$vehicle->vehicle_name}}">{{$vehicle->vehicle_name}}</option>
                            @endforeach
                            @error('vehicle_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </select>
                    </div>
                </div>
            </div>
            <div class="parts">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="parts-code" class="form-label">Parts Code</label>
                            <select class="form-select" id="parts-code" aria-label="Default select example" wire:model="parts_code">
                                @foreach ($parts as $part)
                                    <option value="{{$part->parts_code}}">{{$part->parts_code}}</option>
                                @endforeach
                                @error('parts_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror <br>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="parts-name" class="form-label">Parts Name</label>
                            <select class="form-select" id="parts-name" aria-label="Default select example" wire:model="parts_name">
                                @foreach ($parts as $part)
                                    <option value="{{$part->parts_name}}">{{$part->parts_name}}</option>
                                @endforeach
                                @error('parts_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror <br>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="company-price" class="form-label">Company Price (TK)</label>
                            <input type="text" id="company-price" class="form-control" wire:model="company_price">
                            @error('company_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>

