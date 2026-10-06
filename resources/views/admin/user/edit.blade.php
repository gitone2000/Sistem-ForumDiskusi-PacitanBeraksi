@extends('admin.layouts.master')
@section('container')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit User</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Nama --}}
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama"
                                    value="{{ old('nama', $user->nama) }}" required>
                            </div>

                            {{-- NIM --}}
                            <div class="form-group">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim"
                                    value="{{ old('nim', $user->nim) }}">
                            </div>

                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="form-group">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="Laki-laki"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan"
                                        {{ old('jenis_kelamin', $user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            {{-- Tempat dan Tanggal Lahir --}}
                            <div class="form-group">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" name="tempat_lahir"
                                    value="{{ old('tempat_lahir', $user->tempat_lahir) }}">
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}">
                            </div>

                            {{-- WhatsApp --}}
                            <div class="form-group">
                                <label for="whatsapp" class="form-label">No. WhatsApp</label>
                                <input type="text" class="form-control" name="whatsapp"
                                    value="{{ old('whatsapp', $user->whatsapp) }}">
                            </div>

                            {{-- Kecamatan dan Desa --}}
                            <div class="form-group">
                                <label for="kecamatan_id" class="form-label">Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan" class="form-control
                                select2">
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}"
                                            {{ old('kecamatan_id', $user->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
                                            {{ $kecamatan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="desa_id" class="form-label">Desa</label>
                                <select name="desa_id" id="desa" class="form-control
                                select2">
                                    @foreach ($desas as $desa)
                                        <option value="{{ $desa->id }}"
                                            {{ old('desa_id', $user->desa_id) == $desa->id ? 'selected' : '' }}>
                                            {{ $desa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Alamat Lengkap --}}
                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control">{{ old('alamat', $user->alamat) }}</textarea>
                            </div>

                            {{-- Bidang --}}
                            <div class="form-group">
                                <label for="bidang_id" class="form-label">Bidang Keilmuan</label>
                                <select name="bidang_id" class="form-control 
                                select2">
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id }}"
                                            {{ old('bidang_id', $user->bidang_id) == $bidang->id ? 'selected' : '' }}>
                                            {{ $bidang->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Perguruan dan Kota Perguruan --}}
                            <div class="form-group">
                                <label for="perguruan_id" class="form-label">Perguruan Tinggi</label>
                                <select name="perguruan_id" class="form-control 
                                select2">
                                    @foreach ($perguruans as $perguruan)
                                        <option value="{{ $perguruan->id }}"
                                            {{ old('perguruan_id', $user->perguruan_id) == $perguruan->id ? 'selected' : '' }}>
                                            {{ $perguruan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kota_perguruan_id" class="form-label">Kota Perguruan Tinggi</label>
                                <select name="kota_perguruan_id" class="form-control 
                                select2">
                                    @foreach ($kota_perguruans as $kota)
                                        <option value="{{ $kota->id }}"
                                            {{ old('kota_perguruan_id', $user->kota_perguruan_id) == $kota->id ? 'selected' : '' }}>
                                            {{ $kota->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Jenjang, Program Studi, Tahun Masuk --}}
                            <div class="form-group">
                                <label for="jenjang">Jenjang</label>
                                <select id="jenjang" name="jenjang" class="form-control
                                 select2" required>
                                    @php
                                        $jenjangList = [
                                            'D1' => 'Diploma 1 (D1)',
                                            'D2' => 'Diploma 2 (D2)',
                                            'D3' => 'Diploma 3 (D3)',
                                            'S1' => 'Sarjana (S1)',
                                            'S2' => 'Magister (S2)',
                                            'S3' => 'Doktor (S3)',
                                        ];
                                    @endphp
                                    @foreach ($jenjangList as $label)
                                        <option value="{{ $label }}"
                                            {{ old('jenjang', $user->jenjang) == $label ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="program_studi" class="form-label">Program Studi</label>
                                <input type="text" class="form-control" name="program_studi"
                                    value="{{ old('program_studi', $user->program_studi) }}">
                            </div>

                            <div class="form-group">
                                <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                <input type="number" class="form-control" name="tahun_masuk" min="1980" max="2100"
                                    value="{{ old('tahun_masuk', $user->tahun_masuk) }}">
                            </div>

                            {{-- Foto Diri --}}
                            <div class="form-group">
                                <label for="foto_diri" class="form-label">Foto Diri</label>
                                <input type="file" class="form-control" name="foto_diri" accept="image/*">
                                @if ($user->foto_diri)
                                    <small class="text-muted">File saat ini: <a
                                            href="{{ asset('storage/' . $user->foto_diri) }}"
                                            target="_blank">Lihat</a></small>
                                @endif
                            </div>

                            {{-- KTM --}}
                            <div class="form-group">
                                <label for="ktm" class="form-label">KTM</label>
                                <input type="file" class="form-control" name="ktm" accept="image/*">
                                @if ($user->ktm)
                                    <small class="text-muted">File saat ini: <a
                                            href="{{ asset('storage/' . $user->ktm) }}" target="_blank">Lihat</a></small>
                                @endif
                            </div>

                            {{-- Optional Links --}}
                            <div class="form-group">
                                <label for="linkedin" class="form-label">LinkedIn</label>
                                <input type="url" class="form-control" name="linkedin"
                                    value="{{ old('linkedin', $user->linkedin) }}">
                            </div>

                            <div class="form-group">
                                <label for="portofolio" class="form-label">Portofolio</label>
                                <input type="url" class="form-control" name="portofolio"
                                    value="{{ old('portofolio', $user->portofolio) }}">
                            </div>

                            <div class="form-group">
                                <label for="ig" class="form-label">Instagram</label>
                                <input type="text" class="form-control" name="ig"
                                    value="{{ old('ig', $user->ig) }}">
                            </div>

                            {{-- Role --}}
                            <div class="form-group">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-control">
                                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="mahasiswa" {{ $user->role === 'mahasiswa' ? 'selected' : '' }}>
                                        Mahasiswa</option>
                                </select>
                            </div>

                            {{-- Password (kosongkan jika tidak ingin ubah) --}}
                            <div class="form-group">
                                <label for="password" class="form-label">Password (Opsional)</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Kosongkan jika tidak diubah">
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>

                            {{-- Submit --}}
                            <div class="box-footer">
                                <a href="{{ url()->previous() }}" class="btn btn-default">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </form>
                </div>
            </div><!-- /.box -->
        </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadDesas(kecamatanID, selectedDesaID = null) {
                if (kecamatanID) {
                    $.ajax({
                        url: '{{ route('user.getDesa', '') }}/' + kecamatanID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#desa').empty();
                            $('#desa').append('<option value="">Pilih Desa</option>');
                            $.each(data, function(key, value) {
                                var isSelected = selectedDesaID == key ? 'selected' : '';
                                $('#desa').append('<option value="' + key + '" ' + isSelected +
                                    '>' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#desa').empty().append('<option value="">Pilih Desa</option>');
                }
            }

            // Trigger saat user ganti kecamatan
            $('#kecamatan').on('change', function() {
                var kecamatanID = $(this).val();
                loadDesas(kecamatanID);
            });

            // Load otomatis saat halaman dibuka jika sedang edit
            var selectedKecamatanID = "{{ old('kecamatan_id') }}";
            var selectedDesaID = "{{ old('desa_id') }}";

            if (selectedKecamatanID) {
                loadDesas(selectedKecamatanID, selectedDesaID);
            }
        });
    </script>
@endsection
