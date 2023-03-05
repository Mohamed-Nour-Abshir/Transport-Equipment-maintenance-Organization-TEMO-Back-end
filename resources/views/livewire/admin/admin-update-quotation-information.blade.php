@extends('layouts.fiscalyear')
@section('content')
    <div class="container mt-2">
        <h1 class="bg-success text-light text-center p-2 h1">Update Quotation Information</h1>
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{route('admin.quatation',$quotation->id)}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="form-date" class="form-label">From date</label>
                        <input type="date" id="form-date" class="form-control" name="from_date" value="{{$quotation->from_date}}">
                        @error('from_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror <br>
                      </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="to-date" class="form-label">To date</label>
                        <input type="date" id="to-date" class="form-control" name="to_date" value="{{$quotation->to_date}}">
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
                        <select class="form-select" id="supplier_id" aria-label="Default select example" name="supplier_id">
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
                        <select class="form-select" id="vehicle-code" aria-label="Default select example" name="vehicle_code">
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
                        {{-- <select class="form-select" id="supplier-name" aria-label="Default select example" name="supplier_name">
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</option>
                            @endforeach
                            @error('supplier_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </select> --}}
                        <input type="text" readonly id="supplier-name" class="form-control" name="supplier_name" value="{{$quotation->supplier_name}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="vehicle-name" class="form-label">Vehicle Name</label>
                        {{-- <select class="form-select" id="vehicle-name" aria-label="Default select example" name="vehicle_name">
                            @foreach ($vehicles as $vehicle)
                                <option value="{{$vehicle->vehicle_name}}">{{$vehicle->vehicle_name}}</option>
                            @endforeach
                            @error('vehicle_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </select> --}}
                        <input type="text" readonly id="vehicle-name" class="form-control" name="vehicle_name" value="{{$quotation->vehicle_name}}">
                    </div>
                </div>
            </div>
            <div class="parts">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="parts-code" class="form-label">Parts Code</label>
                            <select class="form-select" id="parts-code" aria-label="Default select example" name="parts_code">
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
                            {{--<select class="form-select" id="parts-name" aria-label="Default select example" name="parts_name">
                                @foreach ($parts as $part)
                                    <option value="{{$part->parts_name}}">{{$part->parts_name}}</option>
                                @endforeach
                                @error('parts_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror <br>
                            </select> --}}
                            <input type="text" readonly id="parts-name" class="form-control" name="parts_name" value="{{$quotation->parts_name}}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="company-price" class="form-label">Company Price (TK)</label>
                            <input type="text" id="company-price" class="form-control" name="company_price" value="{{$quotation->company}}">
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
@endsection


{{-- ajax  --}}

@push('scripts')
<script>
 $(document).ready(function(){
     $('#supplier_id').change(function(e)  {
         var supplier_id = e.target.value;
         console.log(supplier_id);
         var op="";
         $.ajax({
             type:"get",
             url:"{{route('findSupplierQuotationEdit')}}",
             data:{
                 supplier_id:supplier_id
             },
             success:function(data){
                 console.log(data);
                 console.log(data.supplier_name);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#supplier-name').val(data.supplier_name);
             },
             error:function(){

             }
         });
        });

     $('#vehicle-code').change(function(e)  {
         var vehicle_code = e.target.value;
         console.log(vehicle_code);
         var op="";
         $.ajax({
             type:"get",
             url:"{{route('findVehicleQuotationEdit')}}",
             data:{
                 vehicle_code:vehicle_code
             },
             success:function(data){
                 console.log(data);
                 console.log(data.vehicle_name);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#vehicle-name').val(data.vehicle_name);
             },
             error:function(){

             }
         });
        });


     $('#parts-code').change(function(e)  {
         var parts_code = e.target.value;
         console.log(parts_code);
         var op="";
         $.ajax({
             type:"get",
             url:"{{route('findPartsQuotationEdit')}}",
             data:{
                 parts_code:parts_code
             },
             success:function(data){
                 console.log(data);
                 console.log(data.parts_id);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#parts-name').val(data.parts_name);

             },
             error:function(){

             }
         });
        });

 });


</script>
@endpush
