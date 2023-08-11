@extends('Web.Layout.Layout')
@section('content')
    <style>
        .card-login {
            padding: 10px !important;
        }
    </style>

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Login
                </div>
            </div>
        </div>
        <div style="margin-top: 30px !important;" class="page-content pb-150">
            <div class="container">
                <div class="row">
                    <h1 class="mb-5 text-center">Login</h1>
                    <div class="row">
                        <div class="col-lg-4  col-md-6 col-sm-12 ">

                            <div style="margin-bottom: 20px !important;">
                                <div class="card-login ">
                                    <a href="{{ url('/facebook/login') }}" class="social-login facebook-login">
                                        <img src="{{ asset('web/assets/imgs/theme/icons/logo-facebook.svg') }}"
                                            alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="{{ url('/google/login') }}" class="social-login google-login">
                                        <img src="{{ asset('web/assets/imgs/theme/icons/logo-google.svg') }}"
                                            alt="" />
                                        <span>Continue with Google</span>
                                    </a>

                                </div>
                                <p class="text-center d-md-none">or</p>
                            </div>
                        </div>
                        <div class="col-lg-8  col-md-6 col-sm-12 ">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">

                                        <p class="mb-30">Don't have an account? <a
                                                href="{{ route('web.vendor.register') }}">Create here</a></p>
                                    </div>
                                    <form id="login_form">
                                        <div class="form-group">
                                            <input type="text"
                                                @if (Cookie::has('autobox_vendor_username')) value="{{ Cookie::get('autobox_vendor_username') }}" @endif
                                                name="name" class="clear_input" placeholder="Your Username *" />
                                            <span id="username_error" class="clear_form_error text-danger"> </span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                @if (Cookie::has('autobox_vendor_password')) value="{{ Cookie::get('autobox_vendor_password') }}" @endif
                                                name="password" class="clear_input" placeholder="Your password *" />
                                            <span id="password_error" class="clear_form_error text-danger"> </span>
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" checked type="checkbox" name="checkbox"
                                                        id="exampleCheckbox1" value="checkbox" />
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Remember
                                                            me</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="#">Forgot password?</a>
                                        </div>
                                        <div class="form-group text-center">
                                            <button id="login_btn" class="btn btn-heading btn-block hover-up"
                                                name="login">Log in</button>
                                        </div>
                                    </form>
                                </div>
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
            $('#login_btn').click(function() {

                document.getElementById("login_btn").disabled = true; //enable button after click it
                $('.clear_form_error').html('');

                // to get csrf
                var form = $('#login_form')[0];
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
                    url: "{{ route('web.login') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: form_ajax,
                    success: function(response) {
                        document.getElementById("login_btn").disabled =
                            false; //enable button after click it

                        if (response.code == "false") {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg

                        } else if (response.code == 'true') {
                            window.location.href = "{{ route('web.dashboardIndex') }}";
                        }

                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        //   Swal.close();
                    },
                    error: function(error) {
                        Swal.close();
                        // display validations in created slider 
                        $('#username_error').html(error.responseJSON.errors.name);
                        $('#password_error').html(error.responseJSON.errors.password);
                        document.getElementById("login_btn").disabled =
                            false; //enable button after click it
                    }
                });
            });


        });
    </script>
@endsection
