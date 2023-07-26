@extends('Web.Layout.Layout')
@section('content')
<style>
    .card-login{
        padding: 10px !important;
    }
</style>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content  pb-150">
        <div class="container">
            <div class="row">
                <div >
                    <div >
                        <div >
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div style="margin-top: 20px !important;" class="heading_s1 text-center">
                                        <h1 class="mb-3">Create an Account</h1>
                                        <p class="mb-30">Already have an account? <a href="{{ route('web.vendor.login') }}">Login</a></p>
                                    </div>

                                    <div class="row"> 
                                    
                                    <div class="d-none d-md-block col-lg-2 col-md-2"></div>

                                    <div class="col-lg-8 col-md-8 col-sm-12">
                                        <form id="vendor_register_form" class="card-login">
                                            <div class="form-group">
                                              <input class="clear_input" type="text" name="username" placeholder="Username" />
                                              <span id="username_error" class="text-danger clear_form_error"></span>
                                            </div>
                                            <div class="form-group">
                                              <input type="text" class="clear_input" name="email" placeholder="Email" />
                                              <span id="email_error" class="text-danger clear_form_error"></span>
                                            </div>
                                            <div class="form-group">
                                              <input type="password" class="clear_input" name="password" id="password" placeholder="Password" />
                                              <span id="password_error" class="text-danger clear_form_error"></span>
                                            </div>
                                            <div class="form-group">
                                              <input type="password" class="clear_input" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" />
                                              <span id="confirm_password_error" class="text-danger"></span>
                                            </div>
                                          
                                            <div class="login_footer form-group mb-50">
                                              <div class="chek-form">
                                                <!--<div class="custome-checkbox">-->
                                                <!--  <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" />-->
                                                <!--  <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>-->
                                                <!--</div>-->
                                              </div>
                                              <a href="page-privacy-policy.html"><i class="fi-rs-book-alt mr-5 text-muted"></i>terms & Policy.</a>
                                            </div>
                                            <div class="form-group text-center">
                                              <a class="btn btn-danger" id="submit">Create</a>
                                            </div>
                                          </form>
                                          
                                    </div>
                                    
                                     <div class="d-none d-md-block col-lg-2 col-md-2"></div>
                                    
                                    </div>

                                </div>
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
      });  //ajax setup


     //  need to create ajax create 
     $('#submit').click(function() {
     
                       document.getElementById("submit").disabled = true; //enable button after click it
                       $('.clear_form_error').html(''); 
                  
                   // to get csrf
                   var vendor_form = $('#vendor_register_form')[0];
                   var vendor_form_form_ajax = new FormData(vendor_form); // get form data
                   console.log(vendor_form_form_ajax);
                     Swal.fire({
                     title: 'Please wait...',
                     allowOutsideClick: false,
                     onBeforeOpen: () => {
                         Swal.showLoading();
                     }
                     });
                           // ajax post start 
                           $.ajax({
                   url:"{{ route('web.vendor.create') }}",
                   method:"POST",
                   processData: false,
                   contentType: false,
                   data:vendor_form_form_ajax,
                   success: function(response){  
                   document.getElementById("submit").disabled = false; //enable button after click it
                 
                   if(response.code=="false"){
                     Swal.fire({
                                   title: 'Error!',
                                   text: response.msg,
                                   icon: 'error',
                                   confirmButtonText: 'OK'
                     })//display error msg
                  
                    }
                    else{
                    window.location.href = "{{ route('web.dashboardIndex')}}";
                    }
               
                   $('.clear_input').val('');
                   $('.clear_form_error').html('');
                //   Swal.close();
                   },
               
                   error:function(error){

                 
                   // display validations in created slider 
                   $('#username_error').html(error.responseJSON.errors.username);
                   $('#email_error').html(error.responseJSON.errors.email);
                   $('#password_error').html(error.responseJSON.errors.password);
                   document.getElementById("submit").disabled = false; //enable button after click it
                   Swal.close();
                   }
                   });
                   });


    });
</script>
@endsection















