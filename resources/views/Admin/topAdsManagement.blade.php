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
                <h2 class="content-title card-title">Top ad packages Management</h2>
                <p>You can manage top ad packages here</p>
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
                    <form id="create_top_ad_form">
                        <div class="mb-4">
                            <label for="package_name" class="form-label">Package Name</label>
                            <input type="text" placeholder="Enter Here" name="package_name"
                                class="form-control clear_input" id="package_name" />
                            <span id="package_name_error" class="clear_form_error" style="color: red"></span>
                        </div>

                        <div class="mb-4">
                            <label for="package_name" class="form-label">Package Price</label>
                            <input type="text" placeholder="Enter Here" name="package_price"
                                class="form-control clear_input" id="package_price" />
                            <span id="package_price_error" class="clear_form_error" style="color: red"></span>
                        </div>

                        <div class="mb-4">
                            <label for="ads_count" class="form-label">Ad amount</label>
                            <input type="number" placeholder="Enter Here" name="ads_count" class="form-control clear_input"
                                id="ads_count" />
                            <span class="clear_form_error" style="color: red" id="ads_count_error"></span>
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
                                <table id="top_ad_types" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Name</th>
                                            <th class="align-middle" scope="col">Price</th>
                                            <th class="align-middle" scope="col">Status</th>
                                            <th class="align-middle" scope="col">Count</th>
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
            <div class="modal fade" id="top_ad_types_edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                            <form id="update_topads_form">

                                <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                                <div class="form-group">
                                    <label>Name </label>
                                    <input type="text" class="form-control clear_input" name="name" id="edit_name">
                                    <span id="edit_name_error" class="text-danger clear_form_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Price </label>
                                    <input type="text" class="form-control clear_input" name="price" id="price_edit">
                                    <span id="price_edit_error" class="text-danger clear_form_error"></span>
                                </div>
                                <div class="form-group">
                                    <label>Count </label>
                                    <input type="text" class="form-control clear_input" name="count"
                                        id="count_edit">
                                    <span id="count_edit_error" class="text-danger clear_form_error"></span>
                                </div>

                                <hr>

                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="status" required
                                                id="top_ads_status_edit" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">
                                            <span id="top_ads_status_edit_error"
                                                class="text-danger clear_form_error"></span>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_topad_btn" class="btn btn-primary">Save
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
                    $('#top_ad_types').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.topads.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'package_name',
                                name: 'package_name'
                            },
                            {
                                data: 'package_price',
                                name: 'package_price'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'count',
                                name: 'count'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ]

                    });


                    //  create project start 
                    $('#create_record').click(function() {
                        document.getElementById("create_record").disabled = true; //enable button after click it
                        $('.clear_form_error').html('');

                        // to get csrf
                        var create_top_ad_form = $('#create_top_ad_form')[0];
                        var create_top_ad_form_ajax = new FormData(create_top_ad_form); // get form data

                        Swal.fire({
                            title: 'Please wait...',
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        // ajax post start 
                        $.ajax({
                            url: "{{ route('admin.topAdsManagement.create') }}",
                            method: "POST",
                            processData: false,
                            contentType: false,
                            data: create_top_ad_form_ajax,
                            success: function(response) {
                                document.getElementById("create_record").disabled =
                                    false; //enable button after click it
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
                                $('#top_ad_types').DataTable().ajax.reload();

                            },

                            error: function(error) {
                                Swal.close(); // Close the SweetAlert
                                // display validations in created slider 
                                $('#package_name_error').html(error.responseJSON
                                    .errors
                                    .package_name);

                                $('#ads_count_error').html(error.responseJSON.errors
                                    .ads_count);
                                $('#package_price_error').html(error.responseJSON.errors
                                    .package_price);
                                document.getElementById("create_record").disabled =
                                    false; //enable button after click it
                            }
                        });
                    });
                    //create slider end
                });

                $('body').on('click', '.edit', function() {
                    $('.clear_form_error').html('');

                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/topAdsManagement') }}' + '/' + id + '/edit',
                        method: 'GET',
                        success: function(response) {

                            $('#update_id').val(response.id);
                            $('#edit_name').val(response.package_name);
                            $('#count_edit').val(response.count);
                            $('#price_edit').val(response.package_price);
                            $('#top_ad_types_edit_modal').modal('show');

                            //start status of vehicle type 
                            if (response.status == 0) {
                                $('#top_ads_status_edit').bootstrapToggle('off');
                            } else {
                                $('#top_ads_status_edit').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                //    update data start   
                $('#update_topad_btn').click(function() {
                    document.getElementById("update_topad_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var update_topads_form_ = $('#update_topads_form')[0];
                    var update_topads_form__ajax = new FormData(update_topads_form_); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.topAds.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: update_topads_form__ajax,
                        success: function(response) {
                            $('#top_ad_types_edit_modal').modal('hide');
                            document.getElementById("update_topad_btn").disabled = false;
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
                            $('#top_ad_types').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_topad_btn").disabled = false;

                            $('#edit_name_error').html(error.responseJSON.errors.name);
                            $('#count_edit_error').html(error.responseJSON.errors.count);
                            $('#price_edit_error').html(error.responseJSON.errors.price);
                        }
                    });
                });
                //    update data end 
            </script>
    </section>
@endsection
