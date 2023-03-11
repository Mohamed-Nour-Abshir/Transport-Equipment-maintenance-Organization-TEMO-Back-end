<div>
        <!-- main-section Start -->
        <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
            <h1 class="p-1">Issue Voucher Form Report</h1>
            <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" method="get">
                <div class="col-auto">
                    <label for="supplier_id" class="form-label">Vehicle Type</label>
                  </div>
                  <div class="col-auto">
                    <select class="form-select selectpicker" aria-label="Default select example" name="vehicle_type" data-live-search="true" data-style="py-0" id="supplier_id">
                        @foreach ($vehicles as $vehicle)
                        @if ($vehicle->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
                            <option value="{{$vehicle->vehicle_type}}">{{$vehicle->vehicle_type}}</option>
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
                    <h1 class="text-decoration-underline text-center mb-2 h5">Issue Voucher Form</h1>
                    <b class="text-left mb-3"><span class="me-5"> Fiscal Year : {{date('Y',strtotime($searchFromDate))}} - {{date('Y',strtotime($searchToDate))}}</span></b>
                    <div class="d-flex justify-content-between">
                        <b class="text-left"><span class="me-5"> VehicleReg : {{$searchVehicleName}}</span></b>
                        <b class="text-left"><span class="me-5"> Date : {{date('d-m-Y')}}</span></b>
                        <b class="text-left"><span class="me-5"> Voucher No : </span></b>
                    </div>
                    {{-- <p class="text-center me-5">Fiscal Year</p> --}}
                </div>
              <table class="table table-bordered mt-3">
                <thead>
                  <tr>
                    <th>SL No </th>
                    <th>Order No</th>
                    <th>Stock Book</th>
                    <th>Pge No</th>
                    <th>Unit</th>
                    <th>Qty</th>
                    <th>U/Price</th>
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
                    <td></td>
                    <td></td>
                    <td>{{$workorder->parts->parts_unit}}</td>
                    <td>{{$workorder->parts_qty}}</td>
                    <td>{{$workorder->parts_price}}</td>
                    <td>{{$workorder->parts_price * $workorder->parts_qty}}</td>
                    {{-- <td><a href="{{route('pdf.quotation',['quotation_id'=>$workorder->id])}}" title="Print" title="preview"><i class="fas fa-eye"></i></a></td> --}}
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
              {{-- @php
                $totalPrice = 0;
              @endphp
                @foreach ($quotations as $item)
                    @php
                    $totalPrice += $item->order_parts_price;
                    @endphp
                @endforeach
                @if ($workorder->fiscal_year === date('d-m-Y',strtotime($fiscalYear->start_date)))
              <h1 class="text-center" style="margin-left: 350px;">Order Total (TK.) : <b>{{$totalPrice}}</b></h1>
              @endif --}}
              <div class="d-flex justify-content-between">
                <h1 >Supplier Store</b></h1>
                <h1 ></b>Recevier</h1>
              </div>
              @endif
            </div>
</div>
