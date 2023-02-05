@extends('layouts.home')
@section('content')
    <!-- main-section Start -->
    <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        <div class="row">
          <div class="col-md-12">
            <h1 class="h1 mb-5 float-start">Workorder Information Setup</h1>
            <button href="" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#fiscalYear"><i class="fas fa-plus"></i> Fiscal year</button>
            <form action="workorder-information" method="GET">
                <div class="input-group mb-3 float-none text-center mb-5">
                  <div class="input-group mb-3 float-none text-center mb-5">
                        <input type="text" class="form-control" placeholder="Search Workorders data by Order No, Order Date, supplier ID, Supplier name, Parts name, vehicle name" aria-label="Search Supplier data" aria-describedby="button-addon2" name='searchTerm'>
                        <button class="btn btn-primary" type="submit" id="button-addon2">
                            Serach
                        </button>
                    </div>
                </div>
            </form>
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="row">
                <div class="d-flex justify-content-between">
                    <p class="">All Workorder Information</p>
                    <a href="{{route('pdf.workorders')}}" class="btn btn-warning btn-sm mb-4">Generate Pdf <i class="fas fa-download"></i></a>
                    <a href="" data-bs-toggle="modal" data-bs-target="#WorkorderInformation" class="btn btn-primary btn-sm mb-3">Add Workorder Information</a>
                </div>
            </div>
            <table class="table table-bordered text-light p-5">
              <thead>
                <tr>
                  <th>SL No.</th>
                  <th>Workorder No</th>
                  <th>Vehicle Type</th>
                  <th>Supplier ID</th>
                  <th>Vehicle Code</th>
                  <th>Parts Code</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Order Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($workorders as $workorder)
                <tr>
                    <td>{{$workorder->id}}</td>
                    <td>{{$workorder->order_no}}</td>
                    <td>{{$workorder->vehicle_type}}</td>
                    <td>{{$workorder->supplier_id}}</td>
                    <td>{{$workorder->vehicle_code}}</td>
                    <td>{{$workorder->parts_code}}</td>
                    <td>{{$workorder->parts_qty}}</td>
                    <td>{{$workorder->order_parts_price}}</td>
                    <td>{{$workorder->order_date}}</td>
                    <td>
                      <a href="{{route('edit.workorders',['workorder_id'=>$workorder->id])}}" title="Edit"><i class="fas fa-edit text-primary fa-2x"></i></a>
                      <a href="{{route('deleteWorkorder',$workorder->id)}}" onclick="confirm('Are you sure to Delete this Information?') || event.stopImmediatePropagation()"  title="delete"><i class="fas fa-remove text-danger fa-2x"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- main-section End -->


<!-- Fiscal year Modal -->
<div class="modal fade" id="fiscalYear" tabindex="-1" aria-labelledby="fiscalYearLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fiscalYearLabel">Fiscal Year</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('addFiscalYear')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="form-date" class="form-label">Start Date date</label>
                            <input type="date" id="form-date" class="form-control" name="start_date">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="to-date" class="form-label">End date</label>
                            <input type="date" id="to-date" class="form-control" name="end_date">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

      <!-- Modal Quotation Information setup-->
      <div
        class="modal fade"
        id="WorkorderInformation"
        tabindex="-1"
        aria-labelledby="WorkorderInformationLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="WorkorderInformationLabel">
                Workorder Information Setup
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <form action="{{route('addWorkorderInformation')}}" method="POST">
                @csrf
                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="quotation_from" class="form-label">Quotation From</label>
                            <select class="form-select selectpicker" aria-label="Default select example" name="quotation_from" data-live-search="true" data-style="py-0" id="quotation_from">
                                @foreach ($fiscalyears as $fiscalyear)
                                    <option value="{{$fiscalyear->start_date}}">{{date('d/m/Y', strtotime($fiscalyear->start_date))}}</option>
                                @endforeach
                            </select>
                            @error('quotation_from')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                         </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="quotationto" class="form-label">Quotation To</label>
                            <select class="form-select selectpicker" aria-label="Default select example" name="quotation_to" data-live-search="true" data-style="py-0" id="quotationto">
                                @foreach ($fiscalyears as $fiscalyear)
                                    <option value="{{$fiscalyear->end_date}}">{{date('d/m/Y', strtotime($fiscalyear->end_date))}}</option>
                                @endforeach
                            </select>
                            @error('quotation_to')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group mb-3">
                            <label for="supplier_id" class="form-label">Supplier ID</label>
                            <select class="form-select selectpicker" aria-label="Default select example" name="supplier_id" data-live-search="true" data-style="py-0" id="supplier_id">
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
                            <select class="form-select" id="vehicle-code" aria-label="Default select example" name="vehicle_code">
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
                              <label for="supplierName" class="form-label">Supplier Name</label>
                              <input type="text" id="supplierName" class="form-control" name="supplier_name" readonly>
                              @error('supplier_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                            </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label for="vehicle-name" class="form-label">Vehicle Name</label>
                              <input type="text" id="vehicle-name" class="form-control" name="vehicle_name" readonly>
                              @error('vehicle_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                            </div>
                      </div>
                  </div>
                  <div class="form-group mb-3">
                    <label for="parts_qty" class="form-label">Parts Quantity</label>
                    <input type="number" id="parts_qty" class="form-control" name="parts_qty" value="1">
                    @error('parts_qty')<span class="text-danger">{{ $message }}</span>@enderror <br>
                 </div>
                  <div class="parts">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="parts-code" class="form-label">Parts Code</label>
                                <select class="form-select" id="parts-code" aria-label="Default select example" name="parts_code">
                                    <option value="" selected>Please Select Parts code</option>
                                </select>
                                {{-- <input type="text" id="parts-code" class="form-control" name="parts_code" readonly> --}}
                                </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="parts_price" class="form-label">Parts Price (TK)</label>
                                <input type="text" id="parts_price" class="form-control" name="parts_price" readonly>
                                @error('parts_price')<span class="text-danger">{{ $message }}</span>@enderror <br>
                              </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group mb-3">
                              <label for="parts-name" class="form-label">Parts Name</label>
                              <input type="text" id="parts-name" class="form-control" name="parts_name" readonly>
                              @error('parts_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                           </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="vehicletype" class="form-label">Vehicle Type</label>
                                <input type="text" id="vehicletype" class="form-control" name="vehicle_type">
                                @error('vehicle_type')<span class="text-danger">{{ $message }}</span>@enderror <br>
                             </div>
                        </div>
                      </div>
                      <div class="form-group mb-3">
                        <label for="order-date" class="form-label">Order Date</label>
                        <input type="date" id="order-date" class="form-control" name="order_date">
                        @error('order_date')<span class="text-danger">{{ $message }}</span>@enderror <br>
                     </div>
                      <div class="form-group mb-3">
                        <label for="order-no" class="form-label">Order No</label>
                        <input type="text" id="order-no" class="form-control" name="order_no">
                        @error('order_no')<span class="text-danger">{{ $message }}</span>@enderror <br>
                     </div>
                      <div class="form-group mb-3">
                        <label for="total" class="form-label">Order Price Tk</label>
                        <input type="text" id="total" class="form-control" name="order_parts_price" readonly>
                        @error('order_parts_price')<span class="text-danger">{{ $message }}</span>@enderror <br>
                     </div>
                      {{-- <label for="parts-id" class="form-label">Parts ID</label> --}}
                      <input type="text" id="parts-id" class="form-control" name="parts_id" readonly style="display: none;">
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save</button>
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
          </div>
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
             url:"{{route('findSupplier')}}",
             data:{
                 supplier_id:supplier_id
             },
             success:function(data){
                 console.log(data);
                 console.log(data.supplier_name);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#supplierName').val(data.supplier_name);
             },
             error:function(){

             }
         });
        });

    //  $('#vehicle-code').change(function(e)  {
    //      var vehicle_code = e.target.value;
    //      console.log(vehicle_code);
    //      var op="";
    //      $.ajax({
    //          type:"get",
    //          url:"{{route('findVehicle')}}",
    //          data:{
    //              vehicle_code:vehicle_code
    //          },
    //          success:function(data){
    //              console.log(data);
    //              console.log(data.vehicle_name);
    //              // here supplier_name is coloumn name in suppliers table data.coln name
    //              $(".form-group").find('#vehicle-name').val(data.vehicle_name);
    //              $(".form-group").find('#vehicle_type').val(data.vehicle_type);
    //          },
    //          error:function(){

    //          }
    //      });
    //     });


     $('#parts-code').change(function(e)  {
         var parts_code = e.target.value;
         console.log(parts_code);
         var op="";
         $.ajax({
             type:"get",
             url:"{{route('findParts')}}",
             data:{
                 parts_code:parts_code
             },
             success:function(data){
                 console.log(data);
                 console.log(data.parts_id);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#parts-name').val(data.parts_name);
                 $(".form-group").find('#parts_price').val(data.company);
                 $("form").find('#parts-id').val(data.parts_id);
                 $(".form-group").find('#vehicle-name').val(data.vehicle_name);
                 //  Calculator for total amount
                let company = parseInt($("#parts_price").val());
                let quantity = parseInt($("#parts_qty").val());
                //  let total = parseInt($("#total").val(quantity * parts_price));
                $("#total").val(quantity * company);


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
             url:"{{route('findVehicleWorkOrder')}}",
             data:{
                 vehicle_code:vehicle_code
             },
             success:function(data){
                 console.log(data);
                 console.log(data.parts_id);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#parts-code').empty();
                 $(".form-group").find('#parts-code').append('<option value="">Select parts code</option>');
                 $.each(data.parts, function (key, value) {
                            $("#parts-code").append('<option value="' + value
                                .parts_code + '">' + value.parts_code + '</option>');
                        });

             },
             error:function(){

             }
         });
        });



        // $('#vehicle-code').change(function(e)  {
        //  var vehicle_code = e.target.value;
        //  console.log(vehicle_code);
        //  var op="";
        //  $.ajax({
        //      type:"get",
        //      url:"{{route('findVehicleWorkOrder')}}",
        //      data:{
        //          vehicle_code:vehicle_code
        //      },
        //      success:function(data){
        //          console.log(data);
        //          console.log(data.parts_id);
        //          // here supplier_name is coloumn name in suppliers table data.coln name
        //          $(".form-group").find('#parts-code').val(data.parts_code);
        //          $(".form-group").find('#parts-name').val(data.parts_name);
        //          $(".form-group").find('#parts_price').val(data.company);
        //          $(".form-group").find('#vehicle-name').val(data.vehicle_name);
        //          $("form").find('#parts-id').val(data.parts_id);
        //         //  Calculator for total amount
        //          let company = parseInt($("#parts_price").val());
        //          let quantity = parseInt($("#parts_qty").val());
        //         //  let total = parseInt($("#total").val(quantity * parts_price));
        //         $("#total").val(quantity * company);
        //      },
        //      error:function(){

        //      }
        //  });
        // });



 });


</script>
@endpush
