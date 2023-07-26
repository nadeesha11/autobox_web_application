@extends('Web.Layout.Layout')
@section('content')
    <main class="main page-404">
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">

                        <p class="mb-20"><img style="height: 200px !important; width: 200px !important;  "
                                src="https://i.ibb.co/hZmCNgS/award.gif" alt="" class="hover-up" />
                        </p>
                        <h1 class="display-2 mb-30">Your ad published</h1>
                        <p class="font-lg text-grey-700 mb-30">
                            Approved
                        </p>

                        <a href="{{ route('web.dashboardIndex') }}"
                            class="btn btn-default submit-auto-width font-xs hover-up mt-30" href="index.html"><i
                                class="fi-rs-home mr-5"></i> My ads</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
