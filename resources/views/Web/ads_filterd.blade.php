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
                    <span></span> Ads
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
                                                    @if ($item->is_top_id == 1)
                                                        <i style="position: absolute; top: 10px; right: 10px; font-size: 20px; color: #ff0000;"
                                                            class="fa-solid fa-medal"></i>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>

                                        <div style="  @if ($item->is_top_id == 1) border:#37B093 2px solid !important; @endif  background-color:#00A791 !important;"
                                            class="product-info ">
                                            <p style="color: #fff !important;" class="category">{{ $item->vt_name }}</p>
                                            <p style="color: #fff !important;" class="category">Ad number :
                                                {{ $item->ad_number }}</p>
                                            <h5 style="color: #fff !important;" class="title">{{ $item->ad_title }}</h5>
                                            <hr
                                                style="margin: 0 auto; color: #d9e0d9 !important; width: 100% !important; height: 4px !important;">
                                            <h3 style="color: #fff !important;" class="price">Rs.
                                                {{ number_format($item->ad_price, 2, '.', '') }}
                                            </h3>
                                            <p style="color: #fff !important;" style="margin-top: 3px !important;"
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

                    @if (session()->has('check_request_for_filter'))
                        <div class="sidebar-widget widget-category-2 mb-50">
                            <h5 class="section-title style-1 mb-30">Category</h5>
                            <ul>
                                @foreach ($category as $vehicleType)
                                    @if ($vehicleType->id == $id)
                                        <li>
                                            <a href="{{ route('web.allads.vehicleType', ['id' => $vehicleType->id]) }}">
                                                <img src="{{ asset('assets/myCustomThings/new_vehicle_image/' . $vehicleType->vt_icon) }}"
                                                    alt="" />
                                                {{ $vehicleType->vt_name }}
                                            </a>
                                        </li>
                                        <ul>
                                            @foreach ($vehicleType->getBrands as $brand)
                                                @if ($brand->id == $viewBrand)
                                                    <li
                                                        style="line-height:0px !important; border:none !important; margin:0px !important; padding:0 px !important; text-decoration: underline !important; color:#0056b3 !important;">
                                                        <a
                                                            href="{{ route('web.allads.vehicleBrand', ['id' => $id, 'brandId' => $brand->id]) }}">{{ $brand->brand_name }}</a>
                                                    </li>
                                                    @foreach ($brand->getModel as $model)
                                                        @if ($model->id == $viewModel)
                                                            <li
                                                                style="padding-left: 20% !important; border:none !important; line-height:0  !important; margin:0 !important;  text-decoration: underline !important; color:#0056b3 !important;">
                                                                <a style="line-height: 0.3 !important;"
                                                                    href="{{ route('web.allads.vehicleModel', ['id' => $id, 'brandId' => $brand->id, 'modelId' => $model->id]) }}">
                                                                    {{ $model->model_name }} </a>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                        </ul>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                        <div class="sidebar-widget price_range range mb-30">
                            <h5 class="section-title style-1 mb-30">Fill by Title</h5>
                            <div style="margin-bottom: 4px !important;" class="price-filter">
                                <div class="price-filter-inner">
                                    <div>
                                        <input name="title" value="{{ session('keep_old_filter_values.title') }}"
                                            id="price-range-from" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="post" action="{{ route('web.filterd_ads.advanced') }}">
                        @csrf

                        <div class="sidebar-widget price_range range mb-30">
                            <h5 class="section-title style-1 mb-30">Fill by price</h5>
                            <div style="margin-bottom: 4px !important;" class="price-filter">
                                <div class="price-filter-inner">
                                    <div>
                                        <div class="caption">From:</div>
                                        <input type="number" name="from"
                                            value="{{ session('keep_old_filter_values.from') }}" id="price-range-from"
                                            class="form-control">
                                        <span style="color: rgb(253, 0, 0)">
                                            @error('from')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                        <div class="caption">To:</div>

                                        <input type="number" name="to"
                                            value="{{ session('keep_old_filter_values.to') }}" id="price-range-to"
                                            class="form-control">
                                        <span style="color: rgb(255, 0, 0)">
                                            @error('to')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input value="{{ session('filter_data')['district'] ?? null }}" name="district" type="hidden">
                        <input value="{{ session('filter_data')['type'] }}" name="type" type="hidden">
                        <input value="{{ session('filter_data')['brand'] }}" name="brand" type="hidden">
                        <input value="{{ session('filter_data')['model'] }}" name="model" type="hidden">

                        <div class="sidebar-widget price_range range mb-30">
                            <h5 class="section-title style-1 mb-30">Fill by usage</h5>
                            <div class="list-group">
                                <div class="list-group-item mb-10 mt-10">
                                    <label class="fw-900 mt-15">Item Condition</label>
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="condition_new"
                                            {{ session('keep_old_filter_values.condition_new') ? 'checked' : '' }}
                                            id="exampleCheckbox11" value="New" />
                                        <label class="form-check-label" for="exampleCheckbox11"><span>New </span></label>
                                        <br />
                                        <input class="form-check-input" type="checkbox" name="condition_reconditioned"
                                            {{ session('keep_old_filter_values.condition_reconditioned') ? 'checked' : '' }}
                                            id="exampleCheckbox21" value="Reconditioned" />
                                        <label class="form-check-label" for="exampleCheckbox21"><span>Reconditioned
                                            </span></label>
                                        <br />
                                        <input class="form-check-input" type="checkbox" name="condition_used"
                                            {{ session('keep_old_filter_values.condition_used') ? 'checked' : '' }}
                                            id="exampleCheckbox31" value="Used" />
                                        <label class="form-check-label" for="exampleCheckbox31"><span>Used </span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-sm btn-default"><i
                                        class="fi-rs-filter mr-5"></i>Filter</button>

                                @if (session()->has('keep_old_filter_values'))
                                    <a href="{{ route('web.main.removefilter') }}"
                                        style="background-color: rgb(168, 36, 36) !important;" type="button"
                                        class="btn btn-sm btn-outline-danger" id="removeFilterBtn"><i
                                            class="fi-rs-close"></i> Clear</a>
                                @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
