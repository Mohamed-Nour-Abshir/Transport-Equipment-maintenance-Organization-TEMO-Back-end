@extends('layouts.home')
@section('content')
    <!-- main-section Start -->
    <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
    <div class="row">
      <div class="col-md-12">
        <h1 class="h1 mb-5">Quotation Information Setup</h1>
        <div class="input-group mb-3 float-none text-center mb-5">
          <input type="text" class="form-control" placeholder="Search Quotation Information" aria-label="Search Supplier data" aria-describedby="button-addon2" name="searchTerm"/>
        </div>
        <div class="row">
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
        </div>
        <table class="table table-bordered text-light p-5">
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
          </thead>
          <tbody>
             @foreach ($quotations as $quotation)
                 <tr>
                     <td>{{$quotation->id}}</td>
                     <td>{{$quotation->from_date}}</td>
                     <td>{{$quotation->to_date}}</td>
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
                     {{-- <a href="{{route('pdf.quotation',['quotation_id'=>$quotation->id])}}" title="Print"><i class="fas fa-print  fa-1x text-warning"></i></a> --}}
                     </td>
                 </tr>
             @endforeach
          </tbody>
        </table>
        {{$quotations->links()}}
      </div>
    </div>
  </div>
  <!-- main-section End -->

      <!-- Modal Quotation Information setup-->
 <div
 class="modal fade"
 id="QuotationInformation"
 tabindex="-1"
 aria-labelledby="QuotationInformationLabel"
 aria-hidden="true" wire:ignore.self>
 <div class="modal-dialog">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="QuotationInformationLabel">
         Quotation Information Setup
       </h5>
       <button
         type="button"
         class="btn-close"
         data-bs-dismiss="modal"
         aria-label="Close"
       ></button>
     </div>
     <div class="modal-body">
         <form action="{{route('addQuotationInformation')}}" method="post">
            @csrf
             <div class="row">
                 <div class="col-md-6">
                     <div class="form-group mb-3">
                         <label for="form-date" class="form-label">From date</label>
                         <input type="date" id="form-date" class="form-control @error('from_date') is-invalid @enderror" name="from_date">
                         @error('from_date')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror <br>
                       </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group mb-3">
                         <label for="to-date" class="form-label">To date</label>
                         <input type="date" id="to-date" class="form-control @error('to_date') is-invalid @enderror" name="to_date">
                         @error('to_date')
                             <span class="text-danger">{{ $message }}</span>
                         @enderror <br>
                       </div>
                 </div>
             </div>
             <div class="row" wire:ignore>
                 <div class="col-md-6">
                     <div class="form-group mb-3">
                         <label for="supplier_id" class="form-label">Supplier ID</label>
                         <select class="form-select selectpicker" aria-label="Default select example" name="supplier_id" data-live-search="true" data-style="py-0" id="supplier_id" wire:ignore>
                             <option value="">--Please Select Supplier ID--</option>
                             @foreach ($suppliers as $supplier)
                                 <option value="{{$supplier->id}}">{{$supplier->supplier_id}}</option>
                             @endforeach
                             @error('supplier_id')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror <br>
                         </select>
                     </div>
                 </div>
                 <div class="col-md-6" wire:ignore>
                     <div class="form-group mb-3">
                         <label for="supplierName" class="form-label">Supplier Name</label>
                         <input type="text" id="supplierName" class="form-control @error('supplier_name') is-invalid @enderror" name="supplier_name" readonly>
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
                         <select class="form-select" id="vehicle_code" aria-label="Default select example" name="vehicle_Code">
                             <option value="" selected>--Please Select Vehicle code--</option>
                             @foreach ($vehicles as $vehicle)
                                 <option value="{{$vehicle->vehicle_code}}">{{$vehicle->vehicle_code}}</option>
                             @endforeach
                             @error('vehicle_code')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror <br>
                         </select>
                     </div>
                 </div>
                 <div class="col-md-6">
                     <div class="form-group mb-3">
                         <label for="vehicle-name" class="form-label">Vehicle Name</label>
                         <input type="text" id="vehicle-name" class="form-control @error('vehicle_name') is-invalid @enderror" name="vehicle_name" readonly>
                         @error('vehicle_name')
                            <span class="text-danger">{{ $message }}</span>
                         @enderror <br>
                     </div>
                 </div>
             </div>
                 <div class="row">
                     <div class="col-md-6">
                         <div class="form-group mb-3">
                             <label for="parts-code" class="form-label">Parts Code</label>
                             {{-- <select class="form-select" id="parts-code" aria-label="Default select example" name="parts_code">
                                 <option value="" selected>--Please Select Parts code--</option>
                                 @foreach ($parts as $part)
                                     <option value="{{$part->parts_code}}">{{$part->parts_code}}</option>
                                 @endforeach
                                 @error('parts_code')
                                     <span class="text-danger">{{ $message }}</span>
                                 @enderror <br>
                             </select> --}}

                             <input type="text" id="parts-code" class="form-control @error('parts_code') is-invalid @enderror" name="parts_code" readonly>
                             @error('parts_code')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror <br>
                         </div>
                     </div>

                     <div class="col-md-6">
                         <div class="form-group mb-3">
                             <label for="parts-name" class="form-label">Parts Name</label>
                             <input type="text" id="parts-name" class="form-control @error('parts_name') is-invalid @enderror" name="parts_name" readonly>
                             @error('parts_name')
                                <span class="text-danger">{{ $message }}</span>
                             @enderror <br>
                         </div>
                     </div>
                     <div class="col-md-6"></div>
                 </div>
                 <div class="row">
                     <div class="col-md-12">
                         <div class="form-group mb-2">
                             <label for="company-price" class="form-label">Company Price (TK)</label>
                             <textarea type="text" id="company-price" rows="2" cols="10" class="form-control @error('company_price') is-invalid @enderror" name="company_price"></textarea>
                             @error('company_price')
                                 <span class="text-danger">{{ $message }}</span>
                             @enderror <br>
                         </div>
                     </div>
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

     $('#vehicle_code').change(function(e)  {
         var vehicle_code = e.target.value;
         console.log(vehicle_code);
         var op="";
         $.ajax({
             type:"get",
             url:"{{route('findVehicleQuotation')}}",
             data:{
                 vehicle_code:vehicle_code
             },
             success:function(data){
                 console.log(data);
                 console.log(data.parts_code);
                 // here supplier_name is coloumn name in suppliers table data.coln name
                //  $(".form-group").find('#vehicle-name').val(data.vehicle_name);
                 $(".form-group").find('#parts-code').val(data.parts_code);
                 $(".form-group").find('#parts-name').val(data.parts_name);
                 $(".form-group").find('#vehicle-name').val(data.vehicle_name);
             },
             error:function(){

             }
         });
        });


    //  $('#parts-code').change(function(e)  {
    //      var parts_code = e.target.value;
    //      console.log(parts_code);
    //      var op="";
    //      $.ajax({
    //          type:"get",
    //          url:"{{route('findParts')}}",
    //          data:{
    //              parts_code:parts_code
    //          },
    //          success:function(data){
    //              console.log(data);
    //              console.log(data.parts_name);
    //              // here supplier_name is coloumn name in suppliers table data.coln name
    //              $(".form-group").find('#parts-name').val(data.parts_name);
    //          },
    //          error:function(){

    //          }
    //      });
    //     });



 });
</script>
@endpush

