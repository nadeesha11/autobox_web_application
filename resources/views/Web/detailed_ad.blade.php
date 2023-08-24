@extends('Web.Layout.Layout')
@section('content')
    <style>
        .dealer-container {
            display: flex;
            align-items: center;
            /* Vertically align items */
        }

        .dealer-image {
            height: 55px;
            width: 55px;
            object-fit: cover;
            margin: 5px;
        }

        .company-name {
            margin-left: 10px;
            /* Add space between image and Company Name */
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="#">ad detailed</a>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row">
                <div class="col-xl-10 col-lg-12 m-auto">
                    <div class="product-detail accordion-detail">
                        <div class="row mb-50 mt-30">
                            <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                                <div class="detail-gallery">
                                    <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                    <!-- MAIN SLIDES -->
                                    <div class="product-image-slider">
                                        @foreach ($detailed_ads as $item)
                                            <figure class="border-radius-10">
                                                <img style="object-fit: cover !important; height:500px !important; width:100% !important;"
                                                    class="slider-image"
                                                    src="{{ asset('assets/myCustomThings/vehicleTypes/' . $item->name) }}"
                                                    alt="product image" />
                                            </figure>
                                        @endforeach
                                    </div>

                                    <!-- THUMBNAILS -->
                                    <div class="slider-nav-thumbnails">
                                        @foreach ($detailed_ads as $item)
                                            <div><img
                                                    style="object-fit: cover !important; height:100px !important; width:100% !important;"
                                                    src="{{ asset('assets/myCustomThings/vehicleTypes/' . $item->name) }}"
                                                    alt="product image" /></div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">

                                    <h2 class="title-detail">{{ $detailed_ads[0]->ad_title }}</h2>

                                    <div class="clearfix product-price-cover">
                                        <div class="product-price primary-color float-left">
                                            <span class="current-price text-brand">RS.
                                                {{ number_format($detailed_ads[0]->ad_price, 2, '.', '') }}
                                            </span>

                                        </div>
                                    </div>
                                    <div class="short-desc mb-30">

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12  col-md-6 col-lg-6">
                                            <div class="font-xs">
                                                <ul class="mr-50 float-start">
                                                    <li class="mb-5">Type: <span
                                                            class="text-brand">{{ $detailed_ads[0]->vt_name }}</span></li>
                                                    <li class="mb-5">Manufacturer:<span class="text-brand">
                                                            {{ $detailed_ads[0]->brand_name }}</span></li>
                                                    <li class="mb-5">Model: <span
                                                            class="text-brand">{{ $detailed_ads[0]->model_name }}</span>
                                                    </li>

                                                    <li class="mb-5">District: <span
                                                            class="text-brand">{{ $detailed_ads[0]->district }}</span>
                                                    </li>
                                                    <li style="margin-bottom: 20px !important;">City: <span
                                                            class="text-brand">{{ $detailed_ads[0]->city }}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12  col-md-6 col-lg-6">
                                            <div class="font-xs">
                                                <ul class="mr-50 float-start">
                                                    <li class="mb-5">Seller: <span
                                                            class="text-brand">{{ $detailed_ads[0]->First_Name }}
                                                            {{ $detailed_ads[0]->Last_Name }} </span></li>
                                                    <li class="mb-5">Email:<span class="text-brand">
                                                            {{ $detailed_ads[0]->email }}</span></li>
                                                    <li class="mb-5">Phone: <span
                                                            class="text-brand">{{ '+94' . $detailed_ads[0]->phone }}</span>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12  col-md-6 col-lg-6">
                                            <div style="margin-top: 30px !important;" class="font-xs">
                                                <ul class="mr-50 float-start" style="list-style: none; display: flex;">
                                                    <li class="mb-5" style="margin-right: 5px;"><a
                                                            href="{{ $detailed_ads[0]->Fb_link }}"><img
                                                                style="width: 30px !important; height: 30px !important;"
                                                                src="https://img.icons8.com/color/48/facebook-new.png"
                                                                alt="facebook-new" /></a></li>
                                                    <li class="mb-5" style="margin-right: 5px;"><a
                                                            href="{{ $detailed_ads[0]->Twitter_link }}"><img
                                                                style="width: 30px !important; height: 30px !important;"
                                                                src="https://img.icons8.com/fluency/48/twitter.png"
                                                                alt="twitter" /></a></li>
                                                    <li class="mb-5" style="margin-right: 5px;"><a
                                                            href="{{ $detailed_ads[0]->Linkedin_link }}"><img
                                                                style="width: 30px !important; height: 30px !important;"
                                                                src="https://img.icons8.com/sf-black-filled/64/linkedin.png"
                                                                alt="linkedin" /></a></li>
                                                    <li class="mb-5" style="margin-right: 5px;"><a
                                                            href="{{ $detailed_ads[0]->Youtube_link }}"><img
                                                                style="width: 30px !important; height: 30px !important;"
                                                                src="https://img.icons8.com/color/48/youtube-play.png"
                                                                alt="youtube-play" /></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if ($check_member_->isEmpty())
                                        @else
                                            <div class="col-sm-12  col-md-6 col-lg-6">
                                                <div style="margin-top: 30px !important;" class="font-xs card">
                                                    <div class="dealer-container">
                                                        <img style="border-radius: 4px !important;" class="dealer-image"
                                                            src="{{ asset('assets/myCustomThings/dealer/' . $member_details->company_logo) }}"
                                                            alt="">
                                                        <h6 class="company-name">{{ $member_details->Company_Name }}</h6>
                                                    </div>
                                                    <p class="company-name"><span style="color: black !important;">Member
                                                            Since</span>:
                                                        {{ \Carbon\Carbon::parse($member_details->created_at)->format('Y-m-d') }}
                                                    </p>
                                                </div>
                                                <div style="margin-top: 10px !important;" class="font-xs card">
                                                    <p class="company-name"><span style="color: black !important;">
                                                            Address:
                                                        </span>
                                                        {{ $member_details->address }}
                                                    </p>
                                                </div>
                                                <div style="margin-top: 10px !important; padding:10px !important;"
                                                    class="font-xs card">
                                                    <a target="_blank"
                                                        href="route('{{ $member_details->google_location }}')">
                                                        Google Location</a>
                                                </div>
                                                <div style="margin-top: 10px !important; padding:10px !important;"
                                                    class="font-xs card">
                                                    <a target="_blank"
                                                        href="{{ route('web.memberShop', ['id' => $member_details->user_id]) }}">
                                                        Visit Shop</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Detail Info -->
                            </div>
                        </div>
                        <div class="product-info">
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Description</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            {!! $detailed_ads[0]->ad_description !!}
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Vendor-info">
                                    </div>
                                    <div class="tab-pane fade" id="Reviews">
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if ($check_member_->isEmpty())
                        @else
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h2 class="section-title style-1 mb-30">
                                        More ads from {{ $member_details->Company_Name }}
                                    </h2>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @foreach ($more_ads as $item)
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap hover-up">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            <a href="{{ route('web.detailed_ad', ['id' => $item->id]) }}"
                                                                tabindex="0">
                                                                <img class="default-img"
                                                                    style="height: 300px; width: 100%; object-fit: cover !important;"
                                                                    src="{{ asset('assets/myCustomThings/vehicleTypes/' . $item->name) }}" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="product-info "
                                                        style=" background-color:#00A791 !important;">
                                                        <p style="color: white !important;" class="category">
                                                            {{ $item->vt_name }}</p>
                                                        <p style="color: white !important;" class="category">Ad number :
                                                            {{ $item->ad_number }}</p>
                                                        <h5 style="color: white !important;" class="title">
                                                            {{ $item->ad_title }}</h5>
                                                        <div
                                                            style="text-align: center !important; margin-top:4px !important;">
                                                            <hr
                                                                style="margin: 0 auto; color: #d9e0d9 !important; width: 100% !important; height: 4px !important;">
                                                        </div>
                                                        <h3 style="color: white !important;" class="price">Rs.
                                                            {{ number_format($item->ad_price, 2, '.', '') }}
                                                        </h3>
                                                        <p style="color: white !important;"
                                                            style="margin-top: 3px !important;" class="price"><i
                                                                style="font-size:20px; margin:10px;"
                                                                class="fa">&#xf041;</i>
                                                            {{ $item->ad_district }} {{ $item->ad_city }} </p>
                                                        <p style="color: #fff !important;" class="category">
                                                            {{ $item->created_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
