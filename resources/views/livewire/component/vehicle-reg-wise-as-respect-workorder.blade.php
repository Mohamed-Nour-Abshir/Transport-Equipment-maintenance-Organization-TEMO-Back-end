<div>
        <!-- main-section Start -->
        <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            <h1 class="p-1">Vehcile Reg As Respect Workorder</h1>
            <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-light mb-3" wire:click="showQuotation">Preview</button>
              </div>
            </form>
        </div>

        <div class="container p-5">
          @if($showTableQuotationTable)
            <div class="d-flex justify-content-center">
                <a href="{{route('pdf-generate-all-parts-information')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
            </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Parts Name</th>
                <th>Unit</th>
                <th>Qty</th>
                <th>U/Price</th>
                <th>Amount</th>
                <th>Supplier Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($quotations as $quotation)
                  <tr>
                    <td>{{$quotation->id}}</td>
                    <td>{{$quotation->parts->parts_date}}</td>
                    <td>{{$quotation->parts_name}}</td>
                    <td>{{$quotation->parts->parts_unit}}</td>
                    <td>{{$quotation->parts->parts_qty}}</td>
                    <td>{{$quotation->parts->parts_price}}</td>
                    <td>{{ number_format($quotation->parts->parts_price  * $quotation->parts->parts_qty) }}</td>
                    <td>{{$quotation->supplier_name}}</td>
                    <td><a href="{{route('pdf.quotation',['quotation_id'=>$quotation->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>

        <!-- main-section End -->
</div>
