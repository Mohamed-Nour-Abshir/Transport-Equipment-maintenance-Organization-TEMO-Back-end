<div>
    <!-- main-section Start -->
    <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1 mb-5">Supplier Information Setup</h1>
                <div class="input-group mb-3 float-none text-center mb-5">
                    <input type="text" class="form-control" placeholder="Search Supplier data by id, name, phone, email, address"
                        aria-label="Search Supplier data" aria-describedby="button-addon2" wire:model="searchTerm" />
                </div>
                @if (Session::has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="d-flex justify-content-between">
                        <p class="">All Suppliers Information</p>
                        <a href="{{ route('pdf-generate-all-suppliers-information') }}"
                            class="btn btn-warning btn-sm mb-4">Generate Pdf <i class="fas fa-download"></i></a>
                        <a href=""  data-bs-toggle="modal"
                        data-bs-target="#SupplierInformation" class="btn btn-primary mb-3">Add Suuplier
                            Information</a>
                    </div>
                </div>
                <table class="table table-bordered text-light p-5">
                    <thead>
                        <tr>
                            <th>SL No.</th>
                            <th>Supplier Id</th>
                            <th>Supplier Name</th>
                            <th>Phone No</th>
                            <th>Email Acc</th>
                            <th>Supplier Address</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id }}</td>
                                <td>{{ $supplier->supplier_id }}</td>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{ $supplier->supplier_phone }}</td>
                                <td>{{ $supplier->supplier_email }}</td>
                                <td>{{ $supplier->supplier_address }}</td>
                                <td>{{ $supplier->date }}</td>
                                <td>
                                    <a href="{{ route('admin-edit-supplier', ['supplierid' => $supplier->id]) }}"
                                        title="Edit"><i class="fas fa-edit text-primary fa-1x"></i></a>
                                    <a href="#" onclick="confirm('Are you sure to Delete this Supplier Information?') || event.stopImmediatePropagation()" wire:click.prevent="deleteSupplier({{ $supplier->id }})" title="delete"><i class="fas fa-remove text-danger fa-1x"></i></a>
                                    <a href="{{ route('pdf-generate-supplier-information', ['supplierid' => $supplier->id]) }}"
                                        title="Print"><i class="fas fa-print text-warning fa-1x"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- main-section End -->

    <!-- Modal Add Supplier Information Modal-->
    <div
       class="modal fade"
       id="SupplierInformation"
       tabindex="-1"
       aria-labelledby="SupplierInformationLabel"
       aria-hidden="true"
     wire:ignore.self>
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="SupplierInformationLabel">
               Supplier Information Setup
             </h5>
             <button
               type="button"
               class="btn-close"
               data-bs-dismiss="modal"
               aria-label="Close"
             ></button>
           </div>
           <div class="modal-body">
             <form wire:submit.prevent="addSupplierInformation">
               <div class="form-group mb-3">
                 <label for="supplier-sl-no" class="form-label">SL NO.</label>
                 <input type="text" id="supplier-sl-no" class="form-control bg-danger" disabled>
               </div>
               <div class="form-group mb-3">
                 <label for="supplier-id" class="form-label">Supplier ID</label>
                 <input type="text" id="supplier-id" class="form-control bg-danger" disabled>
               </div>
               <div class="form-group mb-3">
                 <label for="supplier-name" class="form-label">Supplier Name</label>
                 <input type="text" id="supplier-name" class="form-control" wire:model="supplier_name">
                 @error('supplier_name')<span class="text-danger">{{$message}}</span> @enderror <br>
               </div>
               <div class="form-group mb-3">
                 <label for="phone-no" class="form-label">Phone No</label>
                 <input type="number" id="phone-no" class="form-control" wire:model="supplier_phone">
                 @error('supplier_phone')<span class="text-danger">{{$message}}</span> @enderror <br>
               </div>
               <div class="form-group mb-3">
                 <label for="email" class="form-label">Email Acc</label>
                 <input type="email" id="email" class="form-control" wire:model="supplier_email">
                 @error('supplier_email')<span class="text-danger">{{$message}}</span> @enderror <br>
               </div>
               <div class="form-group mb-3">
                 <label for="address" class="form-label">Supplier Address</label>
                 <textarea  id="address" cols="5" rows="5" class="form-control" wire:model="supplier_address"></textarea>
                 @error('supplier_address')<span class="text-danger">{{$message}}</span> @enderror <br>
               </div>
               <div class="form-group mb-3">
                 <label for="date" class="form-label">Date</label>
                 <input type="date" id="date"  class="form-control" wire:model="date">
                 @error('date')<span class="text-danger">{{$message}}</span> @enderror <br>
               </div>
           </div>
           <div class="modal-footer">
             <button type="submit" class="btn btn-primary">Save</button>
           </form>
             <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
           </div>
         </div>
       </div>
     </div>


</div>
