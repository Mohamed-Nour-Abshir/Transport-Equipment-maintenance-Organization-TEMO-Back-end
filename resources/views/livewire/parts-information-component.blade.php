<div>
        <!-- main-section Start -->
        <div class="container p-5" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            @if (Session::has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <div class="row">
          <div class="col-md-12">
            <h1 class="h1 mb-5">Parts Information Setup</h1>
            <div class="input-group mb-3 float-none text-center mb-5">
              <input type="text" class="form-control" placeholder="Search Supplier data" aria-label="Search Supplier data" aria-describedby="button-addon2" wire:model='searchTerm'>
              <button class="btn btn-primary" type="button" id="button-addon2">
                Serach
              </button>
            </div>
            <div class="row">
                <div class="d-flex justify-content-between">
                    <p class="">All Parts Information</p>
                    <a href="{{ route('pdf-generate-all-parts-information') }}" class="btn btn-warning btn-sm mb-4">Generate Pdf <i class="fas fa-download"></i></a>
                    <a href="{{route('add.parts')}}" class="btn btn-primary float-end mb-3">Add Parts Information</a>
                </div>
            </div>
            <table class="table table-bordered text-light p-5">
              <thead>
                <tr>
                  <th>SL No.</th>
                  <th>Vehicle Code</th>
                  <th>Parts Code</th>
                  <th>Parts Name</th>
                  <th>Parts Manufacture</th>
                  <th>Parts Unit</th>
                  <th>Parts ED</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($parts as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->vehicle->vehicle_code}}</td>
                        <td>{{$item->parts_code}}</td>
                        <td>{{$item->parts_name}}</td>
                        <td>{{$item->parts_manufacture}}</td>
                        <td>{{$item->parts_unit}}</td>
                        <td>{{$item->parts_date}}</td>
                        <td>
                        <a href="{{route('edit.parts',['parts_id'=>$item->id])}}" title="Edit"><i class="fas fa-edit text-success fa-2x"></i></a>
                        <a href="" onclick="confirm('Are you sure to Delete this Information?') || event.stopImmediatePropagation()" wire:click.prevent="deletePartsInfo({{ $item->id }})" title="delete"><i class="fas fa-remove text-danger fa-2x"></i></a>
                        <a href="{{route('pdf-generate-parts-information',['parts_id'=>$item->id])}}" title="Print"><i class="fas fa-print text-warning fa-2x"></i></a>
                        </td>
                    </tr>
                @endforeach

              </tbody>
            </table>
            <div class="d-flex">
                {{ $parts->links() }}
            </div>
          </div>
        </div>
      </div>

      <!-- main-section End -->
</div>
