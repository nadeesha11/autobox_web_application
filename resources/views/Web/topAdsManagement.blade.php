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
                    <span></span> Dashboard <span></span> Buy Top Ads
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>Buy Top Ads Packages</h5>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            @foreach ($data as $single)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="card m-2 hover_green_color">

                                        <div style="background-color: rgba(255, 255, 255, 0.8);"
                                            class="card card_trans p-2">
                                            <table>
                                                <tr>
                                                    <td>Package Name</td>
                                                    <td>{{ $single->package_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Package Price</td>
                                                    <td>{{ $single->package_price }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Top Ads</td>
                                                    <td>{{ $single->count }}</td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td><a class="btn btn-sucess" href="">Buy</a></td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
