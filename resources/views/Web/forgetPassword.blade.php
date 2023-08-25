@extends('Web.Layout.Layout')
@section('content')
    <style>
        div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
            display: none !important;
        }
    </style>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="#"> Forget Password</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row ">
                    <div class="col-xl-4 col-lg-6 col-md-12 m-auto card">
                        <div style="padding: 20px !important;" class="login_wrap widget-taber-content background-white">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">

                                    <h2 class="mb-15 mt-15">Forgot your password?</h2>
                                    <p class="mb-30">Not to worry, we got you! Let’s get you a new password. Please enter
                                        your email address </p>
                                </div>
                                <form id="password_reset_form">
                                    <div class="form-group">
                                        <input type="text" class="clear_input" name="email"
                                            placeholder="Enter Email *" />
                                        <span class="text-danger clear_form_error" id="mail_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-heading btn-block hover-up"
                                            id="reset_password_btn">Reset password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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


            //  need to create ajax create 
            $('#reset_password_btn').click(function() {
                document.getElementById("reset_password_btn").disabled =
                    true; //enable button after click it
                $('.clear_form_error').html('');

                // to get csrf
                var forgetPassword = $('#password_reset_form')[0];
                var admin_login_form_ajax = new FormData(forgetPassword); // get form data

                Swal.fire({
                    title: 'Please wait...',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    }
                });
                // ajax post start 
                $.ajax({
                    url: "{{ route('web.forgetPassword.mail') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: admin_login_form_ajax,
                    success: function(response) {
                        document.getElementById("reset_password_btn").disabled =
                            false; //enable button after click it
                        //   Swal.close(); // Close the SweetAlert
                        $('.clear_input').val('');
                        $('.clear_form_error').html('');

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

                    },
                    error: function(error) {
                        Swal.close(); // Close the SweetAlert
                        // display validations 
                        $('#mail_error').html(error.responseJSON.errors.email);
                        document.getElementById("reset_password_btn").disabled =
                            false; //enable button after click it
                    }
                });
            });


        });
    </script>
@endsection
