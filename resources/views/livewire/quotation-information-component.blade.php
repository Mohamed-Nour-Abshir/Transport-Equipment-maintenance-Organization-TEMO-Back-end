<div>
       <!-- main-section Start -->
       <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
       <div class="row">
         <div class="col-md-12">
           <h1 class="h1 mb-5">Quotation Information Setup</h1>
           <div class="input-group mb-3 float-none text-center mb-5">
             <input type="text" class="form-control" placeholder="Search Quotation Information" aria-label="Search Supplier data" aria-describedby="button-addon2" wire:model="searchTerm"/>
             <button class="btn btn-primary" type="button" id="button-addon2">
               Serach
             </button>
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
               <a href="{{route('add.quotation')}}" class="btn btn-primary mb-3">Add Quotation Information</a>
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
                        <a href="{{route('edit.quation',['quotation_id'=>$quotation->id])}}" title="Edit"><i class="fas fa-edit text-success"></i></a>
                        <a href="#" onclick="confirm('Are you sure to Delete This Information?') || event.stopImmediatePropagation()" wire:click.prevent="deleteQuotation({{ $quotation->id }})" title="delete"><i class="fas fa-remove text-danger"></i></a>
                        <a href="{{route('pdf.quotation',['quotation_id'=>$quotation->id])}}" title="Print"><i class="fas fa-print text-warning"></i></a>
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
</div>
