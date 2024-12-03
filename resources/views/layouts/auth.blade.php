<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/images/favicon.png') }}">
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- include css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/include/progress.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/include/toastify.min.css') }}">
</head>

<body class="h-100">
    <!-- progress bar -->
    <div id="loader" class="LoadingOverlay d-none">
        <div class="Line-Progress">
            <div class="indeterminate"></div>
        </div>
    </div>

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                @yield('content')
            </div>
        </div>
    </div>

    <!--********************************** Scripts ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('dashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/deznav-init.js') }}"></script>

    <!-- include js -->
    {{-- <script src="{{ asset('dashboard/js/include/jquery-3.7.0.min.js') }}"></script> --}}
    <script src="{{ asset('dashboard/js/include/axios.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/include/config.js') }}"></script>
    <script src="{{ asset('dashboard/js/include/toastify-js.js') }}"></script>
    <script src="{{ asset('dashboard/js/dev/auth.js') }}"></script>
    @yield('scripts')
</body>

</html>
