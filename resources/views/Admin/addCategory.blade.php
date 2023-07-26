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
                <h2 class="content-title card-title">Ad Categories</h2>
                <p>You can manage ad categories here</p>
            </div>
            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->
        <div class="row">

            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="ads_category" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Name</th>

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
            <div class="modal fade" id="edit_addCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Ads Category</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{-- form start   --}}
                            <form id="ads_category_edit_form">

                                <input type="hidden" class="form-control clear_input" name="id" id="update_id">
                                <div class="form-group">
                                    <label>Category Name </label>
                                    <input type="text" class="form-control clear_input" name="Category_name"
                                        id="Category_name_edit">
                                    <span id="Category_name_edit_error" class="text-danger clear_form_error"></span>
                                </div>


                                <hr>

                                <div class="row">
                                    <hr style="margin-top: 8px !important;">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="checkbox" class="mr-2" name="status" required
                                                id="ads_category_status" data-toggle="toggle" data-on="Active"
                                                data-off="Deactive" data-onstyle="success" data-offstyle="danger"
                                                data-width="200" data-height="30">
                                            <span id="ads_category_status_error"
                                                class="text-danger clear_form_error"></span>
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="update_ads_category_btn" class="btn btn-primary">Save
                                changes</button>

                            </form>
                            {{-- form end   --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}
            <script>
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }); //ajax setup

                    //  view data on table start 
                    $('#ads_category').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.ads_category.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'package_category_name',
                                name: 'package_category_name'
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


                });

                $('body').on('click', '.edit', function() {

                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/addCategory') }}' + '/' + id + '/edit',
                        method: 'GET',
                        success: function(response) {

                            $('#update_id').val(response.id);
                            $('#Category_name_edit').val(response.package_category_name);
                            $('#edit_addCategory').modal('show');

                            //start status of vehicle type 
                            if (response.status == 0) {
                                $('#ads_category_status').bootstrapToggle('off');
                            } else {
                                $('#ads_category_status').bootstrapToggle('on');
                            }
                            //end status of vehicle type  
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                //    update data start   
                $('#update_ads_category_btn').click(function() {
                    document.getElementById("update_ads_category_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var ads_category_edit = $('#ads_category_edit_form')[0];
                    var ads_category_edit_ajax = new FormData(ads_category_edit); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.addCategory.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: ads_category_edit_ajax,
                        success: function(response) {
                            $('#edit_addCategory').modal('hide');
                            document.getElementById("update_ads_category_btn").disabled = false;

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
                            $('#ads_category').DataTable().ajax.reload();
                        },
                        error: function(error) {
                            document.getElementById("update_ads_category_btn").disabled = false;
                            // display validations in created admin 
                            $('#Category_name_edit_error').html(error.responseJSON.errors
                                .Category_name);
                            $('#Ads_image_count_edit_error').html(error.responseJSON.errors
                                .Ads_image_count_edit);
                        }
                    });
                });
                //    update data end 

                $('body').on('click', '.add_packages', function() {

                    var id = $(this).data('id');

                    let url = '{{ url('admin/adsCategory/nextPage') }}' + '/' + id;
                    location.href = url;


                });
            </script>



    </section>
@endsection
