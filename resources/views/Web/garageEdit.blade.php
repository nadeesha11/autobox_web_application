@extends('Web.Layout.Layout')
@section('content')
    <style>
        .clear_form_error {
            color: red;
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
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Dashboard <span></span> garage edit
                </div>
            </div>
        </div>
        <div class="page-content pt-50 pb-50">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <h5>Garage Edit</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <th width="30%;">Name</th>
                                            <td width="70%;">{{ $data->name }} <a href="#"
                                                    onclick="editDetails('Name','{{ $data->name }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a> </td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">City</th>
                                            <td width="70%;">{{ $data->city }} <a href="#"
                                                    onclick="editDetails('city','{{ $data->city }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Number</th>
                                            <td width="70%;">+94 {{ $data->number }} <a href="#"
                                                    onclick="editDetails('number','{{ $data->number }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Url</th>
                                            <td width="70%;"><a target="_blank" href=" {{ $data->url }}">
                                                    {{ $data->url }}</a> <a href="#"
                                                    onclick="editDetails('url','{{ $data->url }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a> </td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Address</th>
                                            <td width="70%;">{{ $data->address }} <a href="#"
                                                    onclick="editDetails('address','{{ $data->address }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Description</th>
                                            <td width="70%;">{{ $data->desc }} <a href="#"
                                                    onclick="editDetails('desc','{{ $data->desc }}'); "><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a></td>

                                        </tr>
                                        <tr>
                                            <th width="30%;">Image</th>
                                            <td width="70%;">

                                                <img style="height: 200px; width:200px;"
                                                    src="{{ asset('assets/myCustomThings/Garage/' . $data->image) }}"
                                                    alt=""> <a><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
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
                        <img style="height: 300px; width:600px; object-fit:contain ;" id="img_more_details" src=""
                            alt="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="edit_garage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="update_single_values_form">
                            <div class="mb-3">
                                <input type="hidden" id="hidden_single_type" name="hidden_single_type"
                                    class="clear_input">
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

    </main>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {


        });

        function editDetails(type, value) {
            console.log(type, value);
            $('#edit_garage').modal('show');
            //2023.07.27  need to create edit
        }
    </script>
@endsection
