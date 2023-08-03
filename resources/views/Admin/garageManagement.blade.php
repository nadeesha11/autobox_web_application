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

        .modal_color {
            color: black !important;
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
                                <table id="garage" class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle" scope="col">ID</th>
                                            <th class="align-middle" scope="col">Garage Name</th>
                                            <th class="align-middle" scope="col">Image</th>
                                            <th class="align-middle" scope="col">Status</th>
                                            <th class="align-middle" scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal start  --}}
            <div class="modal fade" id="more_garage_details_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Garage Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <p> <span class="modal_color">Located City</span> : <span id="Located_city"> </span> </p>
                                <p> <span class="modal_color">Phone Number</span> : <span id="Phone_Number_append"> </span>
                                </p>
                                <p> <span class="modal_color">Url</span> : <span id="Url_append"> </span> </p>
                                <p> <span class="modal_color">Address</span> : <span id="Address_append"> </span> </p>
                                <p> <span class="modal_color">Description</span> : <span id="Description_append"> </span>
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal  --}}

            {{-- modal start  --}}
            <div class="modal fade" id="edit_garage_details_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Garage Approvement</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="garage_approval_form">
                            <div class="modal-body">

                                <input type="hidden" name="id" id="hidden_id">
                                <div class="m-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="0" name="status"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Pending
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="1" name="status"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Approved
                                        </label>
                                    </div>

                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="garage_approval_btn" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </form>
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
                    $('#garage').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: '{!! route('admin.garage.recieveData') !!}',

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
                                data: 'deatils',
                                name: 'deatils'
                            },
                        ]
                    });
                });

                $('body').on('click', '.more', function() {

                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/garageManagement') }}' + '/' + id + '/more',
                        method: 'GET',
                        success: function(response) {
                            // console.log(response)
                            $('#Located_city').text(response.city);
                            $('#Phone_Number_append').text('+94' + response.number);
                            $('#Url_append').text(response.url);
                            $('#Address_append').text(response.address);
                            $('#Description_append').text(response.desc);
                            $('#more_garage_details_modal').modal('show');

                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                $('body').on('click', '.edit', function() {
                    var id = $(this).data('id');
                    $.ajax({
                        url: '{{ url('admin/garageManagement') }}' + '/' + id + '/more',
                        method: 'GET',
                        success: function(response) {
                            $('#hidden_id').val(response.id)
                            // Assume you have a JavaScript variable 'statusValue' that holds the desired status value
                            var statusValue =
                                response
                                .status; // For example, set it to 1 for New Inquery, 2 for InProgress Inquery, 3 for Done

                            // Get the radio button elements by their IDs
                            var radioNewInquery = document.getElementById("flexRadioDefault1");
                            var radioInProgress = document.getElementById("flexRadioDefault2");


                            // Check the appropriate radio button based on 'statusValue'
                            if (statusValue === 0) {
                                radioNewInquery.checked = true;
                            } else if (statusValue === 1) {
                                radioInProgress.checked = true;
                            }
                            $('#edit_garage_details_modal').modal('show');
                        },
                        error: function(error) {}
                    });
                    // ajax code end
                });

                $('#garage_approval_btn').click(function() {
                    document.getElementById("garage_approval_btn").disabled = true;
                    $('.clear_form_error').html('');

                    // to get csrf
                    var update_garage = $('#garage_approval_form')[0];
                    var update_garage_ajax = new FormData(update_garage); // get form data

                    // ajax post start 
                    $.ajax({
                        url: "{{ route('admin.garage.update') }}",
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data: update_garage_ajax,
                        success: function(response) {
                            $('#edit_garage_details_modal').modal('hide');
                            document.getElementById("garage_approval_btn").disabled = false;
                            console.log(response);
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
                            $('#garage').DataTable().ajax.reload();
                        },
                        error: function(error) {


                        }
                    });

                })
            </script>



    </section>
@endsection
