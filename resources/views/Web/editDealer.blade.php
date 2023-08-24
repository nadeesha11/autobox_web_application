@extends('Web.Layout.Layout')
@section('content')
    <style>
        .container_update {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            text-align: center;
            padding: 20px;
        }

        .image-container {
            /* Your existing styles */
        }

        .detail {
            /* Your existing styles */
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
                        href="#">Edit Dealer Details</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container  container_update">

                <div class="card">
                    <div class="card-header">
                        <h5>Edit Dealer Details</h5>
                    </div>
                    <div class="card-body">
                        <div style="margin-bottom: 20px !important;" class="image-container ">
                            <a href="#">
                                <img style="height: 400px !important; width: 400px !important;"
                                    style="border-radius: 15px !important;"
                                    src="{{ asset('assets/myCustomThings/dealer/' . $dealerData->company_logo) }}"
                                    alt="Dealer Image">
                                <i onclick="editImage('{{ $dealerData->company_logo }}', 'company_logo')"
                                    class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="detail">
                            <p>
                                <strong>Company Name :</strong> {{ $dealerData->Company_Name }}
                                <i onclick="editCompany('{{ $dealerData->Company_Name }}', 'Company_Name')"
                                    class="fa fa-pencil" aria-hidden="true"></i>
                            </p>

                        </div>
                        <div class="detail">
                            <p><strong>Address :</strong> {{ $dealerData->address }} <i
                                    onclick="editCompany('{{ $dealerData->address }}', 'address')" class="fa fa-pencil"
                                    aria-hidden="true"></i></p>
                        </div>
                        <div class="detail">
                            <p><strong>Google Location :</strong> <a
                                    href="{{ $dealerData->google_location }}">{{ $dealerData->google_location }} </a> <i
                                    onclick="editCompany('{{ $dealerData->google_location }}', 'google_location')"
                                    class="fa fa-pencil" aria-hidden="true"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
                            <input type="hidden" value="{{ $dealerData->id }}" name="hidden_id">
                            <input type="hidden" id="hidden_single_type" name="hidden_single_type" class="clear_input">
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

    <!-- Modal -->
    <div class="modal fade" id="edit_image_single" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Edit Dealer Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="update_dealer">
                        <div class="mb-3">
                            <input type="hidden" value="{{ $dealerData->id }}" name="hidden_id">
                            <input type="hidden" id="hidden_image_type" name="hidden_single_type" class="clear_input">
                            <label id="change_title_input" class="form-label"></label>

                            <div class="col-md-12">
                                <input id="single_input_value" data-allowed-file-extensions="jpeg jpg png"
                                    data-max-file-size-preview="5M" name="image" class="dropify" type="file">
                            </div>
                            <span style="color:#ee2c1e" id="display_image_error" class="clear_form_error"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="update_dealer_btn" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop dealer here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

        });

        function editCompany(variableValue, fieldName) {
            $('.clear_form_error').html('');
            $('#single_input_value').val(variableValue)
            $('#hidden_single_type').val(fieldName)

            var modalTitle = document.getElementById("modal_title");
            var change_title_input = document.getElementById("change_title_input");
            modalTitle.textContent = "Change " + fieldName;
            change_title_input.textContent = fieldName;
            $('#edit_vendor_details_single').modal('show');

        }

        $('#change_single_data_btn').click(function() { // update dealer function
            document.getElementById("change_single_data_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var dealer = $('#update_single_values_form')[0];
            var dealer_ajax = new FormData(dealer); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('admin.dealer.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: dealer_ajax,
                success: function(response) {

                    $('#edit_vendor_details_single').modal('hide');
                    document.getElementById("change_single_data_btn").disabled = false;

                    if (response.code == "true") {

                        var dashboardIndexUrl = "{{ route('web.dashboard.becomeDealer.edit') }}";
                        window.location.href = dashboardIndexUrl;
                    }
                    if (response.code == "false") {
                        Swal.fire({
                            title: 'Error!',
                            icon: 'error',
                            text: response.msg,
                            confirmButtonText: 'OK'
                        })
                    }
                },
                error: function(error) {
                    document.getElementById("change_single_data_btn").disabled = false;
                    // display validations in created admin 
                    $('#display_input_error').html(error.responseJSON.errors.single_value);

                }
            });

        });

        $('#update_dealer_btn').click(function() { // update dealer function
            document.getElementById("update_dealer_btn").disabled = true;
            $('.clear_form_error').html('');

            // to get csrf
            var dealer_image = $('#update_dealer')[0];
            var dealer_image_ajax = new FormData(dealer_image); // get form data

            // ajax post start 
            $.ajax({
                url: "{{ route('admin.dealer.update') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: dealer_image_ajax,
                success: function(response) {
                    $('#edit_vendor_details_single').modal('hide');
                    document.getElementById("update_dealer_btn").disabled = false;

                    if (response.code == "true") {
                        var dashboardIndexUrl = "{{ route('web.dashboard.becomeDealer.edit') }}";
                        window.location.href = dashboardIndexUrl;
                    }
                    if (response.code == "false") {
                        Swal.fire({
                            title: 'Error!',
                            icon: 'error',
                            text: response.msg,
                            confirmButtonText: 'OK'
                        })
                    }
                },
                error: function(error) {
                    document.getElementById("update_dealer_btn").disabled = false;
                    // display validations in created admin 
                    $('#display_image_error').html(error.responseJSON.errors.image);

                }
            });

        });

        function editImage(variableValue, fieldName) {
            $('#edit_image_single').modal('show');
            $('#hidden_image_type').val(fieldName);
        }
    </script>
@endsection
