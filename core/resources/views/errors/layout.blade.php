<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/dashboard') }}/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/dashboard') }}/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/dashboard') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/dashboard') }}/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-2 fw-medium">
                            <!-- 4<i class="bx bx-buoy bx-spin text-primary display-3"></i>1 -->
                            @yield('code')
                        </h1>
                        <h4 class="text-uppercase">@yield('message')</h4>
                        <div class="mt-5 text-center">
                            <a class="btn btn-primary waves-effect waves-light" href="{{ route('home') }}">Back to
                                Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img src="{{ asset('assets/dashboard') }}/images/error-img.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/dashboard') }}/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets/dashboard') }}/libs/node-waves/waves.min.js"></script>

    <script src="{{ asset('assets/dashboard') }}/js/app.js"></script>

</body>

</html>