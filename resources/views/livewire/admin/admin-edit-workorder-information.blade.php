<div>
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
                    <button type="submit" class="btn btn-success"><i class="fas fa-edit"></i> Update</button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
 </div>

