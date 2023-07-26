@extends('Admin.Layout.layout')
@section('section')
    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Users Management (Detailed)</h2>
                <p>You can manage users here</p>
            </div>
            <!-- Your Blade view content here -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <!-- Rest of your Blade view content here -->

            <div>
                {{-- <a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a> --}}
            </div>
        </div>
        <!-- card end// -->

        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 ms-auto text-md-start">
                        <p>User Details</p>
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                        <p>Joined Date : {{ \Carbon\Carbon::parse($userDetailed->user_joined)->diffForHumans() }}</p>

                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body">
                <div class="row mb-50 mt-20 order-info-wrap">
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-person"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Personal Details</h6>
                                <p class="mb-1">
                                    First Name : {{ $userDetailed->First_Name ?? 'Not filled' }} <br />
                                    Last Name : {{ $userDetailed->Last_Name ?? 'Not filled' }} <br />
                                    Email : {{ $userDetailed->email ?? 'Not filled' }}<br />
                                    Phone : {{ $userDetailed->phone ?? 'Not filled' }}<br /><br />

                                </p>

                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i style="font-size: 16px !important;" class="text-primary fa-solid fa-box-archive"></i>

                            </span>
                            <div class="text">
                                <h6 class="mb-1">Package Details</h6>
                                <p class="mb-1">
                                    Package :
                                    {{ $package_name ?? 'Not activated' }}
                                    <br />
                                    Package Start :
                                    {{ $userDetailed->package_start_date ?? 'Not activated' }}
                                    <br />
                                    Package End :
                                    {{ $userDetailed->package_expire_date ?? 'Not activated' }}
                                    <br />
                                    Available ad count :
                                    {{ $userDetailed->available_ad_count ?? 'Not activated' }}
                                    <br />
                                    Available top ad count :
                                    {{ $userDetailed->available_top_count ?? 'Not activated' }}
                                    <br />


                                </p>

                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                    <div class="col-md-4">
                        <article class="icontext align-items-start">
                            <span class="icon icon-sm rounded-circle bg-primary-light">
                                <i class="text-primary material-icons md-place"></i>
                            </span>
                            <div class="text">
                                <h6 class="mb-1">Location</h6>
                                <p class="mb-1">
                                    District : {{ $userDetailed->district ?? 'Not filled' }}<br />
                                    City : {{ $userDetailed->city ?? 'Not filled' }}<br />
                                </p>

                            </div>
                        </article>
                    </div>
                    <!-- col// -->
                </div>

            </div>
            <!-- card-body end// -->
        </div>


        <div class="card">
            <header class="card-header">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 ms-auto text-md-start">
                        <p>Ad Details</p>
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                    </div>
                </div>
            </header>
            <!-- card-header end// -->
            <div class="card-body">
                <div class="row mb-50 mt-20 order-info-wrap">
                    <div class="col-lg-12 col-md-12 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="ads" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Price (Rs)</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Number</th>
                                                <th scope="col">Ad Status<br>(vendor)</th>
                                                <th scope="col">Ad Status<br>(admin)</th>
                                                <th scope="col">Is TopAd</th>
                                                <th scope="col">Ad expire</th>
                                                <th scope="col">Top ad expire</th>
                                                <th scope="col" class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($my_ads as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td><b>{{ $item->ad_title }} </b></td>
                                                    <td> {{ is_numeric($item->ad_price) ? number_format($item->ad_price, 2) : $item->ad_price }}
                                                    </td>
                                                    <td> <img style="height: 100px; width:100px; object-fit:cover;"
                                                            src="{{ asset('assets/myCustomThings/vehicleTypes/' . $item->name) }}" />
                                                    </td>
                                                    <td>{{ $item->ad_number }}
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <span class="badge rounded-pill alert-warning">deactive</span>
                                                        @else
                                                            <span class="badge rounded-pill alert-success">active</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if ($item->adminStatus == 1)
                                                            <span class="badge rounded-pill alert-warning">deactive</span>
                                                        @else
                                                            <span class="badge rounded-pill alert-success">active</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if ($item->is_top_id == 1)
                                                            <span class="badge rounded-pill alert-success">yes</span>
                                                        @else
                                                            <span class="badge rounded-pill alert-warning">no</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->ad_expire_date }}</td>
                                                    <td>
                                                        @empty($item->top_ad_expire_date)
                                                            not a top ad
                                                        @else
                                                            {{ $item->top_ad_expire_date }}
                                                        @endempty
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.users.more.changeStatus', ['id' => $item->id]) }}"
                                                            class="btn btn-xs p-2">status (admin)</a>
                                                        <a href="{{ route('admin.users.more.deleteAd', ['id' => $item->id]) }}"
                                                            style="color: white; background-color: brown;"
                                                            class="btn btn-xs p-2"
                                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card-body end// -->
            </div>


    </section>
    <script>
        $(document).ready(function() {
            $('#ads').DataTable({
                // Configure your DataTable here
            });
        });
    </script>
@endsection
