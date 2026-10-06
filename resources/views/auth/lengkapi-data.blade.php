@extends('layouts.auth')

@section('content')

        <div class="row h-100">
            <div class="col-12 text-center mb-auto px-0">
                <header class="header">
                    <div class="row">
                        <div class="col-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-light btn-44 invisible">
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="col align-self-center text-center">
                            <div class="logo-small">
                                <img src="assets/img/pacitan_kab.png" alt="">
                                <h5>Lengkapi Data</h5>
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
                            @php
                                $user = Auth::user();
                            @endphp
                            <form method="POST" action="{{ route('lengkapi.data.simpan') }}" enctype="multipart/form-data" class="was-validated">
                                @csrf
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                <div class="col align-self-center mb-3">
                                    <h5>Data Diri</h5>
                                </div>

                                <!-- Nama Lengkap (sudah ada dari registrasi) -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="text" class="form-control" name="nama" value="{{ $user->nama }}">
                                    <label for="nama">Nama Lengkap</label>
                                </div>

                                <!-- NIM -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="text" class="form-control" name="nim" value="{{ $user->nim }}">
                                    <label for="nim">NIM</label>
                                </div>

                                <!-- Email -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                    <label for="email">Email</label>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="form-floating is-valid mb-3">
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ (old('jenis_kelamin') ?? $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ (old('jenis_kelamin') ?? $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    @error('jenis_kelamin')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required value="{{ old('tempat_lahir', $user->tempat_lahir) }}">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    @error('tempat_lahir')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="date" class="form-control" name="tanggal_lahir" required value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    @error('tanggal_lahir')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- WhatsApp -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="text" class="form-control" name="whatsapp" value="{{ $user->whatsapp }}">
                                    <label for="whatsapp">Nomor WhatsApp</label>
                                </div>

                                <div class="col align-self-center mb-3">
                                    <h5>Alamat</h5>
                                </div>

                                <!-- Kecamatan -->
                                <div class="form-floating is-valid mb-3">
                                    <select class="form-select" id="kecamatan" name="kecamatan_id" required>
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach ($kecamatans as $kecamatan)
                                            <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', $user->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
                                                {{ $kecamatan->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="kecamatan">Kecamatan</label>
                                    @error('kecamatan_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Desa -->
                                <div class="form-floating is-valid mb-3">
                                    <select class="form-select" id="desa" name="desa_id" required>
                                        <option value="">Pilih Desa</option>
                                        {{-- Nanti akan diisi otomatis oleh JavaScript --}}
                                    </select>
                                    <label for="desa">Desa</label>
                                    @error('desa_id')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="form-floating is-valid mb-3">
                                    <textarea class="form-control" name="alamat" placeholder="Alamat" required>{{ old('alamat', $user->alamat) }}</textarea>
                                    <label for="alamat">Alamat Lengkap</label>
                                    @error('alamat')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col align-self-center mb-3">
                                    <h5>Pendidikan</h5>
                                </div>

                                <!-- Bidang -->
                                @php
                                    $selectedBidang = old('bidang_id', $user->bidang_id);
                                @endphp
                                <div class="form-floating is-valid mb-3">
                                    <select id="bidang_id" name="bidang_id" class="form-control" required>
                                        <option value="" disabled>Pilih ketik bidang...</option>
                                         {{-- Tambahkan value dari user jika belum ada di list --}}
                                        @if(!collect($bidangs)->pluck('id')->contains($selectedBidang))
                                            <option value="{{ $selectedBidang }}" selected>{{ $selectedBidang }}</option>
                                        @endif
                                        {{-- Opsi dari tabel bidangs --}}
                                        @foreach($bidangs as $bidang)
                                            <option value="{{ $bidang->id }}" {{ $selectedBidang == $bidang->id ? 'selected' : '' }}>
                                                {{ $bidang->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="bidang">Bidang Keilmuan</label>
                                </div>

                                <!-- Perguruan -->
                                @php
                                    $selectedPerguruan = old('perguruan_id', $user->perguruan_id);
                                @endphp
                                <div class="form-floating is-valid mb-3">
                                    <select id="perguruan_id" name="perguruan_id" class="form-control" required>
                                        <option value="" disabled>Pilih perguruan...</option>
                                        {{-- Tambahkan value dari user jika belum ada di list --}}
                                        @if(!collect($perguruans)->pluck('id')->contains($selectedPerguruan))
                                        <option value="{{ $selectedPerguruan }}" selected>{{ $selectedPerguruan }}</option>
                                        @endif
                                        {{-- Opsi dari tabel bidangs --}}
                                        @foreach($perguruans as $perguruan)
                                            <option value="{{ $perguruan->id }}" {{ $selectedPerguruan == $perguruan->id ? 'selected' : '' }}>
                                                {{ $perguruan->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="perguruan">Perguruan Tinggi</label>
                                </div>

                                <!--Kota Perguruan -->
                                @php
                                    $selectedKotaPerguruan = old('kota_perguruan_id', $user->kota_perguruan_id);
                                @endphp
                                <div class="form-floating is-valid mb-3">
                                    <select id="kota_perguruan_id" name="kota_perguruan_id" class="form-control" required>
                                        <option value="" disabled>Pilih perguruan...</option>
                                        {{-- Tambahkan value dari user jika belum ada di list --}}
                                        @if(!collect($kota_perguruans)->pluck('id')->contains($selectedKotaPerguruan))
                                        <option value="{{ $selectedKotaPerguruan }}" selected>{{ $selectedKotaPerguruan }}</option>
                                        @endif
                                        {{-- Opsi dari tabel bidangs --}}
                                        @foreach($kota_perguruans as $kota_perguruan)
                                            <option value="{{ $kota_perguruan->id }}" {{ $selectedKotaPerguruan == $kota_perguruan->id ? 'selected' : '' }}>
                                                {{ $kota_perguruan->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="kota_perguruan">Kota Perguruan Tinggi</label>
                                </div>

                                <!-- Jenjang -->
                                @php
                                    $selectedJenjang = old('jenjang', $user->jenjang);
                                @endphp
                                <div class="form-floating is-valid mb-3">
                                    <select id="jenjang" name="jenjang" class="form-control" required>
                                        <option value="" disabled>Pilih jenjang perguruan...</option>
                                        <option value="Diploma 1 (D1)" {{ $selectedJenjang == 'Diploma 1 (D1)' ? 'selected' : '' }}>Diploma 1 (D1)</option>
                                        <option value="Diploma 2 (D2)" {{ $selectedJenjang == 'Diploma 2 (D2)' ? 'selected' : '' }}>Diploma 2 (D2)</option>
                                        <option value="Diploma 3 (D3)" {{ $selectedJenjang == 'Diploma 3 (D3)' ? 'selected' : '' }}>Diploma 3 (D3)</option>
                                        <option value="Sarjana (S1)" {{ $selectedJenjang == 'Sarjana (S1)' ? 'selected' : '' }}>Sarjana (S1)</option>
                                        <option value="Magister (S2)" {{ $selectedJenjang == 'Magister (S2)' ? 'selected' : '' }}>Magister (S2)</option>
                                        <option value="Doktor (S3)" {{ $selectedJenjang == 'Doktor (S3)' ? 'selected' : '' }}>Doktor (S3)</option>
                                    </select>
                                    <label for="jenjang">Jenjang Perguruan</label>
                                </div>

                                <!-- Program Studi -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="text" class="form-control" name="program_studi" value="{{ $user->program_studi }}">
                                    <label for="program_studi">Program Studi</label>
                                </div>

                                <!-- tahun_masuk -->
                                <div class="form-floating is-valid mb-3">
                                    <input id="tahun_masuk" type="number" class="form-control" name="tahun_masuk" placeholder="Tahun Masuk (opsional)" value="{{ old('tahun_masuk', $user->tahun_masuk) }}"  min="1980" max="2100" required>
                                    <label for="tahun_masuk">Tahun Masuk</label>
                                </div>

                                <div class="col align-self-center mb-3">
                                    <h5>Lampiran</h5>
                                </div>

                                <!-- Foto Diri -->
                                <div class="mb-3">
                                    <label for="foto_diri" class="form-label">Foto Diri (Opsional)</label>
                                    <input type="file" class="form-control" name="foto_diri" id="foto_diri" accept="image/*" onchange="previewImage(this, 'previewFotoDiri')">
                                    <img id="previewFotoDiri" class="img-fluid mt-2 d-none rounded border" style="max-height: 200px;" />
                                    @if($user->foto_diri)
                                        <div class="mt-2">
                                            <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $user->foto_diri) }}" target="_blank">Lihat</a></small>
                                        </div>
                                    @endif
                                </div>

                                <!-- KTM -->
                                <div class="mb-3">
                                    <label for="ktm" class="form-label">Kartu Tanda Mahasiswa KTM (Opsional)</label>
                                    <input type="file" class="form-control" name="ktm" id="ktm" accept="image/*" onchange="previewImage(this, 'previewFotoKtm')">
                                    <img id="previewFotoKtm" class="img-fluid mt-2 d-none rounded border" style="max-height: 200px;" />
                                    @if($user->ktm)
                                        <div class="mt-2">
                                            <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $user->ktm) }}" target="_blank">Lihat</a></small>
                                        </div>
                                    @endif
                                </div>

                                <!-- LinkedIn -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="url" class="form-control" name="linkedin" placeholder="LinkedIn (opsional)" value="{{ old('linkedin', $user->linkedin) }}">
                                    <label for="linkedin">LinkedIn (Opsional)</label>
                                </div>

                                <!-- Portofolio -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="url" class="form-control" name="portofolio" placeholder="Portofolio (opsional)" value="{{ old('portofolio', $user->portofolio) }}">
                                    <label for="portofolio">Portofolio (Opsional)</label>
                                </div>

                                <!-- IG -->
                                <div class="form-floating is-valid mb-3">
                                    <input type="url" class="form-control" name="ig" placeholder="IG (opsional)" value="{{ old('ig', $user->ig) }}">
                                    <label for="ig">Instagram (Opsional)</label>
                                </div>

                                <button type="submit" class="btn btn-lg btn-default w-100 mb-4 shadow">
                                    Simpan & Lanjut ke Dashboard
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function loadDesas(kecamatanID, selectedDesaID = null) {
                if (kecamatanID) {
                    $.ajax({
                        url: '/get-desas/' + kecamatanID,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#desa').empty();
                            $('#desa').append('<option value="">Pilih Desa</option>');
                            $.each(data, function (key, value) {
                                var isSelected = selectedDesaID == key ? 'selected' : '';
                                $('#desa').append('<option value="' + key + '" ' + isSelected + '>' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#desa').empty().append('<option value="">Pilih Desa</option>');
                }
            }
    
            // Trigger saat user ganti kecamatan
            $('#kecamatan').on('change', function () {
                var kecamatanID = $(this).val();
                loadDesas(kecamatanID);
            });
    
            // Load otomatis saat halaman dibuka jika sedang edit
            var selectedKecamatanID = "{{ old('kecamatan_id', $user->kecamatan_id) }}";
            var selectedDesaID = "{{ old('desa_id', $user->desa_id) }}";
    
            if (selectedKecamatanID) {
                loadDesas(selectedKecamatanID, selectedDesaID);
            }
        });
    </script>
@endsection
