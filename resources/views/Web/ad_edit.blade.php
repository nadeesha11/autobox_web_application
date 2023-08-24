@extends('Web.Layout.Layout')
@section('content')
    <style>
        .content-container {
            position: relative;
            background-color: rgba(223, 219, 219, 0.8) !important;
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
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="{{ route('web.dashboardIndex') }}">Dashboard</a> <span></span> <a
                        href="{{ route('vendor.dashboard.adsmanagement') }}">ads</a> <span></span>
                    <a href="#">edit</a>
                </div>
            </div>
        </div>
        <!-- Check for delete_success message -->
        @if (session('delete_success'))
            <div class="alert alert-success">
                {{ session('delete_success') }}
            </div>
        @endif

        <!-- Check for delete_error message -->
        @if (session('delete_error'))
            <div class="alert alert-danger">
                {{ session('delete_error') }}
            </div>
        @endif
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;">Edit Post</h5>
                    </div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <td>
                                    <p style="color: #000000 !important;">Title :</p> <br> {{ $ad_edit->ad_title }} <a
                                        onclick="editmodal('Title','{{ $ad_edit->ad_title }}')" class="ml-2"
                                        href="#">edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color: #000000 !important;">Ad Price :</p> <br> Rs .{{ $ad_edit->ad_price }}
                                    <a onclick="editmodal('Price','{{ $ad_edit->ad_price }}')" class="ml-2"
                                        href="#">edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color: #000000 !important;">Description :</p> <br> <span id="adDescription">
                                        {!! $ad_edit->ad_description !!}</span> <a class="ml-2"
                                        onclick="editDescription('Description',document.getElementById('adDescription').innerHTML)"
                                        href="#">edit</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="color: #000000 !important;">Condition : </p><br> {{ $ad_edit->ads_condition }}
                                    <a class="ml-2" onclick="editCondition('Condition','{{ $ad_edit->ads_condition }}')"
                                        href="#">edit</a>
                                </td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>Image</td>
                                <td>Action</td>
                            </tr>
                            @foreach ($ad_images as $images)
                                <tr>
                                    <td style="text-align: center !important;"> <img
                                            style="height: 200px !important; width:200px !important; border-radius: 5px;"
                                            src=" {{ asset('assets/myCustomThings/vehicleTypes/' . $images->name) }}"
                                            alt=""> </td>
                                    <td>
                                        <a onclick="editImage('{{ $images->name }}','{{ $images->id }}')"
                                            href="#">edit</a>
                                        {{-- <a style="color:#ee2c1e;"
                                            href="{{ route('web.dashboard.ad.delete', ['id' => $images->id]) }}"
                                            onclick="return confirm('Are you sure you want to delete this image?')">delete</a> --}}

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    {{-- @if ($available_images > 0)
                        <form method="post" action="{{ route('web.dashboard.ad.addNewImage') }}" class="text-left">
                            @csrf
                            <input type="text" name="ad_id" value="{{ $id }}">
                            <div class="form-group row m-2">
                                @for ($i = $available_images; $i >= 1; $i--)
                                    <div class=" col-md-4 col-sm-12">
                                        <div class="m-3">
                                            <input id="image_{{ $i }}" data-allowed-file-extensions="jpeg  jpg"
                                                data-max-file-size-preview="5M" name="image_{{ $i }}"
                                                class="dropify" type="file">
                                            <span class="clear_form_error" id="image_{{ $i }}_error"></span>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <button class="btn m-4" type="submit">Add
                                Images</button>
                        </form>
                    @endif --}}
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="edit_ad_single" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_form">
                            <div class="mb-3">
                                <input type="hidden" id="image_edit_id" value="{{ $id }}" name="id"
                                    class="clear_input">
                                <input type="hidden" id="hidden_single_type" name="hidden_single_type" class="clear_input">
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

        <!-- Modal for desc-->
        <div class="modal fade" id="edit_textarea_single_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title_desc">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_textarea_form">
                            <div class="mb-3">
                                <input type="hidden" id="id" value="{{ $id }}" name="id"
                                    class="clear_input">
                                <input type="hidden" id="hidden_single_type_edit" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_input_desc" class="form-label"></label>

                                <textarea name="input" id="" cols="30" rows="40" style="border-color: #37B093 !important; "
                                    class="clear_input summernote desc" id="single_input_value"></textarea>

                                <span style="color:#ee2c1e" id="display_input_error_details"
                                    class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="update_textarea_btn" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for desc-->
        <div class="modal fade" id="edit_condition_single_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title_condition">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_condition_form">
                            <div class="mb-3">
                                <input type="hidden" id="id" value="{{ $id }}" name="id"
                                    class="clear_input">
                                <input type="hidden" id="hidden_single_type_con" name="hidden_single_type"
                                    class="clear_input">
                                <label id="change_title_input_condition" class="form-label"></label>
                                <div class="form-group col-lg-12">
                                    <div class="custom_select">
                                        <select id="condition_" name="input" style="height: 62px !important;"
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
                                <span style="color:#ee2c1e" id="display_input_error_details"
                                    class="clear_form_error"></span>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="update_condition_btn" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for image-->
        <div class="modal fade" id="edit_image_single_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title_condition">Edit Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_image_form">
                            <div class="row">
                                <input type="hidden" name="id" id="image_edit_id_single">
                                <div class="col-md-12 col-lg-12 col-sm-12">
                                    <input id="image_edit_update" data-allowed-file-extensions="jpeg  jpg "
                                        data-max-file-size-preview="1M" name="image_edit_update" class="dropify"
                                        type="file">
                                    <span style="color: #ee2c1e;" class="clear_form_error"
                                        id="image_edit_update_error"></span>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="update_image_btn" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>


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
        $(document).ready(function() {
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

        });

        function editmodal(input_type, value) {
            $('.clear_form_error').html('');
            $('#single_input_value').val(value)
            $('#hidden_single_type').val(input_type)

            var modalTitle = document.getElementById("modal_title");
            var change_title_input = document.getElementById("change_title_input");
            modalTitle.textContent = "Change " + input_type;
            change_title_input.textContent = input_type;
            $('#edit_ad_single').modal('show');
        }

        function editDescription(input_type, value) {
            $('.desc').summernote({
                height: 200, // Adjust the height of the editor as needed
                focus: true, // Set focus on the editor when the modal is opened
                toolbar: []
            }).summernote('code', value); // Set the content

            $('.clear_form_error').html('');
            $('#hidden_single_type_edit').val(input_type)

            var modalTitle = document.getElementById("modal_title_desc");
            var change_title_input = document.getElementById("change_title_input_desc");
            modalTitle.textContent = "Change " + input_type;
            change_title_input.textContent = input_type;
            $('#edit_textarea_single_modal').modal('show');
        }


        function editCondition(input_type, value) {

            $('.clear_form_error').html('');
            $('#hidden_single_type_con').val(input_type)

            var modalTitle = document.getElementById("modal_title_condition");
            var change_title_input = document.getElementById("change_title_input_condition");
            modalTitle.textContent = "Change " + input_type;
            change_title_input.textContent = input_type;
            $('#edit_condition_single_modal').modal('show');
        }

        $('#change_single_data_btn').click(function() {
            document.getElementById("change_single_data_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var form = $('#update_single_values_form')[0];
            var form_data = new FormData(form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.dashboard.ad.update') }}",
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
                        $('#edit_ad_single').modal('hide');

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

        $('#update_textarea_btn').click(function() {
            console.log("this is text area");
            document.getElementById("update_textarea_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var form = $('#update_textarea_form')[0];
            var form_data = new FormData(form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.dashboard.ad.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(response) {

                    document.getElementById("update_textarea_btn").disabled = false;
                    if (response.code === "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#edit_ad_single').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();

                    }

                    console.log(response);
                },
                error: function(error) {
                    document.getElementById("update_textarea_btn").disabled = false;
                    $('#display_input_error_details').html(error.responseJSON.errors
                        .input);

                }
            });
        })

        $('#update_condition_btn').click(function() {
            document.getElementById("update_condition_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var form = $('#update_condition_form')[0];
            var form_data = new FormData(form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.dashboard.ad.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(response) {
                    document.getElementById("update_condition_btn").disabled = false;
                    if (response.code === "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#edit_ad_single').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();

                    }
                },
                error: function(error) {
                    document.getElementById("update_condition_btn").disabled = false;
                    $('#condition_error').html(error.responseJSON.errors
                        .input);

                }
            });
        })

        $('#update_image_btn').click(function() {

            document.getElementById("update_image_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var form = $('#update_image_form')[0];
            var form_data = new FormData(form); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('web.dashboard.ad.imageEdit') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: form_data,
                success: function(response) {
                    document.getElementById("update_image_btn").disabled = false;
                    if (response.code === "false") {
                        Swal.fire({
                            title: 'Error!',
                            text: response.msg,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        }) //display error msg

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        $('#edit_ad_single').modal('hide');

                    } else {
                        // Refresh the page
                        location.reload();

                    }
                },
                error: function(error) {
                    document.getElementById("update_image_btn").disabled = false;
                    $('#image_edit_update_error').html(error.responseJSON.errors
                        .image_edit_update);

                }
            });
        })

        function editImage(imageName, imageId) {

            $('#edit_image_single_modal').modal('show')
            $('#image_edit_id_single').val(imageId)

        }
    </script>
@endsection
