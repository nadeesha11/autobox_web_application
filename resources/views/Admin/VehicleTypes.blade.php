@extends('Admin.Layout.layout')
@section('section')
    <style>
        /* Custom button style */
        .custom-button {
            background-color: #0e920e;
            /* Green background color */
            color: #FFFFFF;
            /* White text color */
            border-radius: 10px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Padding around the text */
            font-size: 16px;
            /* Font size */
            transition: background-color 0.3s ease;
            /* Transition for click effect */
        }

        /* Click effect */
        .custom-button:hover {
            background-color: #6fda6f;
            /* Darker green background color on hover */
            cursor: pointer;
            /* Change cursor to pointer on hover */
        }
    </style>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Vehicle Types</h2>
                <p>You can manage vehicle types here</p>
            </div>
            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->
        <div class="row">
            <div class="card mb-4 col-3">
                <div class="card-header">
                    <h4>Create Record</h4>
                </div>
                <div class="card-body">
                    <form id="create_vehicle_record">
                        <div class="mb-4">
                            <label for="product_name" class="form-label">Vehicle Type Name</label>
                            <input type="text" placeholder="Enter Here" name="Vehicle_Type_Name"
                                class="form-control clear_input" id="Vehicle_Type_Name" />
                            <span id="Vehicle_Type_Name_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="product_name" class="form-label">Vehicle Type Icon</label>
                            <input type="file" class="form-control input clear_input dropify" data-height="95"
                                name="Vehicle_Type_Icon" id="Vehicle_Type_Icon"
                                data-allowed-file-extensions="jpeg png jpg gif" placeholder="Slider Image">
                            <span class="clear_form_error" style="color: red" id="Vehicle_Type_Icon_error"></span>
                        </div>
                        <button id="create_record" class="btn custom-button">Create</button>
                    </form>
                </div>
            </div>
            <div class="col-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="vehicle_types" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Name</th>
                                            <th class="align-middle" scope="col">Status</th>
                                            <th class="align-middle" scope="col">Image</th>
                                            <th class="align-middle" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- table-responsive end// -->
                    </div>
                </div>
            </div>

            {{-- modal start  --}}
            <div class="modal fade" id="edit_vehicle_type" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Vehicle Type Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form id="update_vehicle_form">

                                <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                                <div class="form-group">
                                    <label>Name </label>
                                    <input type="text" class="form-control clear_input" name="name" id="edit_name">
                                    <span id="edit_name_error" class="text-danger clear_form_error"></span>
                                </div>


                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <label class="mb-1 text-center">Vehicle Type Image</label>
                                    <hr>
                                    <div class="col-6">
                                        <label class="mb-1"></label>
                                        <div class="form-group" id="dropify_image">
                                            <input type="file" data-height="110"
                                                class="form-control input clear_input dropify " name="vehicle_image_"
                                                id="vehicle_image_edit" data-allowed-file-extensions="jpeg png jpg gif"
                                                data-max-file-size-preview="5M">
                                            <span id="vehicle_types_edit_error" class="text-danger clear_form_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>(Current Image)</label>
                                        <div id="display_image_edit">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="vehicleTypeEdit" required
                                                id="vehicleTypeEdit" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">
                                            <span id="vehicle_types_edit_error"
                                                class="text-danger clear_form_error"></span>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_vehicle_types_btn" class="btn btn-primary">Save
                                changes</button>

                            </form>
                            {{-- form end   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}

            <!-- card end// -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
                integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
                crossorigin="anonymous" referrerpolicy="no-referrer" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
                integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            <script>
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); //ajax setup

                    //  view data on table start 
                    $('#vehicle_types').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.vehicleTypes.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'vt_name',
                                name: 'vt_name'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'image',
                                name: 'image'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]

                    });
                    $('.dropify').dropify({
                        messages: {
                            'default': 'Drag and drop a Image here or click',
                            'replace': 'Drag and drop or click to replace',
                            'remove': 'Remove',
                            'error': 'Ooops, something wrong happended.'
                        }
                    }); //add dropify to image

                    //  create project start 
                    $('#create_record').click(function() {
                        document.getElementById("create_record").disabled = true; //enable button after click it
                        $('.clear_form_error').html('');

                        // to get csrf
                        var create_vehicle_record = $('#create_vehicle_record')[0];
                        var create_vehicle_record_ajax = new FormData(create_vehicle_record); // get form data

                        Swal.fire({
                            title: 'Please wait...',
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        // ajax post start 
                        $.ajax({
                            url: "{{ route('admin.vehicleType.create') }}",
                            method: "POST",
                            processData: false,
                            contentType: false,
                            data: create_vehicle_record_ajax,
                            success: function(response) {
                                document.getElementById("create_record").disabled =
                                    false; //enable button after click it
                                var drEvent = $('.dropify').dropify();
                                drEvent = drEvent.data('dropify');
                                drEvent.resetPreview();
                                drEvent.clearElement();

                                if (response.code == "true") {

                                    Swal.fire({
                                        title: 'Success!',
                                        icon: 'success',
                                        text: response.msg,
                                        confirmButtonText: 'OK'
                                    })
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
                                $('#vehicle_types').DataTable().ajax.reload();

                            },

                            error: function(error) {
                                Swal.close(); // Close the SweetAlert
                                // display validations in created slider 
                                $('#Vehicle_Type_Icon_error').html(error.responseJSON.errors
                                    .Vehicle_Type_Icon);
                                $('#Vehicle_Type_Name_error').html(error.responseJSON.errors
                                    .Vehicle_Type_Name);
                                document.getElementById("create_record").disabled =
                                    false; //enable button after click it
                            }
                        });
                    });
                    //create slider end
                });

                $('body').on('click', '.edit', function() {

                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/vehicleTypes') }}' + '/' + id + '/edit',
                        method: 'GET',
                        success: function(response) {
                            console.log(response)
                            $('#update_id').val(response.id);
                            $('#edit_name').val(response.vt_name);
                            $('#edit_vehicle_type').modal('show');
                            var display_image = document.getElementById('display_image_edit');
                            var img = '';
                            img +=
                                '<img  style="height:15vh; width:100%;  object-fit: contain;" src="{{ asset('/assets/myCustomThings/new_vehicle_image/') }}/' +
                                response.vt_icon + '" alt="">';
                            display_image.innerHTML = img;
                            //start status of vehicle type 
                            if (response.vt_status == 0) {
                                $('#vehicleTypeEdit').bootstrapToggle('off');
                            } else {
                                $('#vehicleTypeEdit').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                //    update data start   
                $('#update_vehicle_types_btn').click(function() {
                    document.getElementById("update_vehicle_types_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var vehicle_type = $('#update_vehicle_form')[0];
                    var vehicle_type_ajax = new FormData(vehicle_type); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.vehicleTypes.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: vehicle_type_ajax,
                        success: function(response) {
                            $('#edit_vehicle_type').modal('hide');
                            document.getElementById("update_vehicle_types_btn").disabled = false;
                            var drEvent = $('#vehicle_image_edit').dropify();
                            drEvent = drEvent.data('dropify');
                            drEvent.resetPreview();
                            drEvent.clearElement();

                            if (response.code == "true") {

                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            if (response.code == "false") {

                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            $('.clear_input').val('');
                            $('.clear_form_error').html('');
                            $('#vehicle_types').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_vehicle_types_btn").disabled = false;
                            // display validations in created admin 
                            $('#edit_name_error').html(error.responseJSON.errors.name);
                            $('#vehicle_types_edit_error').html(error.responseJSON.errors.vehicle_image_);
                        }
                    });
                });
                //    update data end 

                $('body').on('click', '.add_brands', function() {

                    var id = $(this).data('id');
                    let url = '{{ url('admin/vehicleTypes/nextPage') }}' + '/' + id;
                    location.href = url;


                });
            </script>



    </section>
@endsection
