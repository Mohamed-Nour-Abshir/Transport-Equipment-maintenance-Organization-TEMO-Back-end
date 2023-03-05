@extends('layouts.fiscalyear')
@section('content')
    <div class="container p-5 mt-2 mb-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto;">
        @if (Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 class="h1 text-center text-light mb-5">Edit Workorder Information</h1>
                <form action="{{route('edit.workorders',$workorder->id)}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label for="supplier-id" class="form-label">Quotation From</label>
                              <input type="date" id="supplier-id" class="form-control" name='quotation_from' value="{{$workorder->quotation_from}}">
                              @error('quotation_from')<span class="text-danger">{{ $message }}</span>@enderror <br>
                           </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label for="supplier-id" class="form-label">Quotation To</label>
                              <input type="date" id="supplier-id" class="form-control" name='quotation_to' value="{{$workorder->quotation_to}}">
                              @error('quotation_to')<span class="text-danger">{{ $message }}</span>@enderror <br>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                              <label for="supplier_id" class="form-label">Supplier ID</label>
                              <select class="form-select selectpicker" aria-label="Default select example" name="supplier_id" data-live-search="true" data-style="py-0" id="supplier_id">
                                  <option value="{{$workorder->supplier_id}}" selected>S{{$workorder->supplier_id}}</option>
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
                                <option value="{{$workorder->vehicle_code}}" selected>{{$workorder->vehicle_code}}</option>
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
                                <label for="supplier-id" class="form-label">Supplier Name</label>
                                {{-- <select class="form-select selectpicker" aria-label="Default select example" name="supplier_name" data-live-search="true" data-style="py-0" id="supplier_id">
                                    <option value="" selected>Please Select Supplier Name</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</option>
                                    @endforeach
                                </select> --}}
                                <input type="text" class="form-control" readonly id="supplier-name" name="supplier_name" value="{{$workorder->supplier_name}}">
                                @error('supplier_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                              </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="supplier-id" class="form-label">Vehicle Name</label>
                                {{-- <select class="form-select" id="vehicle-code" aria-label="Default select example" name="vehicle_name">
                                    <option value="" selected>Please Select Vehicle code</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{$vehicle->vehicle_name}}">{{$vehicle->vehicle_name}}</option>
                                    @endforeach
                                </select> --}}
                                <input type="text" class="form-control" readonly id="vehicle-name" name="vehicle_name" value="{{$workorder->vehicle_name}}">
                                @error('vehicle_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                              </div>
                        </div>
                    </div>
                    <div class="parts">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                  <label for="parts-code" class="form-label">Parts Code</label>
                                  <select class="form-select" id="parts-code" aria-label="Default select example" name="parts_code">
                                    <option value="{{$workorder->parts_code}}" selected>{{$workorder->parts_code}}</option>
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
                                  <label for="supplier-id" class="form-label">Parts Price (TK)</label>
                                  <input type="text" id="supplier-id" class="form-control" name="parts_price" value="{{$workorder->parts_price}}">
                                  @error('parts_price')<span class="text-danger">{{ $message }}</span>@enderror <br>
                                </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="supplier-id" class="form-label">Parts Name</label>
                                {{-- <select class="form-select" id="parts-code" aria-label="Default select example" name="parts_name">
                                    <option value="" selected>Please Select Parts Name</option>
                                    @foreach ($parts as $part)
                                        <option value="{{$part->parts_name}}">{{$part->parts_name}}</option>
                                    @endforeach
                                </select> --}}
                                <input type="text" class="form-control" readonly id="parts-name" name="parts_name" value="{{$workorder->parts_name}}">
                                @error('parts_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                             </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                              <label for="supplier-id" class="form-label">Order Date</label>
                              <input type="date" id="supplier-id" class="form-control" name="order_date" value="{{$workorder->order_date}}">
                              @error('order_date')<span class="text-danger">{{ $message }}</span>@enderror <br>
                           </div>
                          </div>
                        </div>
                        <div class="form-group mb-3">
                          <label for="supplier-id" class="form-label">Vehicle Type</label>
                          <input type="text" id="vehicle-type" readonly class="form-control" name="vehicle_type" value="{{$workorder->vehicle_type}}">
                          @error('vehicle_type')<span class="text-danger">{{ $message }}</span>@enderror <br>
                       </div>
                        <div class="form-group mb-3">
                          <label for="supplier-id" class="form-label">Parts Quantity</label>
                          <input type="text" id="supplier-id" class="form-control" name="parts_qty" value="{{$workorder->parts_qty}}">
                          @error('parts_qty')<span class="text-danger">{{ $message }}</span>@enderror <br>
                       </div>
                        <div class="form-group mb-3">
                          <label for="supplier-id" class="form-label">Order Parts Price Tk</label>
                          <input type="text" id="supplier-id" class="form-control" name="order_parts_price" value="{{$workorder->order_parts_price}}">
                          @error('order_parts_price')<span class="text-danger">{{ $message }}</span>@enderror <br>
                       </div>
                        <div class="form-group mb-3">
                          <label for="orderNo" class="form-label">Order NO.</label>
                          <input type="text" id="orderNo" class="form-control" name="order_no" value="{{$workorder->order_no}}">
                          @error('order_no')<span class="text-danger">{{ $message }}</span>@enderror <br>
                       </div>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Update</button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
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
             url:"{{route('findSupplierWorkorder')}}",
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
             url:"{{route('findVehicleWorkorderEdit')}}",
             data:{
                 vehicle_code:vehicle_code
             },
             success:function(data){
                 console.log(data);
                 console.log(data.vehicle_name);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#vehicle-name').val(data.vehicle_name);
                 $(".form-group").find('#vehicle-type').val(data.vehicle_type);
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
             url:"{{route('findPartsWorkorder')}}",
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
