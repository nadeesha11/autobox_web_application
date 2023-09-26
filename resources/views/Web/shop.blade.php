@extends('Web.Layout.Layout')
@section('content')
    <style>
        .total-product {
            background-color: #f2f2f2 !important;
            border-radius: 5px !important;
            padding: 10px !important;
            display: !important;
            align-items: center !important;
        }

        .filter-input {
            flex: 1 !important;
            padding: 8px !important;
            font-size: 16px !important;
            border: none !important;
            border-radius: 3px !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            margin-right: 10px !important;
        }

        .filter-button {
            padding: 8px 16px !important;
            font-size: 16px !important;
            border: none !important;
            border-radius: 3px !important;
            color: #fff !important;
            cursor: pointer !important;
            margin-top: 5px !important;
        }

        .filter-button:hover {
            background-color: #0056b3;
        }

        .product-cart-wrap .product-img-action-wrap {
            background-color: #d9e0d9 !important;
        }

        .product-cart-wrap .product-img-action-wrap {
            padding: 4px !important;
        }

        .product-info {
            background-color: rgba(255, 255, 255, 0.5) !important;
            /* Adjust the opacity value (0 to 1) to make it more or less transparent */
            border-radius: 10px !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            padding: 20 !important;
            border-radius: 0 !important;
        }

        .product-info p.category {
            font-size: 14px !important;
            color: #333 !important;
        }

        .product-info h5.title {
            font-size: 20px !important;
            color: #333 !important;
            margin-top: 10px !important;
        }

        .product-info h3.price {
            font-size: 24px !important;
            color: #333 !important;
            margin-top: 10px !important;
            font-weight: bold !important;
        }
    </style>

    <!-- start filter  -->
    <main class="main">
        <div class="page-header breadcrumb-wrap  mb-10">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span><a href="">Shop</a>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row flex-row-reverse">

                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We found <strong class="text-brand"> {{ $totalCount }}</strong> items for you!</p>
                        </div>

                    </div>
                    <div data-item="8" data-item-show="4" class="row product-grid">
                        @if ($filterd_ads->isEmpty())
                            <p>No ads found.</p>
                        @else
                            @foreach ($filterd_ads as $item)
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div style="margin: 13px;" class="product-card"
                                        style="border: 1px solid #37B093; margin-bottom: 0 !important; border-radius: 8px;">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('web.detailed_ad', ['id' => $item->id]) }}"
                                                    style="position: relative; display: inline-block; width: 100%;">
                                                    <img style="height: 300px; width: 100%; object-fit: cover !important;"
                                                        src="{{ asset('assets/myCustomThings/vehicleTypes/' . $item->name) }}"
                                                        alt="{{ $item->ad_title }}" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="product-info " style=" background-color:#00A791 !important;">
                                            <p style="color: white !important;" class="category">{{ $item->vt_name }}</p>
                                            <p style="color: white !important;" class="category">Ad number :
                                                {{ $item->ad_number }}</p>
                                            <h5 style="color: white !important;" class="title">{{ $item->ad_title }}</h5>
                                            <div style="text-align: center !important; margin-top:4px !important;">
                                                <hr
                                                    style="margin: 0 auto; color: #d9e0d9 !important; width: 100% !important; height: 4px !important;">
                                            </div>
                                            <h3 style="color: white !important;" class="price">Rs.
                                                {{ number_format($item->ad_price, 2, '.', '') }}
                                            </h3>
                                            <p style="color: white !important;" style="margin-top: 3px !important;"
                                                class="price"><i style="font-size:20px; margin:10px;"
                                                    class="fa">&#xf041;</i>
                                                {{ $item->ad_district }} {{ $item->ad_city }} </p>
                                            <p style="color: #fff !important;" class="category">{{ $item->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!--product grid-->
                    {!! $filterd_ads->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
                <div style="margin-top: 5px !important;" class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    <div class="sidebar-widget widget-category-2 mb-50">
                        <div class="col-sm-12  col-md-12 col-lg-12">
                            <div style="margin-top: 30px !important;" class="font-xs card">
                                <div class="dealer-container">
                                    <div class="text-center mt-3 mb-3">
                                        <img style="border-radius: 4px !important; height:150px !important; width:150px !important; "
                                            class="dealer-image"
                                            src="{{ asset('assets/myCustomThings/dealer/' . $member_details->company_logo) }}"
                                            alt="">
                                    </div>

                                    <h6 class="company-name p-2">{{ $member_details->Company_Name }}</h6>
                                </div>
                                <p class="company-name p-2"><span style="color: black !important;">Member
                                        Since</span>:
                                    {{ \Carbon\Carbon::parse($member_details->created_at)->format('Y-m-d') }}
                                </p>
                            </div>
                            <div style="margin-top: 10px !important;" class="font-xs card">
                                <p class="company-name p-2"><span style="color: black !important;">
                                        Address:
                                    </span>
                                    {{ $member_details->address }}
                                </p>
                            </div>
                            <div style="margin-top: 10px !important; padding:10px !important;" class="font-xs card">
                                <a class="m-2" target="_blank" href="route('{{ $member_details->google_location }}')">
                                    Google Location</a>
                            </div>
                        </div>
                        <div class="col-sm-12  col-md-12 col-lg-12 row m-2 ">
                            <div class="col">
                                <a href="{{ $user_data->Fb_link }}"><img
                                        style="width: 30px !important; height: 30px !important;"
                                        src="https://img.icons8.com/color/48/facebook-new.png" alt="facebook-new" /></a>
                            </div>
                            <div class="col">
                                <a href="{{ $user_data->Twitter_link }}"><img
                                        style="width: 30px !important; height: 30px !important;"
                                        src="https://img.icons8.com/fluency/48/twitter.png" alt="twitter" /></a>
                            </div>
                            <div class="col">
                                <a href="{{ $user_data->Youtube_link }}"><img
                                        style="width: 30px !important; height: 30px !important;"
                                        src="https://img.icons8.com/color/48/youtube-play.png" alt="youtube-play" /></a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
