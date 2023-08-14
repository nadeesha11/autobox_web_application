@extends('Web.Layout.Layout')
@section('content')
    <style>
        .edit_details {
            background-color: white !important;
            color: black !important;
        }

        /* Customize modal styles */
        #edit_vendor_details_single .modal-content {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        #edit_vendor_details_single .modal-header {
            background-color: #f3fff3;
            border-bottom: none;
        }

        #edit_vendor_details_single .modal-footer {
            background-color: #f3fff3;
            border-top: none;
        }

        #edit_vendor_details_single .btn-primary {
            background-color: #37B093;

        }

        #edit_vendor_details_single .btn-primary:hover {
            background-color: #37B093;

        }
    </style>
    <!--End header-->
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="dashboard-menu">
                                    <ul class="nav flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                                href="#dashboard" role="tab" aria-controls="dashboard"
                                                aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard
                                            </a>
                                        </li>
                                        @if (session('vendor_data')->phone)
                                        @else
                                            <li class="nav-item">
                                                <a class="nav-link " id="account-detail-tab" data-bs-toggle="tab"
                                                    href="#account-detail" role="tab" aria-controls="account-detail"
                                                    aria-selected="true"><i class="fi-rs-user mr-10"></i>Update account</a>
                                            </li>
                                        @endif
                                        <li class="nav-item ">
                                            <a class="nav-link  " id="orders-tab" data-bs-toggle="tab" href="#myPackages"
                                                role="tab" aria-controls="orders" aria-selected="false"><i
                                                    class="fi-rs-shopping-bag mr-10"></i>Package Details</a>
                                        </li>
                                        <li class="nav-item">

                                            <a class="nav-link" id="track-orders-tab"
                                                href="{{ route('vendor.dashboard.adsmanagement') }}"><i
                                                    class="fi-rs-shopping-cart-check mr-10"></i>Ads
                                                Management</a>
                                        </li>
                                        <li class="nav-item">

                                            <a class="nav-link" id="track-orders-tab"
                                                href="{{ route('web.dashboard.index') }}"><i class="fa fa-car"
                                                    aria-hidden="true"></i> Garage Management</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('web.vendor.logout') }}"><i
                                                    class="fi-rs-sign-out mr-10"></i>Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content account dashboard-content pl-50">

                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h3 class="mb-0">Hello {{ session('vendor_data')->name }}</h3>


                                            </div>
                                            <div class="card-body">
                                                {{-- chnaged ui start --}}
                                                <div class="text-center">
                                                    @if (isset($vendor_details->Profile_Image))
                                                        <img style="height: 100px; width:100px; object-fit:cover;"
                                                            src="{{ asset('assets/myCustomThings/vehicleTypes/' . $vendor_details->Profile_Image) }}" />
                                                    @else
                                                        <img style="height: 100px; width:100px; object-fit:cover;"
                                                            src="https://i.ibb.co/C2g55RP/3135715.png" alt="profile">
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    @if (isset($vendor_details->name))
                                                        {{ $vendor_details->name }}
                                                    @else
                                                    @endif
                                                </div>
                                                <div class="text-center">
                                                    <div>
                                                        @if (isset($vendor_details->First_Name))
                                                            <a href="{{ route('web.dashboard.becomeDealer') }}"
                                                                class="btn btn-primary">Become
                                                                Dealer</a>
                                                        @else
                                                            <button disabled class="btn btn-primary">Become
                                                                Dealer</button>
                                                            <p style="font-size: 10px;">You need to fill basic details first
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div>
                                                    <div>
                                                        @if (isset($vendor_details->email))
                                                            {{ $vendor_details->email }}
                                                        @else
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (isset($vendor_details->First_Name))
                                                            {{ $vendor_details->First_Name }}
                                                        @else
                                                        @endif
                                                        @if (session('vendor_data')->phone)
                                                            <a
                                                                onclick="editDetails('First Name','{{ $vendor_details->First_Name }}'); "><i
                                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        @endif
                                                    </div>

                                                    <div>

                                                        @if (isset($vendor_details->Last_Name))
                                                            {{ $vendor_details->Last_Name }}
                                                        @else
                                                        @endif

                                                        @if (session('vendor_data')->phone)
                                                            <a
                                                                onclick="editDetails('Last Name','{{ $vendor_details->Last_Name }}'); "><i
                                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        @endif

                                                    </div>


                                                    <div>
                                                        @if (isset($vendor_details->phone))
                                                            {{ '+94' . $vendor_details->phone }}
                                                        @else
                                                        @endif

                                                        @if (session('vendor_data')->phone)
                                                            <a
                                                                onclick="editDetails('Phone','{{ $vendor_details->phone }}'); "><i
                                                                    class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (isset($vendor_details->district))
                                                            {{ $vendor_details->district }}
                                                        @else
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (isset($vendor_details->city))
                                                            {{ $vendor_details->city }}
                                                        @else
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (isset($vendor_details->Fb_link))
                                                            <a href="{{ $vendor_details->Fb_link }}">{{ $vendor_details->Fb_link }}
                                                                (Facebook)</a>
                                                        @else
                                                        @endif
                                                        @if (session('vendor_data')->phone)
                                                            @if (isset($vendor_details->Fb_link))
                                                                <a
                                                                    onclick="editDetails('Fb link','{{ $vendor_details->Fb_link }}'); "><i
                                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (isset($vendor_details->Twitter_link))
                                                            <a href="{{ $vendor_details->Twitter_link }}">{{ $vendor_details->Twitter_link }}
                                                                (Twitter)</a>
                                                        @else
                                                        @endif
                                                        @if (session('vendor_data')->phone)
                                                            @if (isset($vendor_details->Twitter_link))
                                                                <a
                                                                    onclick="editDetails('Twitter link','{{ $vendor_details->Twitter_link }}'); "><i
                                                                        class="fa fa-pencil" aria-hidden="true"></i> </a>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (isset($vendor_details->Linkedin_link))
                                                            <a href="{{ $vendor_details->Linkedin_link }}">{{ $vendor_details->Linkedin_link }}
                                                                Linkedin</a>
                                                        @else
                                                        @endif
                                                        @if (session('vendor_data')->phone)
                                                            @if (isset($vendor_details->Linkedin_link))
                                                                <a
                                                                    onclick="editDetails('Linkedin link','{{ $vendor_details->Linkedin_link }}'); "><i
                                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    <div>
                                                        @if (isset($vendor_details->Youtube_link))
                                                            <a href="{{ $vendor_details->Youtube_link }}">{{ $vendor_details->Youtube_link }}
                                                                Youtube</a>
                                                        @else
                                                        @endif

                                                        @if (session('vendor_data')->phone)
                                                            @if (isset($vendor_details->Youtube_link))
                                                                <a
                                                                    onclick="editDetails('Youtube link','{{ $vendor_details->Youtube_link }}'); "><i
                                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                                            @endif
                                                        @endif

                                                        </td>
                                                        </tr>
                                                    </div>


                                                </div>
                                                {{-- chnaged ui end --}}



                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="myPackages" role="tabpanel"
                                        aria-labelledby="orders-tab">

                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="mb-0">My Packages</h3>
                                            </div>
                                            <div class="card-body row">
                                                <div class="col-lg-6 col-md-12 col-sm-12 mb-2">
                                                    <div style="border: 1px solid rgba(219, 215, 215, 0.685); border-radius:5px ;"
                                                        class="p-1">
                                                        <div
                                                            style="display: flex; justify-content: space-between; align-items: center;">
                                                            <h5 class="text-left m-2">Ad Package</h5>
                                                            <a href="{{ route('web.dashboard.adsPackages') }}"
                                                                style="margin-right: 20px;">Buy Package</a>
                                                        </div>
                                                        @if ($current_package_details)
                                                            <table style="margin: 4px;" class="table table-striped">

                                                                <tbody>
                                                                    <tr>
                                                                        <td>Currrent Package</td>
                                                                        <td>{{ $current_package_details->package_name }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Available ad count</td>
                                                                        <td>{{ $current_package_details->available_ad_count }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Available topad count</td>
                                                                        <td>{{ $current_package_details->available_top_count }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Package Start</td>
                                                                        <td>{{ $current_package_details->package_start_date }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Package End</td>
                                                                        <td>{{ $current_package_details->package_expire_date }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Maximun Image Count</td>
                                                                        <td>{{ $current_package_details->image_count }}
                                                                        </td>
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        @else
                                                            <div class="text-center m-2 p-2">
                                                                package not activated
                                                            </div>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-12 col-sm-12 mb-2">
                                                    <div style="border: 1px solid rgba(219, 215, 215, 0.685); border-radius:5px ;"
                                                        class="p-1">
                                                        <div
                                                            style="display: flex; justify-content: space-between; align-items: center;">
                                                            <h5 class="text-left m-2">Top Ad Package</h5>
                                                            <a href="{{ route('web.dashboard.topAdsPackages') }}"
                                                                style="margin-right: 20px;">Buy Package</a>
                                                        </div>

                                                        <div class="text-center m-2 p-2">
                                                            package not activated
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="track-orders" role="tabpanel"
                                        aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between">
                                                    <h3 class="mb-0">Ads Management</h3>

                                                </div>
                                            </div>
                                            <div class="card-body contact-from-area">
                                                <div>
                                                    current ads should be displayed
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="address" role="tabpanel"
                                        aria-labelledby="address-tab">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="card mb-3 mb-lg-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">Billing Address</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            3522 Interstate<br />
                                                            75 Business Spur,<br />
                                                            Sault Ste. <br />Marie, MI 49783
                                                        </address>
                                                        <p>New York</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="mb-0">Shipping Address</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <address>
                                                            4299 Express Lane<br />
                                                            Sarasota, <br />FL 34249 USA <br />Phone: 1.941.227.4444
                                                        </address>
                                                        <p>Sarasota</p>
                                                        <a href="#" class="btn-small">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                        aria-labelledby="account-detail-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Account Details</h5>
                                            </div>
                                            <div class="card-body">

                                                <form id="basic_details_form">
                                                    <div class="row">
                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input class="form-control"
                                                                value="{{ $vendor_details->First_Name }}"
                                                                placeholder="First Name *" name="First_Name"
                                                                type="text" />
                                                            <span class="text-danger clear_form_error"
                                                                id="first_name_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input value="{{ $vendor_details->Last_Name }}"
                                                                class="form-control" placeholder="Last Name *"
                                                                name="Last_Name" />
                                                            <span class="text-danger clear_form_error"
                                                                id="last_name_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control country-code-input"
                                                                    name="country_code" value="+94" readonly
                                                                    style="max-width: 80px;" />
                                                                <input type="text"
                                                                    value="{{ $vendor_details->phone }}"
                                                                    class="form-control" name="phone"
                                                                    placeholder="Phone Number *" />
                                                            </div>
                                                            <span class="text-danger clear_form_error"
                                                                id="phone_error"></span>
                                                        </div>


                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input readonly value="{{ session('vendor_data')->email }}"
                                                                placeholder="Email Address *" class="form-control"
                                                                name="email" type="email" />
                                                            <span class="text-danger clear_form_error"
                                                                id="email_address_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input placeholder="Username *"
                                                                value="{{ session('vendor_data')->name }}"
                                                                class="form-control" name="Username" type="email"
                                                                readonly />
                                                            <span class="text-danger clear_form_error"
                                                                id="Username_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <select name="district" id="district_value"
                                                                style="height: 60px;" class="form-select"
                                                                aria-label="Default select example">
                                                                <option value="">
                                                                    Please select district</option>
                                                                @foreach ($district as $item)
                                                                    <option data-custom-attribute="{{ $item->id }}"
                                                                        value="{{ $item->name_en }}">
                                                                        {{ $item->name_en }}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="text-danger clear_form_error"
                                                                id="District_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <select name="city" style="height: 60px;"
                                                                class="form-select" id="city"
                                                                aria-label="Default select example">
                                                                <option value="">
                                                                    Please select city</option>
                                                            </select>
                                                            <span class="text-danger clear_form_error"
                                                                id="City_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input value="{{ $vendor_details->Fb_link }}" name="Fb_link"
                                                                placeholder="Fb link" class="form-control" name="email"
                                                                type="email" />
                                                            <span class="text-danger clear_form_error"
                                                                id="Fb_link_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input value="{{ $vendor_details->Twitter_link }}"
                                                                name="Twitter_link" placeholder="Twitter link"
                                                                class="form-control" name="email" type="email" />
                                                            <span class="text-danger clear_form_error"
                                                                id="Twitter_link_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input value="{{ $vendor_details->Linkedin_link }}"
                                                                name="Linkedin_link" placeholder="Linkedin link"
                                                                class="form-control" name="email" type="email" />
                                                            <span class="text-danger clear_form_error"
                                                                id="Linkedin_link_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-6 col-lg-6">
                                                            <input value="{{ $vendor_details->Youtube_link }}"
                                                                name="Youtube_link" placeholder="Youtube link"
                                                                class="form-control" name="email" type="email" />
                                                            <span class="text-danger clear_form_error"
                                                                id="Youtube_link_error"></span>
                                                        </div>

                                                        <div class="form-group col-md-12 col-lg-12 ">
                                                            <input name="Profile_Image" type="file" class="dropify"
                                                                data-height="200" />
                                                            <span class="text-danger clear_form_error"
                                                                id="Profile_Image_error"></span>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <button type="button" id="basic_details_btn"
                                                                class="btn btn-fill-out submit font-weight-bold">Save
                                                                Change</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit_vendor_details_single" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_form">
                            <div class="mb-3">
                                <input type="hidden" id="hidden_single_type" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_input" class="form-label"></label>
                                <input type="text" name="single_value" style="border-color: #37B093 !important; "
                                    class="form-control clear_input" id="single_input_value">
                                <span style="color:#ee2c1e" id="display_input_error" class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="change_single_data_btn" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {

            var targetPane = "{{ session('display_current_package') }}";
            if (targetPane) {
                $('#orders-tab')[0].click();
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); //ajax setup

            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop profile picture here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            $('#district_value').change(function() {

                var selectedOption = $(this).find('option:selected');
                var district_value = selectedOption.data('custom-attribute');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('web.dashboard.getCity') }}",
                    data: {
                        value: district_value,
                    },
                    success: function(data) {
                        var city_append = '';
                        $.each(data, function(index, row) {
                            if (row
                                .name_en
                            ) { // Check if the name_en property is not empty
                                city_append += '<option value="' + row.name_en + '">' +
                                    row.name_en + '</option>';
                            }
                        });
                        $("#city").html(city_append);
                    }
                });
            });


            $('#basic_details_btn').click(function() {
                document.getElementById("basic_details_btn").disabled = true; //enable button after click it
                $('.clear_form_error').html('');

                // to get csrf
                var basic_details_form = $('#basic_details_form')[0];
                var basic_details_form_ajax = new FormData(basic_details_form); // get form data

                Swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                // ajax post start 
                $.ajax({
                    url: "{{ route('web.dashboard.basicFormDetailsCreate') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: basic_details_form_ajax,
                    success: function(response) {
                        document.getElementById("basic_details_btn").disabled =
                            false; //enable button after click it

                        if (response.code == "true") {

                            var dashboardIndexUrl = "{{ route('web.dashboardIndex') }}";
                            window.location.href = dashboardIndexUrl;



                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg
                        }

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        //   Swal.close(); // Close the SweetAlert
                    },

                    error: function(error) {
                        Swal.close(); // Close the SweetAlert
                        // display validations in created slider 

                        $('#first_name_error').html(error.responseJSON.errors.First_Name);
                        $('#last_name_error').html(error.responseJSON.errors.Last_Name);
                        $('#phone_error').html(error.responseJSON.errors.phone);
                        $('#email_address_error').html(error.responseJSON.errors.email);
                        $('#Username_error').html(error.responseJSON.errors.Username);
                        $('#District_error').html(error.responseJSON.errors.district);
                        $('#City_error').html(error.responseJSON.errors.city);
                        $('#Fb_link_error').html(error.responseJSON.errors.Fb_link);
                        $('#Twitter_link_error').html(error.responseJSON.errors.Twitter_link);
                        $('#Linkedin_link_error').html(error.responseJSON.errors.Twitter_link);
                        $('#Youtube_link_error').html(error.responseJSON.errors.Youtube_link);
                        $('#Profile_Image_error').html(error.responseJSON.errors.Profile_Image);

                        document.getElementById("basic_details_btn").disabled =
                            false; //enable button after click it
                    }
                });
            });

            $('#change_single_data_btn').click(function() {
                document.getElementById("change_single_data_btn").disabled = true;
                $('.clear_form_error').html('');

                // to get csrf
                var form = $('#update_single_values_form')[0];
                var form_data = new FormData(form); // get form data

                // ajax post start 
                $.ajax({
                    url: "{{ route('web.vendorData.update') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: form_data,
                    success: function(response) {

                        document.getElementById("change_single_data_btn").disabled = false;
                        if (response.code === "false") {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg

                            $('.clear_input').val('');
                            $('.clear_form_error').html('');
                            $('#edit_vendor_details_single').modal('hide');

                        } else {
                            // Refresh the page
                            location.reload();

                        }
                        // $('.clear_input').val('');
                        // $('.clear_form_error').html('');

                    },
                    error: function(error) {
                        document.getElementById("change_single_data_btn").disabled = false;
                        $('#display_input_error').html(error.responseJSON.errors
                            .single_value);

                    }
                });
            })


        });

        function editDetails(change_variable, currentValue) {
            $('.clear_form_error').html('');
            $('#single_input_value').val(currentValue)
            $('#hidden_single_type').val(change_variable)
            // $('#single_input_value').val(currentValue)
            var modalTitle = document.getElementById("modal_title");
            var change_title_input = document.getElementById("change_title_input");
            modalTitle.textContent = "Change " + change_variable;
            change_title_input.textContent = change_variable;
            $('#edit_vendor_details_single').modal('show');
        }
    </script>
@endsection
