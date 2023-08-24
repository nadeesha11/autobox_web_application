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

        div:where(.swal2-container) button:where(.swal2-styled).swal2-confirm {
            background-color: #000000;
        }
    </style>

    <!-- start filter  -->
    <main class="main">
        <div class="page-header breadcrumb-wrap  mb-10">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="#"> inquery ads</a>
                </div>
            </div>
        </div>
        <div class="container mb-30">
            <div class="row flex-row-reverse">

                <div class="col-lg-4-5">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            <p>We found <strong class="text-brand"> {{ $inquery_ads_count }}</strong> items for you!</p>
                        </div>

                    </div>
                    <div data-item="8" data-item-show="4" class="row product-grid">
                        @if ($inquery_ads->isEmpty())
                            <p>No ads found.</p>
                        @else
                            @foreach ($inquery_ads as $item)
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div style="margin: 13px;" class="product-card"
                                        style="border: 1px solid #37B093; margin-bottom: 0 !important; border-radius: 8px;">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="#"
                                                    style="position: relative; display: inline-block; width: 100%;">
                                                    <img style="height: 400px; width: 100%; object-fit: cover !important;"
                                                        src="{{ asset('assets/myCustomThings/inquery/' . $item->image) }}"
                                                        alt="{{ $item->title }}" />
                                                </a>
                                            </div>
                                        </div>

                                        <div class="product-info" style="background-color: #00A791 !important;">
                                            <i class="fa fa-info-circle"
                                                onclick="displayDetails({{ json_encode($item->additional_information) }})"
                                                style="color: #FFD700; font-size: 30px; text-align: right !important;"
                                                aria-hidden="true"></i>

                                            <p style="color: white !important; ">
                                                Phone: +94 {{ $item->phone }}
                                            </p>
                                            <div style=" margin-top: 4px !important;">
                                                <hr
                                                    style="margin: 0 auto; color: #d9e0d9 !important; width: 100% !important; height: 4px !important;">
                                            </div>
                                            <p style="color: #fff !important; ">
                                                {{ $item->created_at }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <!--product grid-->
                    {!! $inquery_ads->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </main>

    <script>
        function displayDetails(details) {
            Swal.fire({
                icon: 'info',
                title: 'Details',
                html: `${details}`,
                confirmButtonText: 'Close',
                width: '50%' // You can adjust the value to your desired width
            });

        }
    </script>
@endsection
