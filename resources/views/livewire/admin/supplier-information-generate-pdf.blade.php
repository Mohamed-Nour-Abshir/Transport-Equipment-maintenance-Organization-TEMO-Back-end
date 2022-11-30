<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEMO</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico')}}">
    <style>
        body{
            background-color: #F6F6F6;
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: rgb(113, 113, 245)
           /* padding: 10px 40px; */
           padding-top: 0;
           padding-right: 10;
           padding-bottom: 60px;
           padding-left: 10;
        }
        .logo{
            width: 50%;
            margin-top: 10px;
        }
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
            padding-bottom: 10px;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div>
                <div class="logo">
                    <h1 class="text-white">TEMO</h1>
                </div>
                <div>
                    <div class="company-details">
                        <p class="text-white">Transport & Equipment maintenance Organization(TEMO)</p>
                        <p class="text-white"> Health & Family Welfare Ministry, Mohakhali, Dhaka-1212</p>
                        <p class="text-white">+8801730931984</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <div class="row">
                <div class="">
                    <h2 class="heading">Supplier Information</h2>
                    
                </div>

            </div>
        </div>

        <div class="body-section">
            <h3 class="heading">{{$supplier->supplier_name}} Information</h3>
            <br>
            <table class="table table-bordered text-light p-5">
                <thead>
                  <tr>
                    <th>SL No.</th>
                    <th>Supplier Id</th>
                    <th>Supplier Name</th>
                    <th>Phone No</th>
                    <th>Email Acc</th>
                    <th>Supplier Address</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                 <tr>
                   <td>{{$supplier->id}}</td>
                   <td>{{$supplier->supplier_id}}</td>
                   <td>{{$supplier->supplier_name}}</td>
                   <td>{{$supplier->supplier_phone}}</td>
                   <td>{{$supplier->supplier_email}}</td>
                   <td>{{$supplier->supplier_address}}</td>
                   <td>{{$supplier->date}}</td>
                 </tr>
                  
                </tbody>
              </table>
            <br>
        </div>

        <div class="body-section">
            <p>&copy; Copyright <?php echo date('Y');?> - TEMO. All rights reserved.
                <a href="http://127.0.0.1:8000" class="float-right">www.temo.com</a>
            </p>
        </div>
    </div>

</body>
</html>