<div>
   <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto;">
    @if (Session::has('message'))
        <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
    @endif
    <form wire:submit.prevent="addSupplierInformation">
      <h1 class="text-light h1 text-center mb-2">Add Supplier Information</h1>
        <div class="form-group mb-3">
          <label for="supplier-sl-no" class="form-label">SL NO.</label>
          <input type="text" id="supplier-sl-no" class="form-control" disabled>
        </div>
        <div class="form-group mb-3">
          <label for="supplier-id" class="form-label">Supplier id</label>
          <input type="text" id="supplier-id" class="form-control" disabled>
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
          <textarea  id="address" cols="30" rows="10" class="form-control" wire:model="supplier_address"></textarea>
          @error('supplier_address')<span class="text-danger">{{$message}}</span> @enderror <br>
        </div>
        <div class="form-group mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="date" id="date"  class="form-control" wire:model="date">
          @error('date')<span class="text-danger">{{$message}}</span> @enderror <br>
        </div>
      <button type="submit" class="btn btn-primary"><i class="fa fa-plus fa-lg"></i>&nbsp;Save</button>
    </form>
   </div>
</div>
