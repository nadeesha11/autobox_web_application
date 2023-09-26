@extends('Web.Layout.Layout')
@section('content')
    <style>
        .content-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.8);
            /* Add a background color to the content container if needed */
            padding: 20px;
        }

        .select-label {
            position: absolute;
            top: 0;
            left: 0;

            background-color: #fff;
            font-size: 0.8em;
            font-weight: bold;
            color: #66cc63;
        }

        .custom_select {
            position: relative;
        }

        .clear_form_error {
            color: red;
        }
    </style>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.dashboardIndex') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="{{ route('web.dashboardIndex') }}">Dashboard</a> <span></span> <a
                        href="#">Buy Top Ads</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;">Post</h5>
                        <div style="float: right;">
                            <div style="float: left; margin-right:5px;">
                                <p style="display: inline-block; margin-right:9px;"><i style="margin-right: 3px;"
                                        class="fas fa-map-marker-alt"></i><span id="display_current_district">
                                        @if (session('vendor_current_location'))
                                            {{ session('vendor_current_location')['district'] }}
                                        @else
                                            {{ session('vendor_data')->district }}
                                        @endif
                                    </span>
                                </p>
                                <p style="display: inline-block;  margin-right:9px;"><i style="margin-right: 3px;"
                                        class="fas fa-map-marker-alt"></i>
                                    <span id="display_current_city">
                                        @if (session('vendor_current_location'))
                                            {{ session('vendor_current_location')['city'] }}
                                        @else
                                            {{ session('vendor_data')->city }}
                                        @endif
                                    </span>
                                </p>
                            </div>

                            <div style="float: right;  margin-right:9px;"> <a data-bs-toggle="modal"
                                    href="#exampleModalToggle" role="button"> Change </a> </div>
                        </div>

                        <div style="clear: both;"></div>
                        <span class="clear_form_error" id="district_name_error"></span>
                        <span class="clear_form_error" id="city_name_error"></span>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <form id="create_ad_form">
                                <input type="hidden" id="district_name"
                                    value="  @if (session('vendor_current_location')) {{ session('vendor_current_location')['district'] }}
                            @else
                                {{ session('vendor_data')->district }} @endif"
                                    name="district_name" id="">

                                <input type="hidden"
                                    value="    @if (session('vendor_current_location')) {{ session('vendor_current_location')['city'] }}
                            @else
                                {{ session('vendor_data')->city }} @endif"
                                    name="city_name" id="city_name">

                                <div class="row shipping_calculator">
                                    <div class="form-group col-lg-6">
                                        <input type="text" name="title" placeholder="Enter Title *">
                                        <span class="clear_form_error" id="title_error"></span>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="number" name="price" placeholder="Enter Price*">
                                        <span class="clear_form_error" id="price_error"></span>
                                    </div>
                                </div>

                                <div class="row shipping_calculator">
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select id="vehicle_type" name="vehicle_type"
                                                class="form-control select-active">
                                                <option value="">Select an vehicle type ...</option>
                                                @foreach ($vehicle_types as $id => $vt_name)
                                                    <option value="{{ $id }}">{{ $vt_name }}</option>
                                                @endforeach

                                            </select>
                                            <label for="vehicle_type" class="select-label">Vehicle Type</label>
                                            <span class="clear_form_error" id="vehicle_type_error"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select name="brand_id" id="brands" class="form-control select-active">
                                                <option value="">Select an manufacturer ...</option>
                                            </select>
                                            <label for="brands" class="select-label">Manufacturer</label>
                                            <span class="clear_form_error" id="brand_id_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row shipping_calculator">
                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select name="model_id" id="models" class="form-control select-active">
                                                <option value="">Select an Model ...</option>
                                            </select>
                                            <label for="models" class="select-label">Model</label>
                                            <span class="clear_form_error" id="model_id_error"></span>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <div class="custom_select">
                                            <select id="condition_" name="condition" style="height: 62px !important;"
                                                class="form-control ">
                                                <option value="">Select an condition ...</option>
                                                <option value="Reconditioned">Reconditioned</option>
                                                <option value="New">New</option>
                                                <option value="Used">Used</option>
                                            </select>
                                            <label for="condition_" class="select-label">Condition</label>
                                            <span class="clear_form_error" id="condition_error"></span>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row ">
                                    @if ($package_max_image >= 1)
                                        <div class=" col-md-4 col-sm-12">
                                            <div class="m-1">
                                                <input id="image_1" data-allowed-file-extensions="jpeg  jpg "
                                                    data-max-file-size-preview="1M" name="image_1" class="dropify"
                                                    type="file">
                                                <span class="clear_form_error" id="image_1_error"></span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($package_max_image >= 2)
                                        <div class=" col-md-4 col-sm-12">
                                            <div class="m-1">
                                                <input id="image_2" data-allowed-file-extensions="jpeg  jpg "
                                                    data-max-file-size-preview="1M" name="image_2" class="dropify"
                                                    type="file" disabled>
                                                <span class="clear_form_error" id="image_2_error"></span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($package_max_image >= 3)
                                        <div class=" col-md-4 col-sm-12">
                                            <div class="m-1">
                                                <input id="image_3" data-allowed-file-extensions="jpeg  jpg "
                                                    data-max-file-size-preview="1M" name="image_3" class="dropify"
                                                    type="file" disabled>
                                                <span class="clear_form_error" id="image_3_error"></span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($package_max_image >= 4)
                                        <div class=" col-md-4 col-sm-12">
                                            <div class="m-1">
                                                <input id="image_4" data-allowed-file-extensions="jpeg  jpg "
                                                    data-max-file-size-preview="1M" name="image_4" class="dropify"
                                                    type="file" disabled>
                                                <span class="clear_form_error" id="image_4_error"></span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($package_max_image >= 5)
                                        <div class=" col-md-4 col-sm-12">
                                            <div class="m-1">
                                                <input id="image_5" data-allowed-file-extensions="jpeg  jpg "
                                                    data-max-file-size-preview="1M" name="image_5" class="dropify"
                                                    type="file" disabled>
                                                <span class="clear_form_error" id="image_5_error"></span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($package_max_image >= 6)
                                        <div class=" col-md-4 col-sm-12">
                                            <div class="m-1">
                                                <input id="image_6" data-allowed-file-extensions="jpeg  jpg "
                                                    data-max-file-size-preview="1M" name="image_6" class="dropify"
                                                    type="file" disabled>
                                                <span class="clear_form_error" id="image_6_error"></span>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group mb-30">
                                    <textarea class=" " id="description" name="additional_information" rows="5"
                                        placeholder="Additional information"></textarea>
                                    <span class="clear_form_error" id="description_error"></span>
                                </div>
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="negotiable"
                                            id="exampleCheckbox1" value="negotiable" />
                                        <label class="form-check-label" for="exampleCheckbox1"><i
                                                class="fa-solid fa-tag m-1"></i><span> negotiable</span></label>
                                    </div>
                                </div>
                                <div class="chek-form">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="topad"
                                            id="exampleCheckbox1" value="topad" />
                                        <label class="form-check-label" for="exampleCheckbox1"><i
                                                class="fa-solid fa-anchor m-1"></i><span>Publish as a top
                                                ad</span></label>
                                    </div>
                                </div>
                                <button id="create_ad" type="button" class="btn btn-success">Save</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Change Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <select id="district_value" class="form-control select-active custom-width"
                                    style="width: 100% !important; max-width: 100% !important;">
                                    <option value="">Choose District ...</option>
                                    @foreach ($district as $id => $name)
                                        <option data-special="{{ $name }}" value="{{ $id }}">
                                            {{ $name }}</option>
                                    @endforeach
                                </select>
                                <label for="district_value" class="select-label">District</label>
                            </div>
                        </div>
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <select id="city" class="form-control select-active custom-width"
                                    style="width: 100% !important; max-width: 100% !important;">
                                    <option value="">Choose City ...</option>
                                </select>
                                <label for="city" class="select-label">City</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="change_location" data-bs-target="#exampleModalToggle2"
                        data-bs-toggle="modal" data-bs-dismiss="modal">Change</button>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"
        integrity="sha512-ngQ4IGzHQ3s/Hh8kMyG4FC74wzitukRMIcTOoKT3EyzFZCILOPF0twiXOQn75eDINUfKBYmzYn2AA8DkAk8veQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"
        integrity="sha512-6rE6Bx6fCBpRXG/FWpQmvguMWDLWMQjPycXMr35Zx/HRD9nwySZswkkLksgyQcvrpYMx0FELLJVBvWFtubZhDQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageInputs = document.querySelectorAll('.dropify');
            var imageInputCount = imageInputs.length;

            for (var i = 0; i < imageInputCount - 1; i++) {
                imageInputs[i].addEventListener('change', function() {
                    var currentIndex = parseInt(this.id.split('_')[1]);
                    var nextIndex = currentIndex + 1;
                    var nextImageInput = document.getElementById('image_' + nextIndex);

                    if (this.value.trim() !== '') {
                        nextImageInput.disabled = false;
                    } else {
                        nextImageInput.disabled = true;
                        nextImageInput.value = ''; // Clear the value of the next input
                    }
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            $('#description').summernote({
                height: 200,
                placeholder: 'description ...',
                toolbar: [

                ]
            }); //add summernote to description

            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a image here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); //ajax setup

            // start create ads 
            $('#create_ad').click(function() {
                document.getElementById("create_ad").disabled = true;
                $('.clear_form_error').html('');

                // to get csrf
                var create_ad = $('#create_ad_form')[0];
                var create_ad_data = new FormData(create_ad); // get form data

                // ajax post start 
                $.ajax({
                    url: "{{ route('web.vendor_dashboard.create_ad') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: create_ad_data,
                    success: function(response) {

                        document.getElementById("create_ad").disabled = false;
                        if (response.code == "true") {
                            window.location.href = "{{ route('web.dash.ad.created') }}";

                        } else if (response.code == "false") {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Sorry , Try Again',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg
                        }
                    },
                    error: function(error) {
                        document.getElementById("create_ad").disabled = false;
                        // display validations in created admin 
                        $('#title_error').html(error.responseJSON.errors
                            .title);
                        $('#price_error').html(error.responseJSON.errors
                            .price);
                        $('#vehicle_type_error').html(error.responseJSON.errors
                            .vehicle_type);
                        $('#brand_id_error').html(error.responseJSON.errors
                            .brand_id);
                        $('#model_id_error').html(error.responseJSON.errors
                            .model_id);
                        $('#condition_error').html(error.responseJSON.errors
                            .condition);
                        $('#accessory_type_error').html(error.responseJSON.errors
                            .part_accessory_type_id);
                        $('#image_1_error').html(error.responseJSON.errors
                            .image_1);
                        $('#image_2_error').html(error.responseJSON.errors
                            .image_2);
                        $('#image_3_error').html(error.responseJSON.errors
                            .image_3);
                        $('#image_4_error').html(error.responseJSON.errors
                            .image_4);
                        $('#image_5_error').html(error.responseJSON.errors
                            .image_5);
                        $('#image_6_error').html(error.responseJSON.errors
                            .image_6);
                        $('#district_name_error').html(error.responseJSON.errors
                            .district_name);
                        $('#city_name_error').html(error.responseJSON.errors
                            .city_name);
                        $('#description_error').html(error.responseJSON.errors
                            .additional_information);

                    }
                });
            });
            // end create ads

            $('#change_location').click(function() {
                var city = $('#city').val();
                var specialValue = $('#district_value option:selected').data('special');

                if (!city || !specialValue) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'City and special value are required!',
                    });
                    return; // Stop further execution
                }

                $('#city_name').val(city);
                $('#district_name').val(specialValue);

                var city_display = city;
                var district_display = specialValue;

                var span_city_display = document.getElementById('display_current_city');
                var span_district_display = document.getElementById('display_current_district');

                span_city_display.textContent = '';
                span_district_display.textContent = '';

                span_city_display.innerHTML += city_display;
                span_district_display.innerHTML += district_display;

                $.ajax({
                    type: 'POST',
                    url: "{{ route('web.dashboard.change_location.createSession') }}",
                    data: {
                        city: city,
                        district: specialValue
                    },
                    success: function(data) {
                        // Handle the success response
                        console.log(data);
                    }
                });
            })

            $('#district_value').change(function() { //get city values
                var selected_value = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('web.dashboard.getCity') }}",
                    data: {
                        value: selected_value,
                    },
                    success: function(data) {
                        console.log(data);
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

            $('#vehicle_type').change(function() { // get brands values
                var selected_value = $(this).val();


                $.ajax({
                    type: 'POST',
                    url: "{{ route('web.dashboard.vehicle_type') }}",
                    data: {
                        value: selected_value,
                    },
                    success: function(data) {
                        console.log(data);
                        var brands_append = '';
                        $.each(data, function(index, row) {
                            if (row
                                .brand_name
                            ) { // Check if the name_en property is not empty
                                brands_append += '<option value="' + row.id +
                                    '">' +
                                    row.brand_name + '</option>';
                            }
                        });
                        $("#brands").html(brands_append);
                    }
                });
            });

            $('#brands').change(function() { // get models values
                var selected_value = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('web.dashboard.vehicle_model') }}",
                    data: {
                        value: selected_value,
                    },
                    success: function(data) {
                        console.log(data);
                        var model_append = '';
                        $.each(data, function(index, row) {
                            if (row
                                .model_name
                            ) { // Check if the name_en property is not empty
                                model_append += '<option value="' + row.id +
                                    '">' +
                                    row.model_name + '</option>';
                            }
                        });
                        $("#models").html(model_append);
                    }
                });
            });

        });
    </script>
@endsection
