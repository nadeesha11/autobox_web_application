<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/imgs/theme/favicon.svg" />
    <link rel="stylesheet" href="{{ asset('web/assets/css/plugins/slider-range.css') }}" />
    <link rel="stylesheet" href="{{ asset('web/assets/css/main.css?v=5.3') }}" />
    <link rel="stylesheet" href="{{ asset('web/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />

    <!-- Vendor JS-->
    <script src="{{ asset('web/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/slider-range.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('web/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"
        integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <style>
        .footer-list li a {
            color: rgb(223, 213, 213) !important;
        }

        .header-style-1.header-height-2 {
            background-color: #032234 !important;
        }

        .hero-slider-1 .single-hero-slider.rectangle .slider-content {
            left: 35% !important;
        }

        @media (max-width: 992px) {
            .mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-top {
                padding-top: 40px !important;
            }

            .sticky-bar.stick {
                padding-top: 40px !important;
            }
        }
    </style>

    <!-- Quick view -->
    <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('web/assets/imgs/shop/product-16-2.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('web/assets/imgs/shop/product-16-1.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('web/assets/imgs/shop/product-16-3.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('web/assets/imgs/shop/product-16-4.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('web/assets/imgs/shop/product-16-5.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('web/assets/imgs/shop/product-16-6.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('web/assets/imgs/shop/product-16-7.jpg') }}"
                                            alt="product image" />
                                    </figure>
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <div><img src="{{ asset('web/assets/imgs/shop/thumbnail-3.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('web/assets/imgs/shop/thumbnail-4.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('web/assets/imgs/shop/thumbnail-5.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('web/assets/imgs/shop/thumbnail-6.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('web/assets/imgs/shop/thumbnail-7.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('web/assets/imgs/shop/thumbnail-8.jpg') }}"
                                            alt="product image" /></div>
                                    <div><img src="{{ asset('web/assets/imgs/shop/thumbnail-9.jpg') }}"
                                            alt="product image" /></div>
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span class="stock-status out-stock"> Sale Off </span>
                                <h3 class="title-detail"><a href="shop-product-right.html" class="text-heading">Seeds
                                        of
                                        Change Organic Quinoa, Brown</a></h3>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">$38</span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">26% Off</span>
                                            <span class="old-price font-md ml-15">$52</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" class="qty-val" value="1"
                                            min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart"><i
                                                class="fi-rs-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                                <div class="font-xs">
                                    <ul>
                                        <li class="mb-5">Vendor: <span class="text-brand">Nest</span></li>
                                        <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2022</span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header-area header-style-1 header-style-5 header-height-2">
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="index.html"><img src="{{ asset('assets/imgs/theme/logo-color.png') }}"
                                alt="logo" /></a>
                    </div>
                    <div class="header-right">
                        <div style=" text-align: center !important;" class="search-style-2">

                            <nav>
                                <a style="font-size: 23px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(255, 255, 255) !important; "
                                    href="{{ route('web.home') }}">HOME</a>
                                <a style="font-size: 23px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(255, 255, 255) !important; "
                                    href="about.html">ABOUT</a>
                                <a style="font-size: 23px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(255, 255, 255) !important; "
                                    href="{{ route('web.allads.view') }}">ALL ADS</a>

                                <a style="font-size: 23px ;  font-style: bold; margin-left:4%; font-weight:900 !important; color:rgb(255, 255, 255) !important; "
                                    href="careers.html">CONTACT</a>
                            </nav>
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="search-location">
                                </div>
                                <div class="header-action-icon-2">
                                    <a href="{{ route('web.garage.findMyGarage') }}" class="btn"
                                        style=" border-radius: 15px !important; background-color: #032234 !important; border-color: #00A791  !important; color:#00A791 !important; font-size:14px; padding:15px !important;">
                                        <i class="fa-solid fa-car"></i> Find My
                                        Garage</a>
                                </div>
                                <div class="header-action-icon-2">
                                    @if (session('vendor_data'))
                                        @if (session('vendor_data')->phone)
                                            <button
                                                onclick="window.location.href = '{{ route('web.dashboard.create_ad') }}';"
                                                style="background-color: #FFC800 !important; color: #673500; border-radius: 15px !important;"
                                                class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST YOUR
                                                ADD</button>
                                        @else
                                            <button onclick="alert('Please update your account');"
                                                style="background-color: #FFC800 !important; color: #673500 ;  border-radius: 15px !important;"
                                                class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST YOUR
                                                ADD</button>
                                        @endif
                                    @else
                                        <button onclick="window.location.href = '{{ route('web.vendor.login') }}';"
                                            style="background-color: #FFC800 !important; color: #673500;  border-radius: 15px !important;"
                                            class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST YOUR
                                            ADD</button>
                                    @endif
                                </div>

                                <div class="header-action-icon-2">
                                    <a href="page-account.html">
                                        <img class="svgInject" alt="Nest"
                                            src="{{ asset('web/assets/imgs/theme/icons/icon-user.svg') }}" />
                                    </a>
                                    <a><span class="lable ml-0"></span></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                        <ul>
                                            @if (session('vendor_data'))
                                                <li>
                                                    <a href="{{ route('web.dashboardIndex') }}"> <i
                                                            class="fa fa-user-circle mr-10" aria-hidden="true"></i>
                                                        Dashboard</a>
                                                </li>
                                            @else
                                                <li>
                                                    <a href="{{ route('web.vendor.login') }}"><i
                                                            class="fi fi-rs-user mr-10"></i>Login</a>
                                                </li>
                                            @endif
                                            <li>
                                                @if (session('vendor_data'))
                                                    <a href="{{ route('web.vendor.logout') }}"><i
                                                            class="fi fi-rs-sign-out mr-10"></i>Sign
                                                        out</a>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="header-bottom header-bottom-bg-color sticky-bar">

            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <div style="display: inline !important;">

                            {{-- post ad buttons for different purpose   --}}
                            @if (session('vendor_data'))
                                @if (session('vendor_data')->phone)
                                    <button onclick="window.location.href = '{{ route('web.dashboard.create_ad') }}';"
                                        style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:9px !important; padding:5px !important;"
                                        class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST
                                        ADD</button>
                                @else
                                    <button onclick="alert('Please update your account');"
                                        style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:9px !important; padding:5px !important;"
                                        class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST
                                        ADD</button>
                                @endif
                            @else
                                <button onclick="window.location.href = '{{ route('web.vendor.login') }}';"
                                    style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:9px !important; padding:5px !important;"
                                    class="btn btn-warning"> <i class="fa-solid fa-car"></i> POST
                                    ADD</button>
                            @endif

                        </div>
                        <div style="display: inline !important;"> <button onclick="window.location.href = '';"
                                style="background-color: #37B093 !important; color:rgb(255, 255, 255) ; font-size:9px !important; padding:5px !important;"
                                class="btn btn-warning"> FIND GARAGE</button>
                        </div>

                        {{-- next chnage  --}}

                    </div>

                    <div style="display: none !important;" class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categories-button-active" href="#">
                                <span class="fi-rs-apps"></span> <span class="et">Trending</span> Categories
                                <i class="fi-rs-angle-down"></i>
                            </a>
                            <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-1.svg') }}"
                                                    alt="" />Milks and Dairies</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-2.svg') }}"
                                                    alt="" />Clothing & beauty</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-3.svg') }}"
                                                    alt="" />Pet Foods & Toy</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-4.svg') }}"
                                                    alt="" />Baking material</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-5.svg') }}"
                                                    alt="" />Fresh Fruit</a>
                                        </li>
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-6.svg') }}"
                                                    alt="" />Wines & Drinks</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-7.svg') }}"
                                                    alt="" />Fresh Seafood</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-8.svg') }}"
                                                    alt="" />Fast food</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-9.svg') }}"
                                                    alt="" />Vegetables</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img
                                                    src="{{ asset('web/assets/imgs/theme/icons/category-10.svg') }}"
                                                    alt="" />Bread and Juice</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="more_slide_open" style="display: none">
                                    <div class="d-flex categori-dropdown-inner">
                                        <ul>
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-1.svg') }}"
                                                        alt="" />Milks and Dairies</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-2.svg') }}"
                                                        alt="" />Clothing & beauty</a>
                                            </li>
                                        </ul>
                                        <ul class="end">
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-3.svg') }}"
                                                        alt="" />Wines & Drinks</a>
                                            </li>
                                            <li>
                                                <a href="shop-grid-right.html"> <img
                                                        src="{{ asset('web/assets/imgs/theme/icons/icon-4.svg') }}"
                                                        alt="" />Fresh Seafood</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="more_categories"><span class="icon"></span> <span
                                        class="heading-sm-1">Show more...</span></div>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                            <nav>
                                <ul>
                                    <li class="hot-deals"><img
                                            src="{{ asset('web/assets/imgs/theme/icons/icon-hot-white.svg') }}"
                                            alt="hot deals" /><a href="shop-grid-right.html">Deals</a></li>
                                    <li>
                                        <a class="active" href="index.html">Home <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Home 1</a></li>
                                            <li><a href="index-2.html">Home 2</a></li>
                                            <li><a href="index-3.html">Home 3</a></li>
                                            <li><a href="index-4.html">Home 4</a></li>
                                            <li><a href="index-5.html">Home 5</a></li>
                                            <li><a href="index-6.html">Home 6</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="page-about.html">About</a>
                                    </li>
                                    <li>
                                        <a href="shop-grid-right.html">Shop <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="shop-grid-right.html">Shop Grid – Right Sidebar</a></li>
                                            <li><a href="shop-grid-left.html">Shop Grid – Left Sidebar</a></li>
                                            <li><a href="shop-list-right.html">Shop List – Right Sidebar</a></li>
                                            <li><a href="shop-list-left.html">Shop List – Left Sidebar</a></li>
                                            <li><a href="shop-fullwidth.html">Shop - Wide</a></li>
                                            <li>
                                                <a href="#">Single Product <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-product-right.html">Product – Right Sidebar</a>
                                                    </li>
                                                    <li><a href="shop-product-left.html">Product – Left Sidebar</a>
                                                    </li>
                                                    <li><a href="shop-product-full.html">Product – No sidebar</a></li>
                                                    <li><a href="shop-product-vendor.html">Product – Vendor Info</a>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="shop-filter.html">Shop – Filter</a></li>
                                            <li><a href="shop-wishlist.html">Shop – Wishlist</a></li>
                                            <li><a href="shop-cart.html">Shop – Cart</a></li>
                                            <li><a href="shop-checkout.html">Shop – Checkout</a></li>
                                            <li><a href="shop-compare.html">Shop – Compare</a></li>
                                            <li>
                                                <a href="#">Shop Invoice<i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu">
                                                    <li><a href="shop-invoice-1.html">Shop Invoice 1</a></li>
                                                    <li><a href="shop-invoice-2.html">Shop Invoice 2</a></li>
                                                    <li><a href="shop-invoice-3.html">Shop Invoice 3</a></li>
                                                    <li><a href="shop-invoice-4.html">Shop Invoice 4</a></li>
                                                    <li><a href="shop-invoice-5.html">Shop Invoice 5</a></li>
                                                    <li><a href="shop-invoice-6.html">Shop Invoice 6</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Vendors <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="vendors-grid.html">Vendors Grid</a></li>
                                            <li><a href="vendors-list.html">Vendors List</a></li>
                                            <li><a href="vendor-details-1.html">Vendor Details 01</a></li>
                                            <li><a href="vendor-details-2.html">Vendor Details 02</a></li>
                                            <li><a href="vendor-dashboard.html">Vendor Dashboard</a></li>
                                            <li><a href="vendor-guide.html">Vendor Guide</a></li>
                                        </ul>
                                    </li>
                                    <li class="position-static">
                                        <a href="#">Mega menu <i class="fi-rs-angle-down"></i></a>
                                        <ul class="mega-menu">
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Fruit & Vegetables</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Meat & Poultry</a></li>
                                                    <li><a href="shop-product-right.html">Fresh Vegetables</a></li>
                                                    <li><a href="shop-product-right.html">Herbs & Seasonings</a></li>
                                                    <li><a href="shop-product-right.html">Cuts & Sprouts</a></li>
                                                    <li><a href="shop-product-right.html">Exotic Fruits & Veggies</a>
                                                    </li>
                                                    <li><a href="shop-product-right.html">Packaged Produce</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Breakfast & Dairy</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Milk & Flavoured Milk</a>
                                                    </li>
                                                    <li><a href="shop-product-right.html">Butter and Margarine</a></li>
                                                    <li><a href="shop-product-right.html">Eggs Substitutes</a></li>
                                                    <li><a href="shop-product-right.html">Marmalades</a></li>
                                                    <li><a href="shop-product-right.html">Sour Cream</a></li>
                                                    <li><a href="shop-product-right.html">Cheese</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title" href="#">Meat & Seafood</a>
                                                <ul>
                                                    <li><a href="shop-product-right.html">Breakfast Sausage</a></li>
                                                    <li><a href="shop-product-right.html">Dinner Sausage</a></li>
                                                    <li><a href="shop-product-right.html">Chicken</a></li>
                                                    <li><a href="shop-product-right.html">Sliced Deli Meat</a></li>
                                                    <li><a href="shop-product-right.html">Wild Caught Fillets</a></li>
                                                    <li><a href="shop-product-right.html">Crab and Shellfish</a></li>
                                                </ul>
                                            </li>
                                            <li class="sub-mega-menu sub-mega-menu-width-34">
                                                <div class="menu-banner-wrap">
                                                    <a href="shop-product-right.html"><img
                                                            src="assets/imgs/banner/banner-menu.png"
                                                            alt="Nest" /></a>
                                                    <div class="menu-banner-content">
                                                        <h4>Hot deals</h4>
                                                        <h3>
                                                            Don't miss<br />
                                                            Trending
                                                        </h3>
                                                        <div class="menu-banner-price">
                                                            <span class="new-price text-success">Save to 50%</span>
                                                        </div>
                                                        <div class="menu-banner-btn">
                                                            <a href="shop-product-right.html">Shop now</a>
                                                        </div>
                                                    </div>
                                                    <div class="menu-banner-discount">
                                                        <h3>
                                                            <span>25%</span>
                                                            off
                                                        </h3>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="blog-category-grid.html">Blog <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="blog-category-grid.html">Blog Category Grid</a></li>
                                            <li><a href="blog-category-list.html">Blog Category List</a></li>
                                            <li><a href="blog-category-big.html">Blog Category Big</a></li>
                                            <li><a href="blog-category-fullwidth.html">Blog Category Wide</a></li>
                                            <li>
                                                <a href="#">Single Post <i class="fi-rs-angle-right"></i></a>
                                                <ul class="level-menu level-menu-modify">
                                                    <li><a href="blog-post-left.html">Left Sidebar</a></li>
                                                    <li><a href="blog-post-right.html">Right Sidebar</a></li>
                                                    <li><a href="blog-post-fullwidth.html">No Sidebar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Pages <i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="page-about.html">About Us</a></li>
                                            <li><a href="page-contact.html">Contact</a></li>
                                            <li><a href="page-account.html">My Account</a></li>
                                            <li><a href="page-login.html">Login</a></li>
                                            <li><a href="page-register.html">Register</a></li>
                                            <li><a href="page-forgot-password.html">Forgot password</a></li>
                                            <li><a href="page-reset-password.html">Reset password</a></li>
                                            <li><a href="page-purchase-guide.html">Purchase Guide</a></li>
                                            <li><a href="page-privacy-policy.html">Privacy Policy</a></li>
                                            <li><a href="page-terms.html">Terms of Service</a></li>
                                            <li><a href="page-404.html">404 Page</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="page-contact.html">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div style="display: none !important;" class="hotline d-none d-lg-flex">
                        <img src="assets/imgs/theme/icons/icon-headphone-white.svg" alt="hotline" />
                        <p>1900 - 888<span>24/7 Support Center</span></p>
                    </div>
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>


                    <div style="display: none !important;" class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="shop-wishlist.html">
                                    <img alt="Nest" src="assets/imgs/theme/icons/icon-heart.svg" />
                                    <span class="pro-count white">4</span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="#">
                                    <img alt="Nest" src="assets/imgs/theme/icons/icon-cart.svg" />
                                    <span class="pro-count white">2</span>
                                </a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <ul>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Nest"
                                                        src="{{ asset('web/assets/imgs/shop/thumbnail-3.jpg') }}" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Plain Striola Shirts</a></h4>
                                                <h3><span>1 × </span>$800.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="shopping-cart-img">
                                                <a href="shop-product-right.html"><img alt="Nest"
                                                        src="{{ asset('web/assets/imgs/shop/thumbnail-4.jpg') }}" /></a>
                                            </div>
                                            <div class="shopping-cart-title">
                                                <h4><a href="shop-product-right.html">Macbook Pro 2022</a></h4>
                                                <h3><span>1 × </span>$3500.00</h3>
                                            </div>
                                            <div class="shopping-cart-delete">
                                                <a href="#"><i class="fi-rs-cross-small"></i></a>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span>$383.00</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="shop-cart.html">View cart</a>
                                            <a href="shop-checkout.html">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-header-active mobile-header-wrapper-style">

        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="index.html"><img src="{{ asset('assets/imgs/theme/logo-color.png') }}"
                            alt="logo" /></a>
                </div>

                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                {{-- <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…" />
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div> --}}
                <div class="mobile-menu-wrap mobile-header-border">
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu font-heading">
                            <div class="mobile-header-info-wrap">

                                <div class="single-mobile-header-info">
                                    @if (session('vendor_data'))
                                        <li>
                                            <a href="{{ route('web.dashboardIndex') }}"> <i
                                                    class="fa fa-user-circle mr-10" aria-hidden="true"></i>
                                                Dashboard</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('web.vendor.login') }}"><i
                                                    class="fi fi-rs-user mr-10"></i>Login</a>
                                        </li>
                                    @endif
                                    <li>
                                        @if (session('vendor_data'))
                                            <a href="{{ route('web.vendor.logout') }}"><i
                                                    class="fi fi-rs-sign-out mr-10"></i>Sign
                                                out</a>
                                        @endif

                                </div>

                            </div>

                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">Home</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">About</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">All Ads</a>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ route('web.home') }}">Contact</a>

                            </li>

                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>

                <div class="mobile-social-icon mb-50">
                    <p class="mb-15">Follow Us</p>
                    <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-twitter-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-pinterest-white.svg') }}"
                            alt="" /></a>
                    <a href="#"><img src="{{ asset('web/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>

            </div>
        </div>
    </div>
    <!--End header-->

    @yield('content')

    <footer style="background-color: rgb(0, 0, 0); " class="main">


        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col">
                        <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0">
                            <div class="logo mb-30">
                                <a href="index.html" class="mb-15"><img
                                        src="{{ asset('assets/imgs/theme/logo-color.png') }}" alt="logo" /></a>

                            </div>
                            <ul style="color: white !important;" class="contact-infor">
                                <li><img src="assets/imgs/theme/icons/icon-location.svg"
                                        alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined
                                        Kent, Utah 53127 United States</span></li>
                                <li><img src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call
                                        Us:</strong><span>(+91) - 540-025-124553</span></li>
                                <li><img src="assets/imgs/theme/icons/icon-email-2.svg"
                                        alt="" /><strong>Email:</strong><span>sale@Nest.com</span></li>
                                <li><img src="assets/imgs/theme/icons/icon-clock.svg"
                                        alt="" /><strong>Hours:</strong><span>10:00 - 18:00, Mon - Sat</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-link-widget col">
                        <h4 style="color: white !important;" class="widget-title">Links</h4>
                        <ul class="footer-list mb-sm-5 mb-md-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="footer-link-widget widget-install-app col">
                        <h4 style="color: white !important;" class="widget-title">Install App</h4>
                        <p style="color: white !important;" class="wow fadeIn animated">From App Store or Google Play
                        </p>
                        <div class="download-app">

                            <a href="#" class="hover-up mb-sm-2 mb-lg-0"><img style="height:60px !important;"
                                    class="active" src="https://i.ibb.co/QkCVtB2/app-store.png" alt="" /></a>

                            <a href="#" class="hover-up mb-sm-2"><img style="height:60px !important;"
                                    src="https://i.ibb.co/z2xLY7s/playstore.png" alt="" /></a>
                        </div>
                        <p style="color: white !important;" class="mb-20">Sampath Payment Gateway</p>
                        <img style="height: 50px ; weight:50px;" class="wow fadeIn animated"
                            src="https://i.ibb.co/7jVrN07/sampath-bank-logo-660-B6-E8-BC9-seeklogo-com.png"
                            alt="" />
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-30">
            <div class="row align-items-center">
                <div class="col-12 mb-30">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6">

                </div>
                <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">


                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                    <div class="mobile-social-icon">
                        <h6 style="color: white">Follow Us</h6>

                        <a style="background-color: transparent ;" href="#"><img
                                style="background-color: none !important; object-fit:contain !important; "
                                src="https://i.ibb.co/5GSSkXL/facebook.png" alt="facebook"> </a>
                        <a style="background-color: transparent ;" href="#"><img
                                style="background-color: none !important; object-fit:contain !important;"
                                src="https://i.ibb.co/w0fvBRB/twitter.png" alt="" /></a>
                        <a style="background-color: transparent ;" href="#"><img
                                style="background-color: none !important; object-fit:contain !important;"
                                src="https://i.ibb.co/4sJRQtJ/linkedin-1.png" alt="" /></a>


                        <a style="background-color: transparent ; " href="#"><img
                                style="background-color: none !important; object-fit:contain !important;"
                                src="https://i.ibb.co/vHmMMNr/youtube.png" alt="" /></a>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('web/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('web/assets/js/shop.js?v=5.3') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>



</body>

</html>
