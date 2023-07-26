@extends('Web.Layout.Layout')
@section('content')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Dashboard <span></span> Become Dealer
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">

                <div class="card">
                    <div class="card-header">
                        <h5>Become Dealer</h5>
                    </div>
                    <div class="card-body">

                        <form id="become_dealer_form">
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-12 ">
                                    <input name="company_logo" type="file" class="dropify" data-height="200" />
                                    <span class="text-danger clear_form_error" id="company_logo_error"></span>
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <input class="form-control" value="" placeholder="Company Name *"
                                        name="Company_Name" type="text" />
                                    <span class="text-danger clear_form_error" id="company_name_error"></span>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <input value="" class="form-control" placeholder="Dealer License Number*"
                                        name="Dealer_License_number" />
                                    <span class="text-danger clear_form_error" id="Dealer_License_number_error"></span>
                                </div>

                                <div class="form-group col-md-6 col-lg-6">
                                    <select name="dealer_location" style="height: 63px;"
                                        class="form-select form-select mb-3" aria-label=".form-select-lg example">
                                        <option value="" selected>Open this select menu</option>
                                        @foreach ($cities as $item)
                                            <option value="{{ $item->name_en }}">{{ $item->name_en }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger clear_form_error" id="dealer_location_error"></span>
                                </div>

                                <div style=" padding: 10px !important; ">
                                    <div
                                        style="border: rgba(233, 225, 225, 0.986) 1px solid; padding: 10px !important;  border-radius: 5px;">
                                        <p>Opening hours</p>
                                        <div class="row">
                                            <div class="form-group row">
                                                <div
                                                    class="col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <label for="Company_Name" class="col-form-label">Monday *</label>
                                                </div>

                                                <div
                                                    class="chek-form col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="Monday_checkbox" id="Monday_checkbox" value="">
                                                        <label class="form-check-label"
                                                            for="Monday_checkbox"><span>Closed</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="08:30" name="monday_open_hour"
                                                        type="time" />
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="17:30" name="monday_open_hour"
                                                        type="time" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div
                                                    class="col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <label for="Company_Name" class="col-form-label">Tuesday *</label>
                                                </div>

                                                <div
                                                    class="chek-form col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="Tuesday_checkbox" id="Tuesday_checkbox" value="">
                                                        <label class="form-check-label"
                                                            for="Tuesday_checkbox"><span>Closed</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="08:30" name="Tuesday_opening"
                                                        type="time" />
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="17:30" name="Tuesday_close"
                                                        type="time" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div
                                                    class="col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <label for="Company_Name" class="col-form-label">Wednesday *</label>
                                                </div>

                                                <div
                                                    class="chek-form col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="Wednesday_checkbox" id="Wednesday_checkbox"
                                                            value="">
                                                        <label class="form-check-label"
                                                            for="Wednesday_checkbox"><span>Closed</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="08:30" name="Wednesday_open"
                                                        type="time" />
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="17:30" name="Wednesday_close"
                                                        type="time" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div
                                                    class="col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <label for="Company_Name" class="col-form-label">Thursday *</label>
                                                </div>

                                                <div
                                                    class="chek-form col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="Thursday_checkbox" id="Thursday_checkbox"
                                                            value="">
                                                        <label class="form-check-label"
                                                            for="Thursday_checkbox"><span>Closed</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="08:30" name="Thursday_open"
                                                        type="time" />
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="17:30" name="Thursday_close"
                                                        type="time" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div
                                                    class="col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <label for="Company_Name" class="col-form-label">Friday *</label>
                                                </div>

                                                <div
                                                    class="chek-form col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="Friday_checkbox" id="Friday_checkbox" value="">
                                                        <label class="form-check-label"
                                                            for="Friday_checkbox"><span>Closed</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="08:30" name="Friday_open"
                                                        type="time" />
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="17:30" name="Friday_close"
                                                        type="time" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div
                                                    class="col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <label for="Company_Name" class="col-form-label">Saturday *</label>
                                                </div>

                                                <div
                                                    class="chek-form col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" checked type="checkbox"
                                                            name="Saturday_checkbox" id="Saturday_checkbox"
                                                            value="">
                                                        <label class="form-check-label"
                                                            for="Saturday_checkbox"><span>Closed</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="" name="Saturday_open"
                                                        type="time" />
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="" name="Saturday_close"
                                                        type="time" />
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div
                                                    class="col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <label for="Company_Name" class="col-form-label">Sunday *</label>
                                                </div>

                                                <div
                                                    class="chek-form col-md-2 col-lg-2 d-flex align-items-center justify-content-center">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" checked type="checkbox"
                                                            name="Sunday_checkbox" id="Sunday_checkbox" value="">
                                                        <label class="form-check-label"
                                                            for="Sunday_checkbox"><span>Closed</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="" name="Sunday_open"
                                                        type="time" />
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <input class="form-control" value="" name="Sunday_close"
                                                        type="time" />
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="button" id="become_dealer_btn"
                                        class="btn btn-fill-out submit font-weight-bold">Save
                                        Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); //ajax setup

            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop company logo here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            //  need to create ajax create 
            $('#become_dealer_btn').click(function() {

                document.getElementById("become_dealer_btn").disabled = true; //enable button after click it
                $('.clear_form_error').html('');

                // to get csrf
                var form = $('#become_dealer_form')[0];
                var form_ajax = new FormData(form); // get form data

                Swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                // ajax post start 
                $.ajax({
                    url: "{{ route('web.dashboard.become_dealer') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: form_ajax,
                    success: function(response) {
                        document.getElementById("become_dealer_btn").disabled =
                            false; //enable button after click it

                        if (response.code == "false") {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg

                        } else {

                        }

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        //   Swal.close();
                    },
                    error: function(error) {
                        Swal.close();
                        // display validations in created slider 
                        $('#company_logo_error').html(error.responseJSON.errors.company_logo);
                        $('#company_name_error').html(error.responseJSON.errors.Company_Name);
                        $('#Dealer_License_number_error').html(error.responseJSON.errors
                            .Dealer_License_number);
                        $('#dealer_location_error').html(error.responseJSON.errors
                            .dealer_location);
                        document.getElementById("become_dealer_btn").disabled =
                            false; //enable button after click it
                    }
                });
            });


        });
    </script>
@endsection
