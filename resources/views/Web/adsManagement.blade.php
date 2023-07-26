@extends('Web.Layout.Layout')
@section('content')
    <style>
        .content-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.8);
            /* Add a background color to the content container if needed */
            padding: 20px;
        }
    </style>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Dashboard <span></span> Buy Ads
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
                                <div class="card m-2">
                                    <div style=" background-color: rgb(196, 185, 42);
                                    "
                                        class="card-body">

                                        <div style="background-color: rgba(255, 255, 255, 0.8);"
                                            class="card card_trans p-2">
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
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card m-2">

                                    <div style="  background-color: rgb(20, 10, 7);
                                    "
                                        class="card-body">
                                        <div style="background-color: rgba(255, 255, 255, 0.8);"
                                            class="card card_trans p-2">
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
                                                                    href="{{ route('web.dashboard.activatePackage', ['id' => $single->id]) }}">Buy
                                                                    Now</a></td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card m-2">

                                    <div style="  background-color: rgb(179, 48, 0);
                                    "
                                        class="card-body">
                                        <div style="background-color: rgba(255, 255, 255, 0.8);"
                                            class="card card_trans p-2">
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
                                                                    href="{{ route('web.dashboard.activatePackage', ['id' => $single->id]) }}">Buy
                                                                    Now</a></td>
                                                        </tr>
                                                    </table>
                                                @endforeach
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="card m-2">

                                    <div style="   background-color: rgb(56, 15, 0);
                                   "
                                        class="card-body">
                                        <div style="background-color: rgba(255, 255, 255, 0.8);"
                                            class="card card_trans p-2">
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
                                                                    href="{{ route('web.dashboard.activatePackage', ['id' => $single->id]) }}">Buy
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
        </div>
    </main>
@endsection
