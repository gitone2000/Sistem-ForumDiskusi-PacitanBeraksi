@extends('layouts.dashboard')

@section('content')
    <!-- Header -->
    <header class="header position-fixed">
        <div class="row">
            <div class="col-auto">
                <a href="javascript:void(0)" target="_self" class="btn btn-light btn-44 menu-btn">
                    <i class="bi bi-list"></i>
                </a>
            </div>
            <div class="col align-self-center text-center">
                <div class="logo-small">
                    <img src="{{ asset('assets/img/pacitan_kab.png') }}" alt="">
                </div>
                <strong>Pacitan Beraksi</strong>
            </div>
            <div class="col-auto">
                <a href="#" class="btn btn-light btn-44"
                    onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right text-danger"></i>
                </a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>
    <!-- Header ends -->

    <!-- main page content -->
    <div class="main-container container pt-0">
        <!-- user information -->
        <div class="card shadow-sm mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-auto d-flex align-items-center">
                        <figure class="avatar avatar-60 rounded-10">
                            @if (auth()->user()->foto_diri)
                                <img src="{{ asset('storage/foto_diri/' . basename(auth()->user()->foto_diri)) }}"
                                    alt="Foto Profil">
                            @else
                                <img src="{{ asset('assets/img/decaa.png') }}" alt="Foto Default">
                            @endif
                        </figure>
                    </div>
                    <div class="col">
                        <!-- Row 1: Nama -->
                        <div class="row">
                            <div class="col-12 px-0 pb-1 d-flex justify-content-start align-items-start">
                                <h3 class="mb-0 text-color-theme">{{ auth()->user()->nama }}</h3>
                            </div>
                        </div>

                        <!-- Row 2: Perguruan (UGM) -->
                        <div class="row justify-content-start mb-1" style="padding-right: 0.4em;">
                            <div class="col-auto d-flex justify-content-center align-items-center py-1 px-2 bg-primary fw-medium rounded-15"
                                style="border: 1px solid #ddd">
                                <p class="size-10 text-center text-white mb-0">
                                    {{ auth()->user()->perguruan->nama }}
                                </p>
                            </div>
                        </div>

                        <!-- Row 3: NIM dan Bidang -->
                        <div class="row justify-content-start gap-1" style="padding-right: 0.4em;">
                            <div class="col-auto d-flex justify-content-center align-items-center py-1 px-2 bg-success fw-medium rounded-15"
                                style="border: 1px solid #ddd">
                                <p class="size-10 text-start text-white mb-0">{{ auth()->user()->nim }}</p>
                            </div>
                            <div class="col-auto d-flex justify-content-center align-items-center py-1 px-2 bg-warning fw-medium rounded-15"
                                style="border: 1px solid #ddd">
                                <p class="size-10 text-center text-white mb-0">
                                    {{ auth()->user()->bidang->nama ?? '-' }}</p>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- offers banner -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card theme-bg text-center overflow-hidden">
                    <div class="card-body p-0">
                        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">

                                <!-- Slide 1 -->
                                <div class="carousel-item active" data-bs-interval="3000">
                                    <img src="{{ asset('assets/img/watukarung.jpeg') }}" class="d-block w-100"
                                        alt="Banner 1" style="height: 25vh; object-fit: cover;">
                                </div>

                                <!-- Slide 2 -->
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('assets/img/ogleng.jpg') }}" class="d-block w-100" alt="Banner 2"
                                        style="height: 25vh; object-fit: cover;">
                                </div>

                                <!-- Slide 3 -->
                                <div class="carousel-item" data-bs-interval="3000">
                                    <img src="{{ asset('assets/img/loker.jpeg') }}" class="d-block w-100" alt="Banner 3"
                                        style="height: 25vh; object-fit: cover;">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Container Menu -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-body py-4">
                        <div class="row text-center g-2">
                            <!-- Menu 1 -->
                            <div class="col-4">
                                <div class="d-flex flex-column align-items-center" role="button" data-bs-toggle="modal"
                                    data-bs-target="#devModal">
                                    <div class="bg-white text-primary rounded-circle shadow d-flex justify-content-center align-items-center"
                                        style="width: 60px; height: 60px;">
                                        <img src="https://img.icons8.com/color/48/home.png" alt="home"" width=" 32"
                                            height="32">
                                    </div>
                                    <small class="mt-1">Beranda</small>
                                </div>
                            </div>
                            <!-- Menu 2 -->
                            <div class="col-4">
                                <a href="{{ route('edit.biodata') }}" class="text-decoration-none text-dark">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="bg-white text-success rounded-circle shadow d-flex justify-content-center align-items-center"
                                            style="width: 60px; height: 60px;">
                                            <img width="53" height="53"
                                                src="https://img.icons8.com/external-vectorslab-flat-vectorslab/53/external-Biodata-communication-technology-big-data-vectorslab-flat-vectorslab.png"
                                                alt="external-Biodata-communication-technology-big-data-vectorslab-flat-vectorslab" />
                                        </div>
                                        <small class="mt-1">Biodata</small>
                                    </div>
                                </a>
                            </div>
                            <!-- Menu 3 -->
                            <div class="col-4">
                                <a href="{{ route('forum.index') }}" class="text-decoration-none text-dark">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="bg-white text-warning rounded-circle shadow d-flex justify-content-center align-items-center"
                                            style="width: 60px; height: 60px;">
                                            <img width="48" height="48"
                                                src="https://img.icons8.com/color/48/people-working-together.png"
                                                alt="people-working-together">
                                        </div>
                                        <small class="mt-1">Forum</small>
                                    </div>
                                </a>
                            </div>
                            <!-- Menu 4 -->
                            <div class="col-4">
                                <div class="d-flex flex-column align-items-center" role="button" data-bs-toggle="modal"
                                    data-bs-target="#devModal">
                                    <div class="bg-white text-danger rounded-circle shadow d-flex justify-content-center align-items-center"
                                        style="width: 60px; height: 60px;">
                                        <img width="48" height="48"
                                            src="https://img.icons8.com/color/48/student-male.png" alt="student-male.png">
                                    </div>
                                    <small class="mt-1">Mahasiswa</small>
                                </div>
                            </div>
                            <!-- Menu 5 -->
                            <div class="col-4">
                                <div class="d-flex flex-column align-items-center" role="button" data-bs-toggle="modal"
                                    data-bs-target="#devModal">
                                    <div class="bg-white text-info rounded-circle shadow d-flex justify-content-center align-items-center"
                                        style="width: 60px; height: 60px;">
                                        <img width="48" height="48"
                                            src="https://img.icons8.com/color/48/beach.png" alt="beach.png">
                                    </div>
                                    <small class="mt-1">Pariwisata</small>
                                </div>
                            </div>
                            <!-- Menu 6 -->
                            <div class="col-4">
                                <div class="d-flex flex-column align-items-center" role="button" data-bs-toggle="modal"
                                    data-bs-target="#devModal">
                                    <div class="bg-white text-secondary rounded-circle shadow d-flex justify-content-center align-items-center"
                                        style="width: 60px; height: 60px;">
                                        <img width="48" height="48"
                                            src="https://img.icons8.com/color/48/permanent-job.png"
                                            alt="permanent-job.png">
                                    </div>
                                    <small class="mt-1">Loker</small>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.card-body -->
                </div> <!-- /.card -->
            </div> <!-- /.col-12 -->
        </div> <!-- /.row -->

        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 px-3">
                <div class="row d-flex align-items-center">
                    <h1 class="col text-start fs-5">Pantai</h1>
                    <a href="#" class="col text-end" role="button" data-bs-toggle="modal"
                        data-bs-target="#devModal">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="row text-center g-2 d-flex justify-content-center align-items-center">
                    <p class="text-muted">Coming Soon</p>
                </div>
            </div> <!-- /.card-body -->
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 px-3">
                <div class="row d-flex align-items-center">
                    <h1 class="col text-start fs-5">Budaya</h1>
                    <a href="#" class="col text-end" role="button" data-bs-toggle="modal"
                        data-bs-target="#devModal">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="row text-center g-2 d-flex justify-content-center align-items-center">
                    <p class="text-muted">Coming Soon</p>
                </div>
            </div> <!-- /.card-body -->
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header py-3 px-3">
                <div class="row d-flex align-items-center">
                    <h1 class="col text-start fs-5">Loker</h1>
                    <a href="#" class="col text-end" role="button" data-bs-toggle="modal"
                        data-bs-target="#devModal">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body py-4">
                <div class="row text-center g-2 d-flex justify-content-center align-items-center">
                    <p class="text-muted">Coming Soon</p>
                </div>
            </div> <!-- /.card-body -->
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.html" role="button" data-bs-toggle="modal"
                            data-bs-target="#devModal">
                            <span>
                                <i class="nav-icon bi bi-house"></i>
                                <span class="nav-text">Beranda</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="stats.html" role="button" data-bs-toggle="modal"
                            data-bs-target="#devModal">
                            <span>
                                <i class="nav-icon bi bi-chat-dots"></i>
                                <span class="nav-text">Forum</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item centerbutton">
                        <a href="nunuters.html" class="nav-link p-0 border-0 bg-transparent" role="button"
                            data-bs-toggle="modal" data-bs-target="#devModal">
                            <span
                                class="theme-radial-gradient d-flex justify-content-center align-items-center flex-column gap-0"
                                style="transform: translateY(15px)">
                                <img src="{{ asset('assets/img/pacitan_kab.png') }}" alt=""
                                    style="width: 35px; height: 40px; margin-bottom: 0; display: block; line-height: 1;" />
                                {{-- <span class="fw-bold text-outline"
                                        style="margin: 0; padding: 0; line-height: 1;">NUNUTERS</span> --}}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rewards.html" role="button" data-bs-toggle="modal"
                            data-bs-target="#devModal">
                            <span>
                                <i class="nav-icon bi bi-map"></i>
                                <span class="nav-text">Pariwisata</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="wallet.html" role="button" data-bs-toggle="modal"
                            data-bs-target="#devModal">
                            <span>
                                <i class="nav-icon bi bi-search"></i>
                                <span class="nav-text">Loker</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>
        <!-- Footer ends-->
    @endsection
