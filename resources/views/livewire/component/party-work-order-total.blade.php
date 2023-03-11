<div>
        <!-- main-section Start -->
        <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            <h1 class="p-1">Party's Order Total Report</h1>
            <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
                <div class="col-auto">
                    <label for="supplier_id" class="form-label">Party Name</label>
                  </div>
                  <div class="col-auto">
                    <select class="form-select selectpicker" aria-label="Default select example" name="supplier_name" data-live-search="true" data-style="py-0" id="supplier_id">
                        @foreach ($vehicles as $vehicle)
                        @if ($vehicle->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
                            <option value="{{$vehicle->supplier_name}}">{{$vehicle->supplier_name}}</option>
                        @endif
                        @endforeach
                    </select>
                  </div>
                      <div class="col-auto">
                    <label for="fromdate" class="mt-2">From Date</label>
                    </div>
                    <div class="col-auto">
                    <select class="form-select selectpicker" aria-label="Default select example" name="from_date" data-live-search="true" data-style="py-0" id="supplier_id">
                        @foreach ($fiscal_year as $item)
                            <option value="{{$item->start_date}}">{{$item->start_date}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="col-auto">
                    <label for="todate" class="mt-2">To Date</label>
                  </div>
                  <div class="col-auto">
                    <select class="form-select selectpicker" aria-label="Default select example" name="to_date" data-live-search="true" data-style="py-0" id="supplier_id">
                        @foreach ($fiscal_year as $item)
                            <option value="{{$item->end_date}}">{{$item->end_date}}</option>
                        @endforeach
                    </select>
                  </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
              </div>
            </form>
        </div>
        <div class="d-flex justify-content-center mt-5">
            <a class="btn btn-warning mb-3 text-center spareParts">Generate Pdf <i class="fas fa-download"></i></a>
        </div>
        <div class="container p-5" id="spareParts">
          @if(isset($searchVehicleName))
            <div class="d-flex justify-content-center">
                {{-- <a href="{{route('spareparts-reg-as-respectedWorkorder')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a> --}}
            </div>
            <div>
                <h1 class="text-decoration-underline text-center mb-2 h5">Party Order Total</h1>
                <p class="text-center mb-3"><span class="me-5"> Period From: {{date('d-m-Y',strtotime($searchFromDate))}}</span>   <span class="">To: {{date('d-m-Y',strtotime($searchToDate))}}</span></p>
                {{-- <p class="text-center me-5">Fiscal Year</p> --}}
            </div>
            @foreach ($quotations as $workorder)
            @endforeach
            <p class="fw-bold">Fiscal Year :  <span class="text-start fw-bold ms-4">{{date('Y',strtotime($searchFromDate))}} - {{date('Y',strtotime($searchToDate))}}</span> </p>
            <p class="fw-bold">Party ID :  <span class="ms-5 text-start fw-bold">S{{$workorder->supplier_id}}</span> </p>
            <p class="fw-bold">Party Name :  <span class="text-start fw-bold ms-4">{{$workorder->supplier_name}}</span> </p>
          <table class="table table-bordered mt-3">
            <thead>
              <tr>
                <th>Sl. No</th>
                <th>Order No</th>
                <th>Workorder Date</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $i = 0;
                ?>
              @foreach ($quotations as $workorder)
              @if ($workorder->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
              <tr>
                <td>{{++ $i}}</td>
                <td>{{$workorder->order_no}}</td>
                <td>{{date('d-m-Y',strtotime($workorder->order_date))}}</td>
                <td>{{$workorder->parts_price * $workorder->parts_qty}}</td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
          @php
            $totalPrice = 0;
          @endphp
            @foreach ($quotations as $item)
                @php
                $totalPrice += $item->order_parts_price;
                @endphp
            @endforeach
            @if ($workorder->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
          <h1 class="text-center" style="margin-left: 350px;">Order Total (TK.) : <b>{{$totalPrice}}</b></h1>
          @endif
          @endif
        </div>
</div>
