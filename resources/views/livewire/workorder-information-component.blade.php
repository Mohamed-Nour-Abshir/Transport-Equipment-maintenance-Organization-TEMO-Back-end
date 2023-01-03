<div>
        <!-- main-section Start -->
        <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            <div class="row">
              <div class="col-md-12">
                <h1 class="h1 mb-5">Workorder Information Setup</h1>
                <div class="input-group mb-3 float-none text-center mb-5">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Search Workorder Information"
                    aria-label="Search Supplier data"
                    aria-describedby="button-addon2" wire:model="searchTerm"/>
                </div>
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
                          <a href="" onclick="confirm('Are you sure to Delete this Information?') || event.stopImmediatePropagation()" wire:click.prevent='deleteWorkorder({{$workorder->id}})' title="delete"><i class="fas fa-remove text-danger fa-2x"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- main-section End -->


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
                  <form wire:submit.prevent='addWorkorderInformation'>
                      <div class="row">
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="supplier-id" class="form-label">Quotation From</label>
                                <input type="date" id="supplier-id" class="form-control" wire:model='quotation_from'>
                                @error('quotation_from')<span class="text-danger">{{ $message }}</span>@enderror <br>
                             </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="supplier-id" class="form-label">Quotation To</label>
                                <input type="date" id="supplier-id" class="form-control" wire:model='quotation_to'>
                                @error('quotation_to')<span class="text-danger">{{ $message }}</span>@enderror <br>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="supplier_id" class="form-label">Supplier ID</label>
                                <select class="form-select selectpicker bg-danger" aria-label="Default select example" wire:model="supplier_id" data-live-search="true" data-style="py-0" id="supplier_id">
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
                                <select class="form-select bg-danger" id="vehicle-code" aria-label="Default select example" wire:model="vehicle_code">
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
                                  <label for="supplier-id" class="form-label">Supplier Name</label>
                                  <input type="text" id="supplier-id" class="form-control" wire:model="supplier_name">
                                  @error('supplier_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                                </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group mb-3">
                                  <label for="supplier-id" class="form-label">Vehicle Name</label>
                                  <input type="text" id="supplier-id" class="form-control" wire:model="vehicle_name">
                                  @error('vehicle_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                                </div>
                          </div>
                      </div>
                      <div class="parts">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group mb-3">
                                    <label for="parts-code" class="form-label">Parts Code</label>
                                    <select class="form-select bg-danger" id="parts-code" aria-label="Default select example" wire:model="parts_code">
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
                                    <label for="supplier-id" class="form-label">Parts Price (TK)</label>
                                    <input type="text" id="supplier-id" class="form-control" wire:model="parts_price">
                                    @error('parts_price')<span class="text-danger">{{ $message }}</span>@enderror <br>
                                  </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                  <label for="supplier-id" class="form-label">Parts Name</label>
                                  <input type="text" id="supplier-id" class="form-control" wire:model="parts_name">
                                  @error('parts_name')<span class="text-danger">{{ $message }}</span>@enderror <br>
                               </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group mb-3">
                                <label for="supplier-id" class="form-label">Order Date</label>
                                <input type="date" id="supplier-id" class="form-control" wire:model="order_date">
                                @error('order_date')<span class="text-danger">{{ $message }}</span>@enderror <br>
                             </div>
                            </div>
                          </div>

                          <div class="form-group mb-3">
                            <label for="supplier-id" class="form-label">parts ID</label>
                            <input type="text" id="supplier-id" class="form-control" wire:model="parts_id">
                         </div>
                          <div class="form-group mb-3">
                            <label for="supplier-id" class="form-label">Vehicle Type</label>
                            <input type="text" id="supplier-id" class="form-control" wire:model="vehicle_type">
                            @error('vehicle_type')<span class="text-danger">{{ $message }}</span>@enderror <br>
                         </div>
                          <div class="form-group mb-3">
                            <label for="supplier-id" class="form-label">Parts Quantity</label>
                            <input type="text" id="supplier-id" class="form-control" wire:model="parts_qty">
                            @error('parts_qty')<span class="text-danger">{{ $message }}</span>@enderror <br>
                         </div>
                          <div class="form-group mb-3">
                            <label for="supplier-id" class="form-label">Order Parts Price Tk</label>
                            <input type="text" id="supplier-id" class="form-control" wire:model="order_parts_price">
                            @error('order_parts_price')<span class="text-danger">{{ $message }}</span>@enderror <br>
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
</div>
