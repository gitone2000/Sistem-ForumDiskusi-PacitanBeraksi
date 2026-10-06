<!doctype html>
<html lang="en" class="h-200" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pacitan Beraksi</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/pacitan_kab.png') }}" sizes="180x180">
    <link rel="icon" href="{{ asset('assets/img/pacitan_kab.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('assets/img/pacitan_kab.png') }}" sizes="16x16" type="image/png">

    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css') }}">

    <!-- Selectsize-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectize/dist/css/selectize.default.css">

    <!-- style css for this template -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" id="style">

</head>

{{-- <style>
    *{
        border: 1px solid red;
    }
</style> --}}
<body class="body-scroll d-flex flex-column h-100" data-page="signin">
    <!-- loader section -->
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="loader-cube-wrap loader-cube-animate mx-auto">
                    <img src="{{ asset('assets/img/pacitan_kab.png') }}" alt="Logo">
                </div>
                <p class="mt-4"><strong>Harap tunggu...</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->

    <main class="main-content container-fluid h-100" id="main-content">
        @yield('content')
    </main>

    <!-- Required jquery and libraries -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/color-scheme.js')}}"></script>

    <!-- PWA app service registration and works -->
    <script src="{{ asset('assets/js/pwa-services.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- selectsize -->
    <script src="https://cdn.jsdelivr.net/npm/selectize/dist/js/standalone/selectize.min.js"></script>

    <script src="{{ asset('assets/js/selectsize.js') }}"></script>
    
    <script src="{{ asset('assets/js/filePreview.js') }}"></script>

    
</body>
</html>
