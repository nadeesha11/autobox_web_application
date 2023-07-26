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

        .addColorToIcon {
            color: #20a10f !important;
        }

        .img-rounded {
            border-radius: 90px !important;
            object-fit: fill !important;
            height: 10px !important;
            width: 10px !important;
        }
    </style>
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Users Management</h2>
                <p>You can manage users here</p>
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
                                <table id="users" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">User Name</th>
                                            <th class="align-middle" scope="col">Image</th>
                                            <th class="align-middle" scope="col">Status</th>
                                            <th class="align-middle" scope="col">Position</th>
                                            <th class="align-middle" scope="col">Details</th>

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
                                            <span id="vehicle_types_edit_error" class="text-danger clear_form_error"></span>
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
                    $('#users').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.users.recieveData') !!}',

                        columns: [{
                                data: 'id',
                                name: 'id'
                            },
                            {
                                data: 'name',
                                name: 'name'
                            },
                            {
                                data: 'image',
                                name: 'image'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'position',
                                name: 'position'
                            },
                            {
                                data: 'deatils',
                                name: 'deatils'
                            },

                        ]

                    });

                });

                $('body').on('click', '.more', function() {

                    var id = $(this).data('id');
                    var url = '/admin/users/more/' + id;
                    window.location.href = url;


                });
            </script>



    </section>
@endsection
