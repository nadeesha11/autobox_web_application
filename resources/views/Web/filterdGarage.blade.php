@extends('Web.Layout.Layout')
@section('content')
    <main class="main pages mb-80">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="#">Garage Filterd List</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50">
            <div class="container">
                <div class="archive-header-2 text-center">
                    <h1 class="display-2 mb-50">Garage List ({{ $city }})</h1>

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
                                        <h4 class="mb-5"><a href="#">{{ $item->name }}</a></h4>

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
                                                <li> <i class="fa-solid fa-city" style="color: #5edba1;"></i> <strong>City
                                                        :</strong><span>{{ $item->city }}</span></li>
                                            </ul>
                                            <a href="{{ route('web.garage.detailed', ['id' => $item->id]) }}"
                                                class="btn btn-xs m-2">Visit
                                                Garage <i class="fi-rs-arrow-small-right"></i></a>
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
