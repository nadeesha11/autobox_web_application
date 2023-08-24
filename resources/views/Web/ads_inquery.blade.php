@extends('Web.Layout.Layout')
@section('content')
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="#">Inquire Ads</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>Inquire Ads</h5>
                    </div>
                    <div class="card-body">
                        <form id="create_form">
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-12 ">
                                    <input name="image" type="file" class="dropify" data-height="200"
                                        data-allowed-file-extensions="jpeg jpg png" />
                                    <span class="text-danger clear_form_error" id="image_error"></span>
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <input class="form-control clear_input" placeholder="Title *" name="title"
                                        type="text" />
                                    <span class="text-danger clear_form_error" id="title_error"></span>
                                </div>
                                <div class="form-group col-md-6 col-lg-6">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">+94 </span>
                                        <input type="text" class="form-control clear_input" name="phone"
                                            placeholder="Phone" aria-label="Username" aria-describedby="basic-addon1">

                                    </div>
                                    <span class="clear_form_error text-danger" id="phone_error"></span>
                                </div>

                                <div class="form-group mb-30">
                                    <textarea class="clear_input" id="description" name="additional_information" rows="5"
                                        placeholder="Additional information"></textarea>
                                    <span class="clear_form_error text-danger" id="description_error"></span>
                                </div>

                                <div class="col-md-12">
                                    <button type="button" id="new_ad_btn"
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
                    'default': 'Drag and drop ads image here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            //  need to create ajax create 
            $('#new_ad_btn').click(function() {

                document.getElementById("new_ad_btn").disabled = true; //enable button after click it
                $('.clear_form_error').html('');

                // to get csrf
                var form = $('#create_form')[0];
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
                    url: "{{ route('web.create.adsInquery') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: form_ajax,
                    success: function(response) {
                        document.getElementById("new_ad_btn").disabled =
                            false; //enable button after click it
                        Swal.close();
                        if (response.code == 500) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg

                        } else if (response.code == 400) {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg
                        } else if (response.code == 200) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.msg,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }) //display error msg 

                        }
                        $('.dropify').click();
                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        //   Swal.close();
                    },
                    error: function(error) {
                        Swal.close();
                        // display validations in created slider 
                        $('#image_error').html(error.responseJSON.errors.image);
                        $('#title_error').html(error.responseJSON.errors.title);
                        $('#phone_error').html(error.responseJSON.errors
                            .phone);
                        $('#description_error').html(error.responseJSON.errors
                            .additional_information);
                        document.getElementById("new_ad_btn").disabled =
                            false; //enable button after click it
                    }
                });
            });


        });
    </script>
@endsection
