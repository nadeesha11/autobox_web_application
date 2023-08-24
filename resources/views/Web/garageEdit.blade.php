@extends('Web.Layout.Layout')
@section('content')
    <style>
        .clear_form_error {
            color: red;
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
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="{{ route('web.dashboardIndex') }}"></a> Dashboard <span></span> <a href="#">
                        garage edit</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>Garage Edit</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <th width="30%;">Name</th>
                                            <td width="70%;">{{ $data->name }} <a href="#"
                                                    onclick="editDetails('Name','{{ $data->name }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a> </td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">City</th>
                                            <td width="70%;">{{ $data->city }} <a href="#"
                                                    onclick="editCity('City','{{ $data->city }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Number</th>
                                            <td width="70%;">+94 {{ $data->number }} <a href="#"><i
                                                        class="fa fa-pencil"
                                                        onclick="editDetailsPhone('Number','{{ $data->number }}'); "
                                                        aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Url</th>
                                            <td width="70%;"><a target="_blank" href=" {{ $data->url }}">
                                                    {{ $data->url }}</a> <a href="#"
                                                    onclick="editDetails('url','{{ $data->url }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a> </td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Address</th>
                                            <td width="70%;">{{ $data->address }} <a href="#"
                                                    onclick="editDetails2('Address','{{ $data->address }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Description</th>
                                            <td width="70%;">{{ $data->desc }} <a href="#"
                                                    onclick="editDetails2('Description','{{ $data->desc }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Image</th>
                                            <td width="70%;">

                                                <img style="height: 200px; width:200px;"
                                                    src="{{ asset('assets/myCustomThings/Garage/' . $data->image) }}"
                                                    alt=""> <a href="#"
                                                    onclick="editDetailsImage('Image','{{ $data->image }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="garage_more_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">More Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <p class="mb-2">Title : <span id="title_more_details"></span></p>
                        <p class="mb-2">Number : <span id="number_more_details"></span></p>
                        <p class="mb-2">City : <span id="city_more_details"></span></p>
                        <a class="mb-2" target="_blank" id="url_more_details" href="#">
                            <p style="color: rgb(8, 167, 88) ; text-decoration:underline;" id="url_more_details_text"></p>
                        </a>
                        <p class="mb-2">Address : <span id="address_more_details"></span></p>
                        <p class="mb-2">Description : <span id="desc_more_details"></span></p>
                        <img style="height: 300px; width:600px; object-fit:contain ;" id="img_more_details" src=""
                            alt="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit_garage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_form">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" id="hidden_single_type" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_input" class="form-label"></label>
                                <input type="text" name="input" style="border-color: #37B093 !important; "
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

        <!-- Modal -->
        <div class="modal fade" id="edit_garage2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title2">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_form2">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" id="hidden_single_type2" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_input2" class="form-label"></label>
                                <textarea id="single_input_value2" style="border-color: #37B093 !important;" name="input" cols="30"
                                    rows="10"></textarea>

                                <span style="color:#ee2c1e" id="display_input_error2" class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="change_single_data_btn2" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- Modal -->


        <!-- Modal -->
        <div class="modal fade" id="edit_garageCityModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title_for_city">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="city_form">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" id="hidden_single_type_city" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_type_for_city" class="form-label"></label>
                                <select name="input" id="cityEdit">
                                    <option value="">Choose City</option>
                                    @foreach ($cities as $item)
                                        <option value="{{ $item->name_en }}">{{ $item->name_en }}</option>
                                    @endforeach
                                </select>
                                <span style="color:#ee2c1e" id="change_garage_error" class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="change_city_btn" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->


        <div class="modal fade" id="edit_garage2" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title2">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_form2">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" id="hidden_single_type2" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_input2" class="form-label"></label>
                                <textarea id="single_input_value2" style="border-color: #37B093 !important;" name="input" cols="30"
                                    rows="10"></textarea>

                                <span style="color:#ee2c1e" id="display_input_error2" class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="change_single_data_btn2" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editDetailsPhoneModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title_phone">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_phone">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" id="hidden_single_type_phone" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_phone" class="form-label"></label>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+94</span>
                                    <input type="text" name="input" id="value_edit_phone"
                                        style="border-color: #37B093 !important; " class="form-control clear_input"
                                        placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>

                                <span style="color:#ee2c1e" id="display_input_phone_error"
                                    class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="change_single_data_phone" class="btn btn-primary">Save
                            changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editDetailsImageModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title_image">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_image">
                            <div class="mb-3">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" id="hidden_single_type_image" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_image" class="form-label"></label>
                                <div class="row">
                                    <div class="col-md-12 text-center">

                                        <img style="height: 200px !important; width:70% !important;" id="garage_image"
                                            src="" alt="">
                                    </div>
                                    <div class="col-md-12">
                                        <input id="image_edit" data-allowed-file-extensions="jpeg  jpg "
                                            data-max-file-size-preview="5M" name="input" class="dropify"
                                            type="file">
                                    </div>
                                </div>
                                <span style="color:#ee2c1e" id="display_input_image_error"
                                    class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="change_single_data_image_btn" class="btn btn-primary">Save
                            changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //ajax setup

        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a image here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        function editDetailsPhone(type, value) {

            $('.clear_input').val('');
            $('.clear_form_error').html('');

            $('#hidden_single_type_phone').val(type);
            $('#value_edit_phone').val(value);
            var modalTitle = document.getElementById("modal_title_phone");
            var change_title_input = document.getElementById("change_title_phone");
            modalTitle.textContent = "Change " + type;
            change_title_input.textContent = type;

            $('#editDetailsPhoneModal').modal('show');

        }

        function editDetailsImage(type, value) {
            var imageUrl = '/assets/myCustomThings/Garage/' + value;
            $('#garage_image').attr('src', imageUrl);
            $('.clear_input').val('');
            $('.clear_form_error').html('');

            $('#hidden_single_type_image').val(type);

            var modalTitle = document.getElementById("modal_title_image");
            var change_title_input = document.getElementById("change_title_image");
            modalTitle.textContent = "Change " + type;
            change_title_input.textContent = type;

            $('#editDetailsImageModal').modal('show');

        }

        function editDetails(type, value) {

            $('.clear_input').val('');
            $('.clear_form_error').html('');

            $('#hidden_single_type').val(type);
            $('#single_input_value').val(value);
            var modalTitle = document.getElementById("modal_title");
            var change_title_input = document.getElementById("change_title_input");
            modalTitle.textContent = "Change " + type;
            change_title_input.textContent = type;

            $('#edit_garage').modal('show');

        }

        function editDetails2(type, value) {

            $('.clear_input').val('');
            $('.clear_form_error').html('');

            $('#hidden_single_type2').val(type);
            $('#single_input_value2').val(value);
            var modalTitle = document.getElementById("modal_title2");
            var change_title_input = document.getElementById("change_title_input2");
            modalTitle.textContent = "Change " + type;
            change_title_input.textContent = type;

            $('#edit_garage2').modal('show');

        }

        function editCity(type, value) {

            $('.clear_input').val('');
            $('.clear_form_error').html('');

            $('#hidden_single_type_city').val(type);

            //change type for select 
            $('#cityEdit').val(value); // This will select the option with the specified value
            //change type for select 

            var modalTitle = document.getElementById("modal_title_for_city");
            var change_title_input = document.getElementById("change_title_type_for_city");
            modalTitle.textContent = "Change " + type;
            change_title_input.textContent = type;

            $('#edit_garageCityModal').modal('show');

        }

        $('#change_single_data_btn').click(function() {
            document.getElementById("change_single_data_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var form = $('#update_single_values_form')[0];
            var form_data = new FormData(form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.garage.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(response) {
                    console.log(response);
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
                        $('#edit_garage').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();
                    }
                },
                error: function(error) {
                    document.getElementById("change_single_data_btn").disabled = false;
                    $('#display_input_error').html(error.responseJSON.errors
                        .input);
                }
            });
        })

        $('#change_single_data_btn2').click(function() {
            document.getElementById("change_single_data_btn2").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var form2 = $('#update_single_values_form2')[0];
            var form_data2 = new FormData(form2); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.garage.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form_data2,
                success: function(response) {
                    console.log(response);
                    document.getElementById("change_single_data_btn2").disabled = false;
                    if (response.code === "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#edit_garage2').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();

                    }

                },
                error: function(error) {
                    document.getElementById("change_single_data_btn2").disabled = false;
                    $('#display_input_error2').html(error.responseJSON.errors
                        .input);

                }
            });
        })

        $('#change_city_btn').click(function() {
            document.getElementById("change_city_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var city_form = $('#city_form')[0];
            var city_form_city = new FormData(city_form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.garage.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: city_form_city,
                success: function(response) {
                    console.log(response);
                    document.getElementById("change_city_btn").disabled = false;
                    if (response.code === "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#edit_garage2').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();
                    }
                },
                error: function(error) {
                    document.getElementById("change_city_btn").disabled = false;
                    $('#change_garage_error').html(error.responseJSON.errors
                        .input);

                }
            });
        });

        $('#change_single_data_phone').click(function() {
            document.getElementById("change_single_data_phone").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var phone_form = $('#update_single_values_phone')[0];
            var phone_form_city = new FormData(phone_form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.garage.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: phone_form_city,
                success: function(response) {
                    console.log(response);
                    document.getElementById("change_single_data_phone").disabled = false;
                    if (response.code === "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#edit_garage2').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();
                    }
                },
                error: function(error) {
                    document.getElementById("change_single_data_phone").disabled = false;
                    $('#display_input_phone_error').html(error.responseJSON.errors
                        .input);

                }
            });
        })


        $('#change_single_data_image_btn').click(function() {
            document.getElementById("change_single_data_image_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var image_form = $('#update_single_values_image')[0];
            var image_form_data = new FormData(image_form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.garage.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: image_form_data,
                success: function(response) {
                    console.log(response);
                    document.getElementById("change_single_data_image_btn").disabled = false;
                    if (response.code === "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#editDetailsImageModal').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();
                    }
                },
                error: function(error) {
                    document.getElementById("change_single_data_image_btn").disabled = false;
                    $('#display_input_image_error').html(error.responseJSON.errors
                        .input);

                }
            });
        });
    </script>
@endsection
