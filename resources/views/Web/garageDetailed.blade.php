@extends('Web.Layout.Layout')
@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="{{ route('web.garage.findMyGarage') }}">garage</a> <span></span> <a
                        href="#">garage detailed</a>
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

                                        <figure class="border-radius-10">
                                            <img style="object-fit: fill !important; height:500px !important; width:100% !important;"
                                                class="slider-image"
                                                src="{{ asset('assets/myCustomThings/Garage/' . $data->image) }}"
                                                alt="product image" />
                                        </figure>

                                    </div>


                                </div>
                                <!-- End Gallery -->
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <div class="detail-info pr-30 pl-30">

                                    <h2 class="title-detail">{{ $data->name }}</h2>

                                    <div class="clearfix product-price-cover">
                                        <div class="short-desc mb-30">

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12  col-md-6 col-lg-6">
                                                <div class="font-xs">
                                                    <ul class="mr-50 float-start">
                                                        <li class="mb-5">City: <span
                                                                class="text-brand">{{ $data->city }}</span>
                                                        </li>
                                                        <li class="mb-5">Number: <span
                                                                class="text-brand">{{ '+94' . $data->number }}</span>
                                                        </li>
                                                        <li class="mb-5">Address: <span class="text-brand"><a
                                                                    target="_blank"
                                                                    href="{{ $data->url }}">{{ $data->address }}</a>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
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
                                                {{ $data->desc }}
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
