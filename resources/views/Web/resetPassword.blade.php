<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>autobox</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link href="{{ asset('assets/css/main.css?v=1.1') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
</head>

<body>
    <main>
        <section class="content-main  ">
            <h3 class="text-center m-3">Reset your password ?</h3>
            <div class="card mx-auto card-login">
                <div class="card-body ">
                    <form id="reset_password">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="mb-3 mt-3">
                            <input class="form-control custom" id="password" name="password"
                                placeholder="Enter your new password " type="password" />
                            <span id="password_error" class="text-danger error_reset"> </span>
                        </div>
                        <div class="mb-3 mt-3 ">
                            <input class="form-control custom" id="password" name="password_confirmation"
                                placeholder="Repeat your new password " type="password" />
                            <span class="mb-3">
                                <p style="font-size: 0.9em !important;">*reqireat least one uppercase,lowercase,number,
                                    special character and minimum 6 characters</p>
                            </span>
                            <span id="password_confirmation_error" class="text-danger error_reset"> </span>
                        </div>
                        <div class="mb-4">
                            <button id="reset_btn" type="button" class="btn btn-primary w-100 ">Reset password</button>
                        </div>
                        <div class="mb-4 text-right">
                            <a href="{{ route('web.vendor.login') }}" class="float-end font-sm ">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <footer class="main-footer text-center">
            <p class="font-xs">
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </p>
            <p class="font-xs mb-30">All rights reserved </p>
        </footer>
    </main>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            // to get csrf
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#reset_btn').click(function() {
                $('.error_reset').html('');
                var resetDataform = $('#reset_password')[0];
                var resetDataformAjax = new FormData(resetDataform);
                $.ajax({
                    url: "{{ route('vendor.resetPassword') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: resetDataformAjax,
                    success: function(response) {
                        $('.custom').val('');
                        $('.error_reset').html('');
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
                                title: 'warning!',
                                icon: 'warning',
                                text: response.msg,
                                confirmButtonText: 'OK'
                            })
                        }
                    },

                    error: function(error) {
                        $('#password_error').html(error.responseJSON.errors.password);
                    }
                });
            })


        });
    </script>
