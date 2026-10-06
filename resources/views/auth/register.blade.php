@extends('layouts.auth')

@section('content')

        <div class="row h-100">
            <div class="col-12 text-center mb-auto px-0">
                <header class="header">
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{ route('login') }}" target="_self" class="btn btn-light btn-44">
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </div>
                        <div class="col align-self-center text-center">
                            <div class="logo-small">
                                <img src="assets/img/pacitan_kab.png" alt="">
                                <h5>Daftar</h5>
                            </div>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-light btn-44 invisible"></a>
                        </div>
                    </div>
                </header>
            </div>
        <div class="container">
        <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-center py-2">
            <div class="auth-box mx-auto">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <form method="POST" action="{{ route('register') }}" class="was-validated">
                    @csrf

            <!-- Nama -->
            <div class="form-floating is-valid mb-3">
                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap" id="nama" required>
                <label for="nama">Masukkan Nama Lengkap</label>
                @error('nama')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- NIM -->
            <div class="form-floating is-valid mb-3">
                <input type="text" class="form-control" name="nim" value="{{ old('nim') }}" placeholder="NIM" id="nim" required>
                <label for="nim">Masukkan NIM</label>
                @error('nim')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="form-floating is-valid mb-3">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" id="email" required>
                <label for="email">Masukkan Email</label>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Bidang Keilmuan -->
            <div class="form-floating is-valid mb-3">
                <select id="bidang_id" name="bidang_id" class="form-control" required>
                    <option value="">Pilih atau ketik bidang...</option>
                    @foreach($bidangs as $bidang)
                        <option value="{{ $bidang->id }}">{{ $bidang->nama }}</option>
                    @endforeach
                </select>
                <label for="bidang_id">Bidang Keilmuan</label>
                @error('bidang_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Perguruan Tinggi -->
            <div class="form-floating is-valid mb-3">
                <select id="perguruan_id" name="perguruan_id" class="form-control" required>
                    <option value="">Pilih atau ketik perguruan tinggi...</option>
                    @foreach($perguruans as $perguruan)
                        <option value="{{ $perguruan->id }}">{{ $perguruan->nama }}</option>
                    @endforeach
                </select>
                <label for="perguruan_id">Perguruan Tinggi</label>
                @error('perguruan_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kota Perguruan -->
            <div class="form-floating is-valid mb-3">
                <select id="kota_perguruan_id" name="kota_perguruan_id" class="form-control" required>
                    <option value="">Pilih atau ketik kota perguruan tinggi...</option>
                    @foreach($kota_perguruans as $kota_perguruan)
                        <option value="{{ $kota_perguruan->id }}">{{ $kota_perguruan->nama }}</option>
                    @endforeach
                </select>
                <label for="kota_perguruan_id">Kota Perguruan Tinggi</label>
                @error('kota_perguruan_id')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jenjang -->
            <div class="form-floating is-valid mb-3">
                <select id="jenjang" name="jenjang" class="form-control" required>
                    <option value="">Pilih jenjang perguruan...</option>
                    <option value="Diploma 1 (D1)">Diploma 1 (D1)</option>
                    <option value="Diploma 2 (D2)">Diploma 2 (D2)</option>
                    <option value="Diploma 3 (D3)">Diploma 3 (D3)</option>
                    <option value="Sarjana (S1)">Sarjana (S1)</option>
                    <option value="Magister (S2)">Magister (S2)</option>
                    <option value="Doktor (S3)">Doktor (S3)</option>
                </select>
                <label for="jenjang">Jenjang Perguruan</label>
                @error('jenjang')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Program Studi -->
            <div class="form-floating is-valid mb-3">
                <input type="text" class="form-control" name="program_studi" value="{{ old('program_studi') }}" placeholder="Program Studi" id="program" required>
                <label for="program">Masukkan Program Studi</label>
                @error('program_studi')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- WhatsApp -->
            <div class="form-floating is-valid mb-3">
                <input type="text" class="form-control" name="whatsapp" value="{{ old('whatsapp') }}" placeholder="No WhatsApp" id="whatsapp" required>
                <label for="whatsapp">Masukkan No WhatsApp</label>
                @error('whatsapp')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-floating is-valid mb-3">
                <input type="password" class="form-control" name="password" placeholder="Minimal 6 karakter" id="password" required minlength="6">
                <label for="password">Masukkan Password</label>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="form-floating is-invalid mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" id="confirmpassword" required>
                <label for="confirmpassword">Ulangi Password</label>
            </div>

            <p class="mb-3">
                <span class="text-muted">Dengan mengklik tombol Daftar, Anda setuju dengan ketentuan berikut:</span>
                <a href="">Syarat dan Ketentuan</a>
            </p>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow">
                Daftar
            </button>

                </form>
            </div>
        </div>
        </div>
    </div>
    </div>
    
@endsection

