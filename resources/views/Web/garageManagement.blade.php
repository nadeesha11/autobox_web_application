@extends('Web.Layout.Layout')
@section('content')
    <style>
        .clear_form_error {
            color: red;
        }
    </style>
    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('web.home') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> <a href="{{ route('web.dashboardIndex') }}">Dashboard</a> <span></span> <a
                        href="#">garage management</a>
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>Garage Management</h5>
                    </div>
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-5 card p-2">
                                <div class="m-1 p-2">
                                    <form id="garageForm">

                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control clear_input" id="name"
                                                name="name" placeholder="Enter garage name *">
                                            <span class="clear_form_error" id="name_error"></span>
                                        </div>

                                        <div class="form-group mb-3">
                                            <select style="height: 60px !important;" name="city" class="form-select "
                                                aria-label=".form-select-lg example">
                                                <option value="" selected>Open this to select city *</option>
                                                @foreach ($data as $one)
                                                    <option value="{{ $one->name_en }}">{{ $one->name_en }}</option>
                                                @endforeach
                                            </select>
                                            <span class="clear_form_error" id="city_error"></span>
                                        </div>

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span style="height: 60px !important;" class="input-group-text"
                                                    id="basic-addon1">+94 </span>
                                            </div>
                                            <input name="number" type="text" style="height: 60px !important;"
                                                class="form-control clear_input" placeholder="Enter Phone Number *"
                                                aria-label="Username" aria-describedby="basic-addon1">
                                        </div>
                                        <span class="clear_form_error" id="number_error"></span>

                                        <div class="form-group mb-3">
                                            <input type="text" class="form-control clear_input" id="name"
                                                name="url" placeholder="Enter Google Map Url">
                                            <span class="clear_form_error" id="url_error"></span>
                                        </div>

                                        <div class="form-group mb-3">
                                            <textarea name="address" class="form-control clear_input" placeholder="Enter Address" id="exampleFormControlTextarea1"
                                                style="height: 100px ;" rows="10"></textarea>
                                            <span class="clear_form_error" id="address_error"></span>
                                        </div>

                                        <div class="form-group mb-3">
                                            <textarea name="desc" class="form-control clear_input" style="height: 100px;" placeholder="Enter Some Description"
                                                id="exampleFormControlTextarea1" rows="5"></textarea>
                                            <span class="clear_form_error" id="desc_error"></span>
                                        </div>

                                        <div class="form-group mb-3">
                                            <input id="image_1" data-allowed-file-extensions="jpeg  jpg "
                                                data-max-file-size-preview="10M" name="image" class="dropify"
                                                type="file">
                                            <span class="clear_form_error" id="image_error"></span>
                                        </div>

                                        <button type="button" id="create_garage_btn"
                                            class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-7 ">
                                <div class="table-responsive">
                                    <div class="table-responsive">
                                        <table id="display_garage_details" class="table align-middle table-nowrap mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="5%;" class="align-middle" scope="col">ID</th>
                                                    <th width="55%;" class="align-middle" scope="col">Name</th>
                                                    <th width="10%;" class="align-middle" scope="col">Status</th>

                                                    <th width="30%;" class="align-middle" scope="col">Action</th>
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
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="garage_more_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">More Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <p class="mb-2">Title : <span id="title_more_details"></span></p>
                        <p class="mb-2">Number : <span id="number_more_details"></span></p>
                        <p class="mb-2">City : <span id="city_more_details"></span></p>
                        <a class="mb-2" target="_blank" id="url_more_details" href="#">
                            <p style="color: rgb(8, 167, 88) ; text-decoration:underline;" id="url_more_details_text"></p>
                        </a>
                        <p class="mb-2">Address : <span id="address_more_details"></span></p>
                        <p class="mb-2">Description : <span id="desc_more_details"></span></p>
                        <img style="height: 300px; width:600px; object-fit:contain ;" id="img_more_details"
                            src="" alt="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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

            //  view data on table start 
            $('#display_garage_details').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('web.garage.recieveData') !!}',

                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    // {
                    //     data: 'image',
                    //     name: 'image'
                    // },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]

            });

            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop a garage image here or click',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });

            $('#create_garage_btn').click(function() {
                document.getElementById("create_garage_btn").disabled = true;
                $('.clear_form_error').html('');

                // to get csrf
                var create_garage = $('#garageForm')[0];
                var create_garage_data = new FormData(create_garage); // get form data

                // ajax post start 
                $.ajax({
                    url: "{{ route('web.garage.create') }}",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    data: create_garage_data,
                    success: function(response) {

                        document.getElementById("create_garage_btn").disabled = false;
                        if (response.code == "success") {
                            Swal.fire({
                                title: 'Success!',
                                text: response.msg,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }) //display error msg

                        } else if (response.code == "error") {
                            Swal.fire({
                                title: 'Error!',
                                text: response.msg,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            }) //display error msg
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Sorry , Try Again',
                                icon: 'warning',
                                confirmButtonText: 'OK'
                            }) //display error msg
                        }

                        //   clear all from data and errors start 
                        $('#display_garage_details').DataTable().ajax.reload();
                        $('.clear_input').val('');
                        $('.clear_form_error').html('');
                        var drEvent = $('.dropify').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();
                        //   clear all from data and errors end 

                    },
                    error: function(error) {
                        document.getElementById("create_garage_btn").disabled = false;
                        // display validations in created admin 
                        $('#name_error').html(error.responseJSON.errors
                            .name);
                        $('#city_error').html(error.responseJSON.errors
                            .city);
                        $('#number_error').html(error.responseJSON.errors
                            .number);
                        $('#url_error').html(error.responseJSON.errors
                            .url);
                        $('#address_error').html(error.responseJSON.errors
                            .address);
                        $('#desc_error').html(error.responseJSON.errors
                            .desc);
                        $('#image_error').html(error.responseJSON.errors
                            .image);

                    }
                });

            })


            $('body').on('click', '.delete', function() {
                var id = $(this).data('id');

                // Ask for confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete this item.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // User confirmed, proceed with deletion
                        $.ajax({
                            url: '{{ url('web/garage') }}' + '/' + id + '/delete',
                            method: 'GET',
                            success: function(response) {
                                if (response.code == "success") {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: response.msg,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    });
                                } else if (response.code == "error") {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: response.msg,
                                        icon: 'error',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error!',
                                        text: 'Sorry, Try Again',
                                        icon: 'warning',
                                        confirmButtonText: 'OK'
                                    });
                                }
                                $('#display_garage_details').DataTable().ajax.reload();
                                console.log(response);
                            },
                            error: function(error) {
                                // Handle error if necessary
                            }
                        });
                    } else {
                        // User clicked cancel, do nothing or perform alternative action if needed
                    }
                });
            });

            // more details start 
            $('body').on('click', '.more', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ url('web/garage') }}' + '/' + id + '/more',
                    method: 'GET',
                    success: function(response) {
                        var imageURL = '{{ asset('assets/myCustomThings/Garage') }}' + '/' +
                            response.image;
                        $('#img_more_details').attr('src', imageURL);

                        $('#title_more_details').text(response.name);
                        $('#number_more_details').text("+94 " + response.number);
                        $('#city_more_details').text(response.city);
                        $('#url_more_details_text').text(response.url);
                        $('#address_more_details').text(response.address);
                        $('#desc_more_details').text(response.desc);
                        $('#url_more_details').attr('href', response.url);

                        $('#garage_more_modal').modal('show')
                    },
                    error: function(error) {
                        // Handle error if necessary
                    }
                });
            });
            // more details end  

            // edit details start 
            $('body').on('click', '.edit', function() {
                var id = $(this).data('id');
                let url = '{{ url('web/dashboard/garage/editPage') }}' + '/' + id;
                location.href = url;

            });
            // edit details end  

        });
    </script>
@endsection
