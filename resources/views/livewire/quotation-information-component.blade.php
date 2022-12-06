<div>
       <!-- main-section Start -->
       <div
       class="container p-5"
       style="background: rgb(113, 113, 245); color: #ffff; width: auto"
     >
       <div class="row">
         <div class="col-md-12">
           <h1 class="h1 mb-5">Quotation Information Setup</h1>
           <div class="input-group mb-3 float-none text-center mb-5">
             <input
               type="text"
               class="form-control"
               placeholder="Search Supplier data"
               aria-label="Search Supplier data"
               aria-describedby="button-addon2"
             />
             <button class="btn btn-primary" type="button" id="button-addon2">
               Serach
             </button>
           </div>
           <div class="row">
             <div class="col-md-6">
               <p class="float-start">All Quotation Information</p>
             </div>
             <div class="col-md-6">
               <a href="{{route('add.quotation')}}" class="btn btn-primary float-end mb-3">Add Quotation Information</a>
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
                        <a href="" title="Edit"><i class="fas fa-edit text-success"></i></a>
                        <a href="" title="delete"><i class="fas fa-remove text-danger"></i></a>
                        <a href="" title="Print"><i class="fas fa-print text-warning"></i></a>
                        </td>
                    </tr>
                @endforeach
             </tbody>
           </table>
         </div>
       </div>
     </div>

     <!-- main-section End -->
</div>
