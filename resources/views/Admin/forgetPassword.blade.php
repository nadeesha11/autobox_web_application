<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>AutoBox Login</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/logo-color.svg') }}" />
    <!-- Template CSS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('assets/css/main.css?v=1.1') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
</head>
<style>
    body {
        min-height: 90vh !important;
    }

    div:where(.swal2-icon).swal2-error.swal2-icon-show .swal2-x-mark {
        display: none !important;
    }
</style>

<body>
    <main>

        <section class="content-main ">

            <div class="d-flex justify-content-center">
                <img class="text-center" src="{{ asset('assets/imgs/theme/logo-color.png') }}" alt="">
            </div>
            <h2 class="text-center mt-80">Forgot your password?</h2>
            <div class="card mx-auto card-login mt-80">

                <div class="card-body">
                    <p class="card-title mb-4">Not to worry, we got you! Let’s get you a new password. Please enter your
                        email </p>
                    <form id="password_remember_form">
                        <div class="mb-3">
                            <input class="form-control clear_input" name="mail" placeholder="Enter your mail"
                                type="text" />
                            <span id="mail_error" class="clear_form_error" style="color:red"></span>
                        </div>

                        <div class="mb-4">
                            <button style="background-color: #4a9975 !important;" id="send_button" type="button"
                                class="btn btn-primary w-100">Enter</button>
                        </div>
                        <!-- form-group// -->
                    </form>

                </div>
            </div>
        </section>
        <footer class="main-footer text-center">
            <p class="font-xs">
                <script>
                    document.write(new Date().getFullYear());
                </script>
                &copy; AutoBox
            </p>
            <p class="font-xs ">All rights reserved</p>
        </footer>
    </main>

    <!-- Main Script -->
    <script src="{{ asset('assets/js/main.js?v=1.1') }}" type="text/javascript"></script>
</body>

</html>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); //ajax setup


        //  need to create ajax create 
        $('#send_button').click(function() {
            document.getElementById("send_button").disabled = true; //enable button after click it
            $('.clear_form_error').html('');

            // to get csrf
            var admin_login_form = $('#password_remember_form')[0];
            var admin_login_form_ajax = new FormData(admin_login_form); // get form data

            Swal.fire({
                title: 'Please wait...',
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });
            // ajax post start 
            $.ajax({
                url: "{{ route('admin.forgetPassword.mail') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: admin_login_form_ajax,
                success: function(response) {
                    document.getElementById("send_button").disabled =
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
                    $('#mail_error').html(error.responseJSON.errors.mail);
                    document.getElementById("send_button").disabled =
                        false; //enable button after click it
                }
            });
        });


    });
</script>
