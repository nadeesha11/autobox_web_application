@extends('Web.Layout.Layout')
@section('content')
    <style>
        .content-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.8);
            /* Add a background color to the content container if needed */
            padding: 20px;
        }

        .hover_green_color:hover {
            border: 1px green solid;
            border-radius: 5px;

        }
    </style>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="{{ route('web.dashboardIndex') }}">Dashboard</a> <span></span> <a
                        href="#">Buy Ads</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">

                @if (session('free_package_success'))
                    <div class="alert alert-success">
                        {{ session('free_package_success') }}
                        <a href="{{ route('web.dahsboard.currentPackage') }}">details</a>
                    </div>
                @elseif(session('wrong'))
                    <div class="alert alert-danger">
                        {{ session('wrong') }}
                    </div>
                @elseif(session('free_package_already_activate'))
                    <div class="alert alert-info">
                        {{ session('free_package_already_activate') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Buy Ads Packages</h5>
                    </div>
                    <div class="card-body">

                        <div class="row ">
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card-body hover_green_color">
                                    <div style="background-color: rgba(255, 255, 255, 0.8);" class="card card_trans p-2">
                                        <h5 class="card-title">Free</h5>
                                        @if (count($free_category) == 0)
                                            <p>There is no packages</p>
                                        @else
                                            @foreach ($free_data as $single)
                                                <table>
                                                    <tr>
                                                        <td>Package Name</td>
                                                        <td>{{ $single->package_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Package Price</td>
                                                        <td>Rs. {{ $single->package_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Amount</td>
                                                        <td>{{ $single->package_ad_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Top Ads</td>
                                                        <td>{{ $single->topup_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Duration</td>
                                                        <td>{{ $single->package_duration }} days</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Image Count</td>
                                                        <td>{{ $single->image_count }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><a class="btn btn-sucess"
                                                                href="{{ route('web.dashboard.activatePackage', ['id' => $single->id]) }}">Activate</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card-body hover_green_color">
                                    <div style="background-color: rgba(255, 255, 255, 0.8);" class="card card_trans p-2">
                                        <h5 class="card-title">Silver</h5>
                                        @if (count($silver_category) == 0)
                                            <p>There is no packages</p>
                                        @else
                                            @foreach ($silver_data as $single)
                                                <table>
                                                    <tr>
                                                        <td>Package Name</td>
                                                        <td>{{ $single->package_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Package Price</td>
                                                        <td>Rs. {{ $single->package_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Amount</td>
                                                        <td>{{ $single->package_ad_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Top Ads</td>
                                                        <td>{{ $single->topup_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Duration</td>
                                                        <td>{{ $single->package_duration }} days</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Image Count</td>
                                                        <td>{{ $single->image_count }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><a class="btn btn-sucess"
                                                                onclick="payedActivatePackage({{ $single->id }})">Buy
                                                                Now</a></td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card-body hover_green_color">
                                    <div style="background-color: rgba(255, 255, 255, 0.8);" class="card card_trans p-2">
                                        <h5 class="card-title">Gold</h5>
                                        @if (count($gold_category) == 0)
                                            <p>There is no packages</p>
                                        @else
                                            @foreach ($gold_data as $single)
                                                <table>
                                                    <tr>
                                                        <td>Package Name</td>
                                                        <td>{{ $single->package_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Package Price</td>
                                                        <td>Rs. {{ $single->package_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Amount</td>
                                                        <td>{{ $single->package_ad_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Top Ads</td>
                                                        <td>{{ $single->topup_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Duration</td>
                                                        <td>{{ $single->package_duration }} days</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Image Count</td>
                                                        <td>{{ $single->image_count }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><a class="btn btn-sucess"
                                                            onclick="payedActivatePackage({{ $single->id }})">Buy
                                                                Now</a></td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card-body hover_green_color">
                                    <div style="background-color: rgba(255, 255, 255, 0.8);" class="card card_trans p-2">
                                        <h5 class="card-title">Platinum</h5>
                                        @if (count($platinum_category) == 0)
                                            <p>There is no packages</p>
                                        @else
                                            @foreach ($platinum_data as $single)
                                                <table>
                                                    <tr>
                                                        <td>Package Name</td>
                                                        <td>{{ $single->package_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Package Price</td>
                                                        <td>Rs. {{ $single->package_price }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Amount</td>
                                                        <td>{{ $single->package_ad_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Top Ads</td>
                                                        <td>{{ $single->topup_count }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ads Duration</td>
                                                        <td>{{ $single->package_duration }} days</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Image Count</td>
                                                        <td>{{ $single->image_count }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><a class="btn btn-sucess"
                                                            onclick="payedActivatePackage({{ $single->id }})">Buy
                                                                Now</a></td>
                                                    </tr>
                                                </table>
                                            @endforeach
                                        @endif


                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script>
        function payedActivatePackage(id){
         //need to create ajax

         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); //ajax setup
        
         $.ajax({
            url: '{{ url('Web/Vendor/ActivatePackage') }}/' + id,

                method: 'GET',
                success: function(data) {
 
                var decodedData = JSON.parse(data)    

                    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:"  + error);
    };

    // Put the payment variables here
    var payment = {
        "sandbox": true,
        "merchant_id": "1224415",    // Replace your Merchant ID
        "return_url": 'http://127.0.0.1:8000/Web/dashBoard/garage',     // Important
        "cancel_url": 'http://127.0.0.1:8000/Web/dashBoard/garage',     // Important
        "notify_url": "http://sample.com/notify",
        "order_id": decodedData['order_id'],
        "items": decodedData['items'],
        "amount": decodedData['amount'],
        "currency": decodedData['currency'],
        "hash":  decodedData['hash'], // *Replace with generated hash retrieved from backend
        "first_name": decodedData['first_name'],
        "last_name": decodedData['last_name'],
        "email": decodedData['email'],
        "phone": decodedData['phone'],
        "address": decodedData['address'],
        "city": decodedData['city'],
        "country": decodedData['country'],
        "delivery_address": decodedData['delivery_address'],
        "delivery_city": decodedData['delivery_city'],
        "delivery_country": decodedData['delivery_country'],
        // "custom_1": "",
        // "custom_2": ""
  
    };

    payhere.startPayment(payment);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    </script>
@endsection
