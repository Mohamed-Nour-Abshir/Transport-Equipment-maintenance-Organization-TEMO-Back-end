<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transport & Equipment Maintenance Organization(TEMO)</title>
    <link href="{{asset('assets/images/Logo-TEMO.jpg')}}" class="img-fluid w-100 rounded-circle shadow-sm" style="border-radius:50%;" rel="icon">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
      integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
    @stack('styles')
    @livewireStyles

  </head>
  <body>
    <div class="header-nav p-2">
      <div class="web-name">
        <a href="{{route('home')}}" class="float-start">
          <i class="fas fa-box-open"></i> Quotation Management System
        </a>
        <p class="float-end">
          Health & Family Welfare Ministry, Mohakhali, Dhaka-1212
        </p>
      </div>
    </div>

    <!-- Navbar-section Start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a
                class="nav-link"
                aria-current="page"
                href="{{route('suplier-information')}}">
                <i
                  class="fas fa-user-tie text-center"
                  style="margin-left: 60px"
                >
                </i>
                <br />
                Supplier Information</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('vehicle-information')}}"
                ><i
                  class="fa-solid fa-truck"
                  style="color: yellow; margin-left: 60px"
                ></i
                ><br />
                Vehicle Information</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('parts-information')}}"
                ><i
                  class="fa-solid fa-fan text-danger"
                  style="margin-left: 60px"
                ></i>
                <br />
                Parts Information</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('quotationInformation')}}"
                ><i class="fas fa-dollar" style="margin-left: 60px"></i>
                <br />Quotation Information</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('workorder-information')}}"
                ><i class="fa-solid fa-receipt" style="margin-left: 70px"></i>
                <br />Work Order Information</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link px-3" href="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-print" style="margin-left: 30px"></i>
                <br />Report Print</a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-5" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa-solid fa-circle-xmark text-danger" style="margin-left: 15px"></i><br />Logout</a>
               <form id="logout-form" action="{{route('logout')}}" method="POST">
                  @csrf
                </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Navbar-section End -->


    {{$slot}}
    @stack('modals')


          <!-- Modal Report List Modal-->
          <div class="modal fade" style="background: rgb(113, 113, 245)" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Report List</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                  <p id="output" class="text-danger mb-3"></p>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="QuotationLowestPrice">
                    <label class="form-check-label" for="QuotationLowestPrice">
                      Quotation Lowest Price
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="ComperativeStatementQuotationPriceBase">
                    <label class="form-check-label" for="ComperativeStatementQuotationPriceBase">
                      Comperative Statement Quotation Price Base
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="WorkOrderLetter">
                    <label class="form-check-label" for="WorkOrderLetter">
                      Workorder Letter
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="VehicleRegWiseAsRespectWorkorder">
                    <label class="form-check-label" for="VehicleRegWiseAsRespectWorkorder">
                      Vehicle Reg Wise As Respect Workorder
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="SparePartsWiseAsRespectWorkorder">
                    <label class="form-check-label" for="SparePartsWiseAsRespectWorkorder">
                      Spare Parts Wise As Respect Workorder
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="Supplier">
                    <label class="form-check-label" for="Supplier">
                      Supplier
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="IssueVoucherForm">
                    <label class="form-check-label" for="IssueVoucherForm">
                      Issue Voucher Form
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="Repair">
                    <label class="form-check-label" for="Repair">
                      Repair
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="DemandForm">
                    <label class="form-check-label" for="DemandForm">
                      Demand Form
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="WorkorderTotal">
                    <label class="form-check-label" for="WorkorderTotal">
                     Workorder Total
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="PartyWorkorderTotal">
                    <label class="form-check-label" for="PartyWorkorderTotal">
                      Party Workorder Total
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="DeadStock">
                    <label class="form-check-label" for="DeadStock">
                      Dead Stock
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="reportList" id="RepairVehicleList">
                    <label class="form-check-label" for="RepairVehicleList">
                      Repair Vehicle List
                    </label>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="generate" class="btn btn-outline-secondary btn-sm text-danger">Generate</button>
                </div>
              </div>
            </div>
          </div>

    <!-- footer-start  -->
    <footer>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="" class="nav-link px-5 fs-6"
              >OMS (TEMO's Personal Product)</a
            >
          </li>
          <li class="nav-item">
            <a href="" class="nav-link px-5 fs-6">Made By, Kaizen IT LTD</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link px-5 fs-6"><?php echo date("d/m/Y");?></a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link px-5 fs-6"><?php $time = date_default_timezone_set("Asia/Dhaka"); echo date("h:i A");?></a>
          </li>
        </ul>
      </nav>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>
    <script>
      function close_window() {
        if (confirm("Close Window?")) {
            window.close();
        }
    }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js" integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    @livewireScripts
    @stack('scripts')
  </body>
</html>
