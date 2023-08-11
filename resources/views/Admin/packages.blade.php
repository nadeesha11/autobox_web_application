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
                <h2 class="content-title card-title">Packages</h2>
                <p>You can manage packages here</p>
            </div>
            <div>

            </div>
        </div>
        <!-- card end// -->
        <div class="row">
            <div class="card mb-4 col-3">
                <div class="card-header">
                    <h4>Create Record</h4>
                </div>
                <div class="card-body">
                    <form id="create_package_form">
                        <input type="hidden" name="category_id" value="{{ $id }}">
                        <div class="mb-4">
                            <label for="package_name" class="form-label">Package Name</label>
                            <input type="text" placeholder="Enter Here" name="package_name"
                                class="form-control clear_input" id="package_name" />
                            <span id="package_name_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="image_count" class="form-label">Image Count</label>
                            <input type="number" placeholder="Enter Here" name="image_count"
                                class="form-control clear_input" id="image_count" />
                            <span id="image_count_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="package_ad_count" class="form-label">Ad Count</label>
                            <input type="number" placeholder="Enter Here" name="package_ad_count"
                                class="form-control clear_input" id="package_ad_count" />
                            <span id="package_ad_count_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="topup_count" class="form-label">Topup Count</label>
                            <input type="number" placeholder="Enter Here" name="topup_count"
                                class="form-control clear_input" id="topup_count" />
                            <span id="topup_count_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="package_duration" class="form-label">Package Duration</label>
                            <input type="number" placeholder="Enter Here" name="package_duration"
                                class="form-control clear_input" id="package_duration" />
                            <span id="package_duration_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <div class="mb-4">
                            <label for="package_price" class="form-label">Package Price</label>
                            <input type="number" placeholder="Enter Here" name="package_price"
                                class="form-control clear_input" id="package_price" />
                            <span id="package_price_error" class="clear_form_error" style="color: red"></span>
                        </div>
                        <button id="create_package" class="btn custom-button">Create</button>
                    </form>
                </div>
            </div>
            <div class="col-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="packages" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Name</th>
                                            <th class="align-middle" scope="col">Image Count</th>
                                            <th class="align-middle" scope="col">Ads Count</th>
                                            <th class="align-middle" scope="col">TopAds Count</th>
                                            <th class="align-middle" scope="col">Duration</th>
                                            <th class="align-middle" scope="col">Price (Rs)</th>
                                            <th class="align-middle" scope="col">Status</th>
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
            <div class="modal fade" id="edit_package_form" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Package Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form id="update_package_form">
                                <input type="hidden" class="form-control " id="id_edit" name="package_hidden">
                                <div class="form-group mb-2">
                                    <label>Name </label>
                                    <input type="text" class="form-control clear_input" name="name"
                                        id="edit_name">
                                    <span id="edit_name_error" class="text-danger clear_form_error"></span>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Image Count </label>
                                    <input type="text" class="form-control clear_input" name="image_count"
                                        id="edit_image_count">
                                    <span id="edit_image_count_error" class="text-danger clear_form_error"></span>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Ads Count </label>
                                    <input type="text" class="form-control clear_input" name="ads_count"
                                        id="edit_ads_count">
                                    <span id="edit_ads_count_error" class="text-danger clear_form_error"></span>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Topup Ads </label>
                                    <input type="text" class="form-control clear_input" name="topup_ads"
                                        id="edit_topup_ads">
                                    <span id="edit_topup_ads_error" class="text-danger clear_form_error"></span>
                                </div>

                                <div class="form-group mb-2">
                                    <label>Ads Duration </label>
                                    <input type="text" class="form-control clear_input" name="package_duration"
                                        id="edit_package_duration">
                                    <span id="edit_package_duration_error" class="text-danger clear_form_error"></span>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Price (Rs) </label>
                                    <input type="text" class="form-control clear_input" name="package_price"
                                        id="edit_package_price">
                                    <span id="edit_package_price_error" class="text-danger clear_form_error"></span>
                                </div>
                                <hr>

                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="status" required
                                                id="status_edit" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">

                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_package_btn" class="btn btn-primary">Save changes</button>

                            </form>
                            {{-- form end   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}
            <script>
                $(document).ready(function() {

                    var category_id = {!! json_encode($id) !!};
                    console.log(category_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); //ajax setup


                    //  view data on table start 
                    $('#packages').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.packages.recieveData', ['id' => 'category_id_value']) !!}'.replace('category_id_value', category_id),


                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'package_name',
                                name: 'package_name'
                            },
                            {
                                data: 'image_count',
                                name: 'image_count'
                            },
                            {
                                data: 'package_ad_count',
                                name: 'package_ad_count'
                            },
                            {
                                data: 'topup_count',
                                name: 'topup_count'
                            },
                            {
                                data: 'package_duration',
                                name: 'package_duration'
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
                                data: 'action',
                                name: 'action'
                            },
                        ]

                    });

                    //  create project start 
                    $('#create_package').click(function() {
                        document.getElementById("create_package").disabled = true; //enable button after click it
                        $('.clear_form_error').html('');

                        // to get csrf
                        var create_brand_record = $('#create_package_form')[0];
                        var create_brand_record_ajax = new FormData(create_brand_record); // get form data

                        Swal.fire({
                            title: 'Please wait...',
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            }
                        });
                        // ajax post start 
                        $.ajax({
                            url: "{{ route('admin.package.create') }}",
                            method: "POST",
                            processData: false,
                            contentType: false,
                            data: create_brand_record_ajax,
                            success: function(response) {
                                document.getElementById("create_package").disabled =
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
                                $('#packages').DataTable().ajax.reload();

                            },

                            error: function(error) {
                                Swal.close(); // Close the SweetAlert
                                // display validations in created slider 
                                $('#image_count_error').html(error.responseJSON.errors.image_count);
                                $('#package_name_error').html(error.responseJSON.errors.package_name);
                                $('#package_ad_count_error').html(error.responseJSON.errors
                                    .package_ad_count);
                                $('#package_duration_error').html(error.responseJSON.errors
                                    .package_duration);
                                $('#package_price_error').html(error.responseJSON.errors.package_price);
                                $('#topup_count_error').html(error.responseJSON.errors.topup_count);
                                document.getElementById("create_package").disabled =
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
                        url: '{{ url('admin/Package') }}' + '/' + id + '/edit',
                        method: 'GET',
                        success: function(response) {
                            $('#id_edit').val(response.id);
                            $('#edit_name').val(response.package_name);
                            $('#edit_ads_count').val(response.package_ad_count);
                            $('#edit_package_duration').val(response.package_duration);
                            $('#edit_package_price').val(response.package_price);
                            $('#edit_topup_ads').val(response.topup_count);
                            $('#edit_image_count').val(response.image_count);

                            $('#edit_package_form').modal('show');
                            //start status of vehicle type 
                            if (response.status == 0) {
                                $('#status_edit').bootstrapToggle('off');
                            } else {
                                $('#status_edit').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                //    update data start   
                $('#update_package_btn').click(function() {

                    document.getElementById("update_package_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var update_package = $('#update_package_form')[0];
                    var update_package_ajax = new FormData(update_package); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.package.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: update_package_ajax,
                        success: function(response) {
                            $('#edit_package_form').modal('hide');
                            document.getElementById("update_package_btn").disabled = false;

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
                                    title: 'Error!',
                                    icon: 'info',
                                    text: response.msg,
                                    confirmButtonText: 'OK'
                                })
                            }
                            $('.clear_input').val('');
                            $('.clear_form_error').html('');
                            $('#packages').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_package_btn").disabled = false;
                            $('#edit_name_error').html(error.responseJSON.errors.name);
                            $('#edit_topup_ads_error').html(error.responseJSON.errors.topup_ads);
                            $('#edit_ads_count_error').html(error.responseJSON.errors.ads_count);
                            $('#edit_package_duration_error').html(error.responseJSON.errors.package_duration);
                            $('#edit_package_price_error').html(error.responseJSON.errors.package_price);
                            $('#edit_image_count_error').html(error.responseJSON.errors.image_count);

                        }
                    });
                });
                //    update data end 
            </script>



    </section>
@endsection
