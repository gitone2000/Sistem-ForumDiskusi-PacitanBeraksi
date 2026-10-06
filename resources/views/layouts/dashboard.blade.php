<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pacitan-Dashbord</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

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

    <!-- style css for this template -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" id="style">
</head>

<body class="body-scroll" data-page="profile">
    @if (empty($noLoader))
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
    @endif

    <!-- Begin page -->
    <main class="h-100">
        @yield('content')
    </main>
    <!-- Page ends-->

    <!-- Required jquery and libraries -->
    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>

    <!-- cookie js -->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}"></script>

    <!-- Customized jquery file  -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/color-scheme.js') }}"></script>

    <!-- swiper js script -->
    <script src="{{ asset('assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js') }}"></script>

    <!-- page level custom script -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="devModal" tabindex="-1" aria-labelledby="devModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="devModalLabel">Pengumuman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Fitur ini masih dalam tahap pengembangan.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
