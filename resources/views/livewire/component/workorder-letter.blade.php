<div>
    <!-- main-section Start -->
    <div class="container-fluid pb-3" style="background: rgb(113, 113, 245); color: #ffff; width: auto">
        <h1 class="p-1">Workorder Letter</h1>
        <form class="row g-3 p-2 mt-3 border border-light" id="generate-form" action="workorder-letter" method="GET">
            <div class="col-auto">
              <label for="fromdate" class="mt-2">From Date</label>
              </div>
              <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="from_date" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($fiscal_year as $item)
                      <option value="{{$item->start_date}}">{{date("d/m/Y", strtotime($item->start_date))}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-auto">
              <label for="todate" class="mt-2">To Date</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="to_date" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($fiscal_year as $item)
                      <option value="{{$item->end_date}}">{{date("d/m/Y", strtotime($item->end_date))}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-auto">
              <label for="supplier_id" class="form-label">Workorder No.</label>
            </div>
            <div class="col-auto">
              <select class="form-select selectpicker" aria-label="Default select example" name="vehicle_name" data-live-search="true" data-style="py-0" id="supplier_id">
                  @foreach ($workordernos as $workorder)
                      <option value="{{$workorder->order_no}}">{{$workorder->order_no}}</option>
                  @endforeach
              </select>
            </div>
            <div class="col-auto">
              <button type="submit" class="btn btn-outline-light  mb-3">Preview</button>
            </div>
        </form>
    </div>


    <div class="d-flex justify-content-center mt-5">
        <a class="btn btn-warning mb-3 text-center printWorkLetter">Generate Pdf <i class="fas fa-download"></i></a>
    </div>

    <div class="container" id="WorkLetter">
      @if(isset($searchVehicleName))
        <div class="d-flex justify-content-between">
            <img src="{{asset('assets/images/workr_1.jpg')}}" alt="" width="100px" height="100px">
            <img src="{{asset('assets/images/wokr_2.jpg')}}" alt="" width="100px" height="100px">
        </div>


        {{-- @if ($item->order_parts_price === $minNumber) --}}
        <div class="d-flex flex-column justify-content-center">
            <p class="text-center" style="margin-top:-10px;">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p><br>
            <p class="text-center"  style="margin-top:-10px;">স্বাস্থ্য ও পরিবার কল্যাণ মন্ত্রণালয়</p><br>
            <p class="text-center"  style="margin-top:-10px;">যানবাহন ও যন্ত্রপাতি রক্ষণাবেক্ষণ সংস্থা (টেমো)</p><br>
            <p class="text-center"  style="margin-top:-10px;">মহাখালী, ঢাকা-১২১২</p><br>
            <p class="text-center"  style="margin-top:-10px;"><a href="http://www.temo.gov.bd/">www.temo.gov.bd</a></p>
        </div>
        <div class="d-flex justify-content-between mt-2 mb-4">
            <p>স্মারক নম্বর:- ৪৫.৯০.০০০০.০০২.২০.০৪. {{ date('y', strtotime($searchFromDate)) }} - {{ date('y', strtotime($searchToDate)) }} / {{$searchVehicleName}}    </p>
            @foreach ($quotations as $item)

            @endforeach
            {{-- @foreach ($items as $item)

            @endforeach --}}
            <p>তারিখ: {{ date('d/m/Y', strtotime($item->order_date)) }}  খ্রিঃ </p>
        </div>
        <span class="p-2 mb-3"><b>প্রাপক :   </b> {{$item->supplier->supplier_name}} </span>
        <p class="p-2 mb-3 ms-5 ps-3"><b>{{$item->supplier->supplier_address}}</b> </p>
        <p class="mt-4">বিষয়: <b class="text-decoration-underline"> সরবরাহ আদেশ প্রসঙ্গে।</b></p>
        <p class="mt-3">আপনার বাৎসরিক 29/06/ {{ date('Y', strtotime($searchFromDate)) }} খ্রিঃ  তারিখ দরপত্রের
          বরাতে অবগত করানো যাইতেছে যে, আপনার দরপত্র গ্রহন করা হইয়েছে।  </p> <p class="mt-2"> আপনাকে নিম্ন লিখিত মালামাল
          সরবরাহ করার নির্দেশ দেওয়া যাইতেছে।</p>

          <table class="table table-bordered mt-3">
            <thead class="table-dark">
              <tr>
                <th>নং</th>
                <th>কোড নং</th>
                <th>যন্ত্রাংশের বিবরণ</th>
                <th>গাড়ির প্রকার</th>
                <th>প্রস্ততকারী দেশ</th>
                <th>একক</th>
                <th>দর</th>
                <th>পরিমাণ</th>
                <th>টাকা</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $i = 0;
                    ?>
                @foreach ($quotations as $item)
                    <tr>
                        <td>{{++ $i}}</td>
                        <td>{{$item->parts_code}}</td>
                        <td>{{$item->parts_name}}</td>
                        <td>{{$item->vehicle_type}}</td>
                        <td>{{$item->parts->parts_manufacture}}</td>
                        <td>{{$item->parts->parts_unit}}</td>
                        <td>{{$item->parts_price}}</td>
                        <td>{{$item->parts_qty}}</td>
                        <td>{{$item->parts_price * $item->parts_qty}}</td>
                    </tr>
                    @php
                        $numbers = [$item->parts_price * $item->parts_qty] ;
                    @endphp
                @endforeach

                @php
                    $total = array_sum($numbers);
                @endphp
            </tbody>
          </table>
          <h1 class="text-center" style="margin-left: 750px;"><b>Total Taka : </b><b class="" style="margin-left:200px;"> {{$total}}</b></h1>
          @foreach ($quotations as $item)

          @endforeach
          <p class="mb-2"><b>নিম্নলিখিত শর্ত পালন স্বপেক্ষে বিল পরিশোধ করা হইবে:</b></p>
          <p class="mt-2">১। মালামাল {{date('d/m/Y',strtotime('+1 week' .$item->order_date))}} খ্রিঃ তারিখ বেলা ২ ঘটিকার মধ্যে সরবরাহ করিতে হইবে অন্যথায় তাহার সরবরাহ আদেশ </p> <p class="ms-3 mt-2">বাতিল বলিয়া গণ্য হইবে এবং তালিকাভুক্ত বাতিল বলিয়া গণ্য হইবে।</p>
          <p class="mt-2">২। মালামাল/যন্ত্রাংশ দরপত্রের বিবরন (স্পেসিফিকেশন) নমুনা অনুযায়ী সরবরাহ করিতে হইবে।</p>
          <p class="mt-2">৩। মালামাল/যন্ত্রাংশ অত্র কার্যালয়ের মান নিয়ন্ত্রন দল কর্তৃক গৃহিত না হইলে সরবরাহকারি মালামাল ফেরৎ লইতে বাধ্য থাকিবেন। </p>
          <div class="d-flex justify-content-between mt-5">
            <p></p>
            <div>
              <p class="mt-2 text-center"> ওয়ার্কসপ ম্যানেজার </p>
              <p class=""> ফোন নম্বর: +৮৮০২২২২২৯৮৫৯৫</p>
              <p class="">    Email: healthtemo@gmail.com</p>
            </div>
          </div>
          <div class="d-flex justify-content-between mt-4">
            <p>স্মারক নম্বর:- ৪৫.৯০.০০০০.০০২.২০.০৪. {{ date('y', strtotime($searchFromDate)) }} - {{ date('y', strtotime($searchToDate)) }} / {{$searchVehicleName}}
            <p> তারিখ:{{ date('d/m/Y', strtotime($item->order_date)) }} খ্রিঃ</p>
          </div>

          <p class="mt-5"><b>অনুলিপি, অবগতি ও প্রয়োজনীয় ব্যবস্থা গ্রহণের জন্য প্রেরণ করা হইল:</b></p>
          <p class="mt-2">১। প্রধান হিসাব রক্ষণ কর্মকর্তা, স্বাস্থ্য ও পরিবার কল্যাণ মন্ত্রণালয়, এজিবি ভবন, তৃতীয় ফেজ. সেগুনবাগিচা,ঢাকা।</p>
          <p class="mt-2">২। ষ্টোর অফিসার,টেমো,মহাখালী,ঢাকা।</p>
          <p class="mt-2">৩। হিসাব রক্ষক,টেমো,মহাখালী,ঢাকা।</p>
          <p class="mt-2">৪। মান নিয়ন্ত্রণ দল, টেমো, মহাখালী,ঢাকা।</p>


          <div class="d-flex justify-content-between">
            <div></div>
            <div>
                <p class="text-center"> ওয়ার্কসপ ম্যানেজার</p>
                  <p>ফোন নম্বর : +৮৮০২২২২২৯৮৫৯৫</p>
                  <p> Email: healthtemo@gmail.com</p>
            </div>
          </div>
          {{-- @endif --}}

      @endif
    </div>

    <!-- main-section End -->

</div>


   {{-- @if($showTableQuotationTable) --}}
    {{-- <div class="d-flex justify-content-between">
        <h1 class="h4">Fiscal Year: <?php echo date("Y");?>-<?php echo date('Y', strtotime('+1 year'));?></h1>
        <a href="{{route('pdf.workorderLetter')}}" class="btn btn-warning mb-3 text-center">Generate Pdf <i class="fas fa-download"></i></a>
        <p></p>
    </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>SL NO.</th>
            <th>Parts Code</th>
            <th>Parts Name</th>
            <th>Manufacture</th>
            <th>Parts Unit</th>
            @foreach ($quotations as $supplier)
                <th>{{$supplier->supplier_name}}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
            @forelse ($quotations as $item)
            @if ($item->fiscal_year === date("Y")."-".date('Y', strtotime('+1 year')))
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->parts_code}}</td>
                <td>{{$item->parts_name}}</td>
                <td>{{$item->parts->parts_manufacture}}</td>
                <td>{{$item->parts->parts_unit}}</td>
                @foreach ($quotations as $quotation)
                  <td @if($quotation->order_parts_price === $minNumber) class="bg-secondary text-dark" @endif>{{$quotation->order_parts_price}}</td>
                @endforeach
            </tr>
            @endif
            @empty
                <td>No data available</td>
            @endforelse

        </tbody>
      </table> --}}
      {{-- <p>Lowest Price Submission: </p> --}}
      {{-- @endif --}}
