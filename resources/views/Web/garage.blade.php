@extends('Web.Layout.Layout')
@section('content')
    <main class="main pages mb-80">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Garage List
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="archive-header-2 text-center">
                    <h1 class="display-2 mb-50">Garage List</h1>
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="sidebar-widget-2 widget_search mb-50">
                                <div class="search-form">
                                    <form action="#">
                                        <input type="text" placeholder="Search garage " />
                                        <button type="submit"><i class="fi-rs-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-50">
                    <div class="col-12 col-lg-8 mx-auto">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p>We have <strong class="text-brand">{{ $totalCount }}</strong> Garages</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-item="8" data-item-show="4" class="row vendor-grid">

                    @foreach ($data as $item)
                        <div class="col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="vendor-wrap style-2 mb-40">

                                <div class="vendor-img-action-wrap">
                                    <div class="vendor-img">
                                        <a href="#">
                                            <img class="default-img" style="object-fit: cover !important;"
                                                src="{{ asset('assets/myCustomThings/Garage/' . $item->image) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                </div>
                                <div class="vendor-content-wrap">
                                    <div class="mb-30">
                                        <div class="product-category">
                                        </div>
                                        <h4 class="mb-5"><a href="#">Nature Food</a></h4>

                                        <div class="vendor-info d-flex justify-content-between align-items-end mt-30">
                                            <ul class="contact-infor text-muted">
                                                <li><img src="assets/imgs/theme/icons/icon-location.svg"
                                                        alt="" /><strong>Address: </strong>
                                                    <span> <a target="_blank" href="{{ $item->url }}">
                                                            {{ $item->address }} </a> </span>
                                                </li>
                                                <li><img src="assets/imgs/theme/icons/icon-contact.svg"
                                                        alt="" /><strong>Call
                                                        Us:</strong><span>{{ '+94' . $item->number }}</span></li>
                                            </ul>
                                            <a href="vendor-details-1.html" class="btn btn-xs m-1">Visit
                                                Store <i class="fi-rs-arrow-small-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}

                </div>

            </div>
        </div>
    </main>
@endsection
