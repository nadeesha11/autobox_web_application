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
        body{
            min-height: 90vh !important;
        }
    </style>

    <body>
        <main>

            <section class="content-main ">
    
                <div class="d-flex justify-content-center">
                    <img class="text-center" src="{{ asset('assets/imgs/theme/logo-color.png') }}" alt="">
                  </div>
                  
                <div class="card mx-auto card-login mt-80">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Login</h4>
                        <form id="admin_login_form">
                            <div class="mb-3">
                                <input class="form-control clear_input" @if(Cookie::has('autobox_username')) value="{{ Cookie::get('autobox_username') }}" @endif name="name" placeholder="user name" type="text" />
                                <span id="name_error" class="clear_form_error" style="color:red"></span>
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <input class="form-control clear_input" @if(Cookie::has('autobox_password')) value="{{ Cookie::get('autobox_password') }}" @endif  name="password" placeholder="Password" type="password" />
                                <span id="password_error" class="clear_form_error" style="color:red"></span>
                            </div>
                            <!-- form-group// -->
                            <div class="mb-3">
                                <a href="{{ route('admin.forgetPassword') }}" class="float-end font-sm text-muted">Forgot password?</a>
                                <label class="form-check">
                                    <input  style="background-color: #4a9975 !important;" name="remember"  type="checkbox" class="form-check-input" checked="" />
                                    <span class="form-check-label">Remember</span>
                                </label>
                            </div>
                            <!-- form-group form-check .// -->
                            <div class="mb-4">
                                <button style="background-color: #4a9975 !important;" id="login_button" type="button" class="btn btn-primary w-100">Login</button>
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
         });  //ajax setup


        //  need to create ajax create 
        $('#login_button').click(function() { 
                          document.getElementById("login_button").disabled = true; //enable button after click it
                          $('.clear_form_error').html(''); 
                     
                      // to get csrf
                      var admin_login_form = $('#admin_login_form')[0];
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
                      url:"{{ route('admin.admin.login') }}",
                      method:"POST",
                      processData: false,
                      contentType: false,
                      data:admin_login_form_ajax,
                      success: function(response){  
                      document.getElementById("login_button").disabled = false; //enable button after click it
                      console.log(response);
                      if(response.code=="false"){
                        Swal.fire({
                                      title: 'Error!',
                                      text: response.msg,
                                      icon: 'error',
                                      confirmButtonText: 'OK'
                        })//display error msg
                     
                       }
                       else{
                        let url = '{{ route('admin.dashboard') }}';
                        location.href = url;
                       }
                  
                      $('.clear_input').val('');
                      $('.clear_form_error').html('');
                    //   Swal.close(); // Close the SweetAlert
                      },
                  
                      error:function(error){

                      Swal.close(); // Close the SweetAlert
                      // display validations in created slider 
                      $('#name_error').html(error.responseJSON.errors.name);
                      $('#password_error').html(error.responseJSON.errors.password);
                      document.getElementById("login_button").disabled = false; //enable button after click it
                      }
                      });
                       });


       });
</script>









































