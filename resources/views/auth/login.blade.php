@extends('layouts.auth')

@section('content')

        <div class="row h-100 overflow-auto">
            <div class="col-12 text-center mb-4 px-0">
                <header class="header">
                    <div class="row">
                        <div class="col-auto"></div>
                        <div class="col">
                            <div class="logo-small">
                                <img src="assets/img/pacitan_kab.png" alt="">
                                <h5>PACITAN BERAKSI</h5>
                            </div>
                        </div>
                        <div class="col-auto"></div>
                    </div>
                </header>
            </div>

            <div class="container h-100 w-100 d-flex justify-content-center align-items-center">
            <div class="row w-100 d-flex h-100 justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-center py-0 mb-5">
                <div class="auth-box mx-auto" >

                <h1 class="mb-4 text-color-theme">Login</h1>
                <form action="{{ url('/login') }}" method="POST" class="was-validated needs-validation" novalidate>
                    @csrf
                    <div class="form-group form-floating mb-3 is-valid">
                        <input type="text" class="form-control" value="" id="email" name="email" placeholder="Email">
                        <label class="form-control-label" for="email">Email</label>
                        @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-floating is-invalid mb-3">
                        <input type="password" class="form-control " id="password" name="password" placeholder="Password">
                        <label class="form-control-label" for="password">Password</label>
                        @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <p class="mb-3 text-center">
                        <a href="#" class="">
                            Lupa Password
                        </a>
                    </p>
                    <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow">
                        Login
                    </button>

                </form>
                <p class="mb-2 text-muted">Belum Punya Akun?</p>
                <a href="{{ route('register') }}" target="_self" class="">
                    Daftar Sekarang <i class="bi bi-arrow-right"></i>
                </a>
                </div>
            </div>
            </div>
        </div>
        </div>

@endsection
