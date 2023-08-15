@extends('Web.Layout.Layout')
@section('content')
    <div style="margin-bottom: 10px !important;" class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Dashboard <span></span> My ads
            </div>
        </div>
    </div>

    <div class="container mb-30">
        <div style="margin-top: 10px !important;" class="row">

            @if (session('delete_success'))
                <div class="alert alert-success">
                    {{ session('delete_success') }}
                </div>
            @elseif(session('delete_error'))
                <div class="alert alert-danger">
                    {{ session('delete_error') }}
                </div>
            @endif

            <div class="col-lg-6">
                <div style="padding: 10px !important; background-color:rgb(236, 247, 243) !important;"
                    class="product-list mb-50">
                    <div style="padding: 10px !important;" class="shop-product-fillter">
                        <div class="totall-product">
                            <p>There are <strong class="text-brand">{{ count($my_ads) }}
                                </strong>active ads !</p>
                        </div>
                    </div>
                    @foreach ($my_ads as $ad)
                        <div style="background-color: rgb(247, 244, 244) !important; padding:10px !important; border-radius:5px !important; border:green 1px solid !important;"
                            class="product-cart-wrap">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <div class="product-img-inner">
                                        <a href="shop-product-right.html">
                                            <img style="height: 150px !important; width:150px !important;"
                                                class="default-img"
                                                src="{{ asset('assets/myCustomThings/vehicleTypes/' . $ad->name) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a style="color: rgb(0, 0, 0) !important;" href="shop-grid-right.html">
                                        {{ $ad->vt_name }}</p></a>
                                </div>
                                <h2>
                                    <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html">
                                        {{ $ad->ad_title }}
                                    </p>
                                </h2>
                                <div class="product-price">
                                    <span style="color: rgb(0, 0, 0) !important;">Rs
                                        {{ number_format($ad->ad_price, 2, '.', '') }} </span>
                                </div>
                                <div class="mt-30 d-flex align-items-center">
                                    <a style="padding: 5px !important;" aria-label="Buy now" class="btn m-1"
                                        href="{{ route('web.dashboard.ad.edit', ['id' => $ad->id]) }}"><i
                                            class="fi-rs-shopping-cart mr-5"></i>Update</a>
                                    <a style="padding: 5px !important; background-color:brown !important;"
                                        aria-label="Buy now" class="btn m-1" onclick="deleteAd({{ $ad->id }})"><i
                                            class="fi-rs-shopping-cart mr-5"></i>Delete</a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2>
                                    @if ($ad->is_top_id === 1)
                                        <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html"> <span
                                                style=" background-color: rgb(202, 29, 29) !important; border-radius: 5px !important; padding:5px !important;"><i
                                                    class="fa-solid fa-anchor m-1"></i> Top
                                                ad</span>
                                        </p>
                                    @endif
                                </h2>
                                <h2>
                                    <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html"><span>Ad
                                            expire date : {{ $ad->ad_expire_date }}
                                        </span>
                                    </p>
                                </h2>
                                <h2>
                                    @if ($ad->is_top_id === 1)
                                        <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html"><span>Top
                                                Ad
                                                expire date : {{ $ad->top_ad_expire_date }}
                                            </span>
                                        </p>
                                    @endif
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-6">
                <div style="padding: 10px !important; background-color:rgb(236, 247, 243) !important;"
                    class="product-list mb-50">
                    <div style="padding: 10px !important;" class="shop-product-fillter">
                        <div class="totall-product">
                            <p>There are <strong class="text-brand">{{ count($my_deactivate_ads) }}
                                </strong>deactive ads !</p>
                        </div>
                    </div>
                    @foreach ($my_deactivate_ads as $ad)
                        <div style="background-color: rgb(247, 244, 244) !important; padding:10px !important; border-radius:5px !important; border:green 1px solid !important;"
                            class="product-cart-wrap">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <div class="product-img-inner">
                                        <a href="shop-product-right.html">
                                            <img style="height: 150px !important; width:150px !important;"
                                                class="default-img"
                                                src="{{ asset('assets/myCustomThings/vehicleTypes/' . $ad->name) }}"
                                                alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a style="color: rgb(0, 0, 0) !important;" href="shop-grid-right.html">
                                        {{ $ad->vt_name }}</p></a>
                                </div>
                                <h2>
                                    <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html">
                                        {{ $ad->ad_title }}
                                    </p>
                                </h2>
                                <div class="product-price">
                                    <span style="color: rgb(0, 0, 0) !important;">Rs {{ $ad->ad_price }} </span>
                                </div>
                                <div class="mt-30 d-flex align-items-center">
                                    @if ($ad->adminStatus === 1)
                                        <a style="padding: 5px !important;" aria-label="Buy now" class="btn"
                                            href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Republish</a>
                                    @else
                                        <p style="color: red !important;">This add deactivated by cassans.lk</p>
                                    @endif

                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2>
                                    @if ($ad->is_top_id === 1)
                                        <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html"> <span
                                                style=" background-color: rgb(202, 29, 29) !important; border-radius: 5px !important; padding:5px !important;"><i
                                                    class="fa-solid fa-anchor m-1"></i> Top
                                                ad</span>
                                        </p>
                                    @endif

                                </h2>
                                <h2>
                                    <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html"><span>Ad
                                            expire date : {{ $ad->ad_expire_date }}
                                        </span>
                                    </p>
                                </h2>
                                <h2>
                                    @if ($ad->is_top_id === 1)
                                        <p style="color: rgb(0, 0, 0) !important;" href="shop-product-right.html"><span>Top
                                                Ad
                                                expire date : {{ $ad->top_ad_expire_date }}
                                            </span>
                                        </p>
                                    @endif
                                </h2>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
    </main>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //ajax setup

        function deleteAd(id) {
            // Show a confirmation dialog using SweetAlert
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, proceed with deletion
                    let url = '{{ url('web/vendorAds/delete') }}' + '/' + id;
                    location.href = url;
                }
            });
        }
    </script>
@endsection
