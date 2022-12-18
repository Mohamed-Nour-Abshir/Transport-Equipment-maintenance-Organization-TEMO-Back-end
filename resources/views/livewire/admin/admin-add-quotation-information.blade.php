<div>
    <div class="container mt-2">
        <h1 class="bg-primary text-light text-center p-2 h1">Add Quotation Information</h1>
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form wire:submit.prevent='addQuotationInformation' method="POST">
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
                        <label for="supplier_id" class="form-label">Supplier ID</label>
                        <select class="form-select selectpicker" aria-label="Default select example" wire:model="supplier_id" data-live-search="true" data-style="py-0" id="supplier_id">
                            <option value="" selected>Please Select Supplier ID</option>
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
                            <option value="" selected>Please Select Vehicle code</option>
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
                        <label for="supplier_name" class="form-label">Supplier Name</label>
                        {{-- <input type="text" id="supplier_name" class="form-control" wire:model="supplier_name" name="supplier_name" readonly> --}}
                        <select class="form-select" id="supplier-name" aria-label="Default select example" wire:model="supplier_name">
                            <option value="" selected>Please Select Supplier Name</option>
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
                            <option value="" selected>Please Select Vehicle Name</option>
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
                            <label for="parts-code" class="form-label">Parts ID</label>
                            <select class="form-select" id="parts-code" aria-label="Default select example" wire:model="parts_id">
                                <option value="" selected>Please Select Parts ID</option>
                                @foreach ($parts as $part)
                                    <option value="{{$part->id}}">{{$part->id}}</option>
                                @endforeach
                                @error('parts_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror <br>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="parts-code" class="form-label">Parts Code</label>
                            <select class="form-select" id="parts-code" aria-label="Default select example" wire:model="parts_code">
                                <option value="" selected>Please Select Parts code</option>
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
                                <option value="" selected>Please Select Parts Name</option>
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
                        <div class="form-group mb-2">
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


@push('script')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#supplier_id').change(function(e) {
            var qoutationID = e.target.value;
            $.ajax({
                url: "{{ route('quotation-information') }}",
                type: "POST",
                data: {
                    qoutationID: qoutationID
                },
                success: function(data) {
                    console.log($('#supplier_name').val(data.qoutationID[0].supplier_name));
                    // $('#supplierID').val(data.qoutationID[0].studentID);
                    $('#supplier_name').val(data.qoutationID[0].supplier_name);
                }
            })
        });
    });
</script>

@endpush
