<div>
        <!-- main-section Start -->
        <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            <h1 class="p-1">Quotation Lowest Price Generation Report</h1>
            <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
              <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-outline-light mb-3" wire:click="showQuotation">Preview</button>
              </div>
            </form>
        </div>

        <div class="container p-5">
        @if($showTableQuotationTable)
        <div class="d-flex justify-content-between">
            <p></p>
            <a href="{{route('pdf.all-quotations')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
            <p></p>
        </div>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Parts Code</th>
                <th>Parts Name</th>
                <th>Manufacture</th>
                <th>Unit</th>
                <th>Price</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($quotations as $item)
                <tr>
                    <td>{{$item->parts_code}}</td>
                    <td>{{$item->parts_name}}</td>
                    <td>{{$item->parts->parts_manufacture}}</td>
                    <td>{{$item->parts->parts_unit}}</td>
                    <td>{{$item->company}}</td>
                    <td>{{$item->from_date}}</td>
                    <td><a href="{{route('pdf.quotation',['quotation_id'=>$item->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td>
                </tr>
                @endforeach

            </tbody>
          </table>
          <p>Lowest Price Submission: </p>
          @endif
        </div>

        <!-- main-section End -->

</div>
