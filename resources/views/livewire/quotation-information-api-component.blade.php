@extends('layouts.home')
@section('content')

<div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
    @if (Session::has('password'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('password') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h1 class="h1 mb-5 float-start">Quotation Information Setup</h1>
    <button href="" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#fiscalYear"><i class="fas fa-plus"></i> Fiscal year</button>
    <form action="quotationInformation" method="GET">
        <div class="input-group mb-3 float-none text-center mb-5">
          <div class="input-group mb-3 float-none text-center mb-5">
                <input type="text" class="form-control" placeholder="Search Quotation data by ID, Parts name, supplier ID, Supplier name, vehicle name" aria-label="Search Supplier data" aria-describedby="button-addon2" name='searchTerm'>
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


    <div class="d-flex justify-content-between">
        <p class="">All Quotation Information</p>
        <a href="{{route('pdf.all-quotations')}}" class="btn btn-warning mb-3">Generate Pdf <i class="fas fa-download"></i></a>
        <a href="" data-bs-toggle="modal" data-bs-target="#QuotationInformation" class="btn btn-primary mb-3">Add Quotation Information</a>
     </div>

    <table class="table table-bordered text-light">
        <thead>
            <tr>
                <th>SL No.</th>
                <th>Frrom Date</th>
                <th>To Date</th>
                <th>Supplier ID</th>
                <th>Vehicle Code</th>
                <th>Supplier Name</th>
                <th>Vehicle Name</th>
                <th>Parts Code</th>
                <th>Parts Name</th>
                <th>Company Price</th>
                <th>Action</th>
            </tr>
            @foreach ($quotations as $quotation)
                <tr>
                    <td>{{$quotation->id}}</td>
                     <td>{{date('d/m/Y', strtotime($quotation->from_date))}}</td>
                     <td>{{date('d/m/Y', strtotime($quotation->to_date))}}</td>
                     <td>S{{$quotation->supplier_id}}</td>
                     <td>{{$quotation->vehicle_code}}</td>
                     <td>{{$quotation->supplier_name}}</td>
                     <td>{{$quotation->vehicle_name}}</td>
                     <td>{{$quotation->parts_code}}</td>
                     <td>{{$quotation->parts_name}}</td>
                     <td>{{$quotation->company}} TK</td>
                     <td>
                        <a href="{{route('edit.quation',['quotation_id'=>$quotation->id])}}" title="Edit"><i class="fas fa-edit  fa-1x text-primary"></i></a>
                        <a href="{{route('deleteQuotation',$quotation->id)}}" onclick="confirm('Are you sure to Delete This Information?')" title="delete"><i class="fas fa-remove  fa-1x text-danger"></i></a>
                     </td>
                </tr>
            @endforeach
        </thead>
    </table>
</div>



  <!-- Fiscal year Modal -->
  <div class="modal fade" id="fiscalYear" tabindex="-1" aria-labelledby="fiscalYearLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="fiscalYearLabel">Fiscal Year</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            @if ($password->password)
                <form method="post" action="{{ route('posts.password', ['post' => $password]) }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Enter Password:</label>
                    <input type="password" id="password" class="form-control" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror <br>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            @endif


        </div>
      </div>
    </div>
  </div>



<!-- Modal Quotation Information setup-->
<div class="modal fade" id="QuotationInformation" tabindex="-1" aria-labelledby="QuotationInformationLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="QuotationInformationLabel">Add Quotation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('addQuotationInformation')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="form-date" class="form-label">From date</label>
                            <select class="form-select selectpicker" aria-label="Default select example" name="from_date" data-live-search="true" data-style="py-0" id="form-date">
                                @foreach ($fiscalyears as $fiscalyear)
                                    <option value="{{$fiscalyear->start_date}}">{{date('d/m/Y', strtotime($fiscalyear->start_date))}}</option>
                                @endforeach
                            </select>
                            @error('from_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="to-date" class="form-label">To date</label>
                            <select class="form-select selectpicker" aria-label="Default select example" name="to_date" data-live-search="true" data-style="py-0" id="to-date">
                                @foreach ($fiscalyears as $fiscalyear)
                                    <option value="{{$fiscalyear->end_date}}">{{date('d/m/Y', strtotime($fiscalyear->end_date))}}</option>
                                @endforeach
                            </select>
                            @error('from_date')
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
                            <label for="supplier_name" class="form-label">Supplier Name</label>
                            <input type="text" id="supplierName" class="form-control" name="supplier_name" readonly>
                            @error('supplier_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                          <label for="vehicle_code" class="form-label">Vehicle Code</label>
                          <select class="form-select selectpicker" aria-label="Default select example" name="vehicle_code" data-live-search="true" data-style="py-0" id="vehicle_code">
                              <option value="" selected>Please Select Supplier ID</option>
                              @foreach ($vehicles as $vehicle)
                                  <option value="{{$vehicle->vehicle_code}}">{{$vehicle->vehicle_code}}</option>
                              @endforeach
                          </select>
                          @error('vehicle_code')
                               <span class="text-danger">{{ $message }}</span>
                         @enderror <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="vehicle_name" class="form-label">Vehicle Name</label>
                            <input type="text" id="vehicle-name" class="form-control" name="vehicle_name" readonly>
                            @error('vehicle_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                          <label for="parts_code" class="form-label">Parts Code</label>
                          <select class="form-select selectpicker" aria-label="Default select example" name="parts_code" data-live-search="true" data-style="py-0" id="parts_code">
                            <option value="" selected>Please Select Parts Code</option>
                        </select>
                          {{-- <select class="form-select selectpicker" aria-label="Default select example" name="parts_code" data-live-search="true" data-style="py-0" id="parts_code">
                            <option value="" selected>Please Select Parts Code</option>
                            @foreach ($parts as $part)
                                <option value="{{$part->parts_code}}">{{$part->parts_code}}</option>
                            @endforeach
                        </select> --}}
                        @error('parts_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="parts-name" class="form-label">Parts Name</label>
                            <input type="text" id="parts-name" class="form-control" name="parts_name" readonly>
                            @error('parts_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror <br>
                        </div>
                    </div>
                </div>

                <input type="text" id="parts-id" class="form-control" name="parts_id" readonly style="display: none;">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="company" class="form-label">Company Price (TK)</label>
                            <textarea type="text" id="company" rows="2" cols="10" class="form-control" name="company"></textarea>
                            @error('company')
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





@endsection



@push('scripts')
<script>
 $(document).ready(function(){

    // suppliers
     $('#supplier_id').change(function(e)  {
         var supplier_id = e.target.value;
         console.log(supplier_id);
         var op="";
         $.ajax({
             type:"get",
             url:"{{route('findSupplierQuotation')}}",
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

    // vehicles
     $('#vehicle_code').change(function(e)  {
         var vehicle_code = e.target.value;
        //  console.log(vehicle_code);
         var op="";
        //  if(vehicle_code) {
         $.ajax({
             type:"get",
             url:"{{route('findVehicleQuotation')}}",
             data:{
                 vehicle_code:vehicle_code
             },
             success:function(data){
                 console.log(data);
                 console.log(data.vehicle_name);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#parts_code').empty();
                 $(".form-group").find('#parts_code').append('<option value="">Select parts code</option>');
                 $.each(data.parts, function (key, value) {
                            $("#parts_code").append('<option value="' + value
                                .parts_code + '">' + value.parts_code + '</option>');
                        });
             },
             error:function(){

             }
         });

        // }else{
        //     $(".form-group").find('#parts_code').empty();
        // }


        });


        // parts
     $('#parts_code').change(function(e)  {
         var parts_code = e.target.value;
         console.log(parts_code);
         var op="";
         $.ajax({
             type:"get",
             url:"{{route('findPrtsQuotation')}}",
             data:{
                 parts_code:parts_code
             },
             success:function(data){
                 console.log(data);
                //  console.log(data.parts_name);
                //  console.log(data.vehicle_name);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                 $(".form-group").find('#parts-name').val(data.parts_name);
                 $(".form-group").find('#vehicle-name').val(data.vehicle_name);
                 $("form").find('#parts-id').val(data.id);
                 console.log(data.id);
             },
             error:function(){

             }
         });
        });


 });
</script>
@endpush
