@extends('admin.layouts.master')
@section('container')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah User</h3>
                    </div>

                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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

                            {{-- Nama, Email, NIM --}}
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input required type="text" class="form-control" name="nama"
                                    placeholder="Masukkan nama lengkap" value="{{ old('nama') }}">
                            </div>
                            <div class="form-group">
                                <label>NIM (jika mahasiswa)</label>
                                <input type="text" class="form-control" name="nim" placeholder="Opsional"
                                    value="{{ old('nim') }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input required type="email" class="form-control" name="email"
                                    placeholder="Masukkan email" value="{{ old('email') }}">
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                            </div>

                            {{-- Tempat & Tanggal Lahir --}}
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"
                                    value="{{ old('tempat_lahir') }}">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir') }}">
                            </div>

                            {{-- WhatsApp --}}
                            <div class="form-group">
                                <label>No. WhatsApp</label>
                                <input type="text" name="whatsapp" class="form-control" value="{{ old('No. WhatsApp') }}">
                            </div>

                            {{-- Kecamatan Desa --}}
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatan" class="form-control
                                 select2">
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}"
                                            {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                            {{ $kecamatan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Desa</label>
                                <select name="desa_id" id="desa" class="form-control
                                 select2">
                                    <option value="">-- Pilih Desa --</option>
                                    @foreach ($desas as $desa)
                                        <option value="{{ $desa->id }}"
                                            {{ old('desa_id') == $desa->id ? 'selected' : '' }}>{{ $desa->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap...">{{ old('alamat') }}</textarea>
                            </div>

                            {{-- Relasi Akademik --}}
                            <div class="form-group">
                                <label>Bidang Keilmuan</label>
                                <select name="bidang_id" class="form-control
                                 select2">
                                    <option value="">-- Pilih Bidang --</option>
                                    @foreach ($bidangs as $bidang)
                                        <option value="{{ $bidang->id }}"
                                            {{ old('bidang_id') == $bidang->id ? 'selected' : '' }}>{{ $bidang->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Perguruan Tinggi</label>
                                <select name="perguruan_id" class="form-control
                                 select2">
                                    <option value="">-- Pilih Perguruan Tinggi --</option>
                                    @foreach ($perguruans as $perguruan)
                                        <option value="{{ $perguruan->id }}"
                                            {{ old('perguruan_id') == $perguruan->id ? 'selected' : '' }}>
                                            {{ $perguruan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kota Perguruan Tinggi</label>
                                <select name="kota_perguruan_id" class="form-control
                                 select2">
                                    <option value="">-- Pilih Kota --</option>
                                    @foreach ($kota_perguruans as $kota)
                                        <option value="{{ $kota->id }}"
                                            {{ old('kota_perguruan_id') == $kota->id ? 'selected' : '' }}>
                                            {{ $kota->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenjang">Jenjang</label>
                                <select id="jenjang" name="jenjang" class="form-control
                                 select2">
                                    <option value="" {{ empty(old('jenjang')) ? 'selected' : '' }}>Pilih
                                        jenjang perguruan...</option>
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
                                            {{ old('jenjang') == $label ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Program Studi</label>
                                <input type="text" name="program_studi" class="form-control"
                                    placeholder="Contoh: Teknik Informatika" value="{{ old('program_studi') }}">
                            </div>
                            <div class="form-group">
                                <label>Tahun Masuk</label>
                                <input type="number" name="tahun_masuk" class="form-control" min="1980" max="2100"
                                    placeholder="Contoh: 2022" value="{{ old('tahun_masuk') }}">
                            </div>

                            <!-- Foto Diri -->
                            <div class="form-group">
                                <label>Foto Diri</label>
                                <input type="file" name="foto_diri" class="form-control" accept="image/*">
                            </div>

                            <!-- KTM -->
                            <div class="form-group">
                                <label>KTM</label>
                                <input type="file" name="ktm" class="form-control" accept="image/*">
                            </div>

                            {{-- Optional --}}
                            <div class="form-group">
                                <label>LinkedIn</label>
                                <input type="url" name="linkedin" class="form-control"
                                    value="{{ old('linkedin') }}">
                            </div>
                            <div class="form-group">
                                <label>Portofolio</label>
                                <input type="url" name="portofolio" class="form-control"
                                    value="{{ old('portofolio') }}">
                            </div>
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" name="ig" class="form-control" value="{{ old('ig') }}">
                            </div>

                            {{-- Role --}}
                            <div class="form-group">
                                <label>Role</label>
                                <select required name="role" class="form-control">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                    </option>
                                </select>
                            </div>

                            {{-- Password --}}
                            <div class="form-group">
                                <label>Password</label>
                                <input required type="password" class="form-control" name="password"
                                    placeholder="Masukkan password">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input required type="password" class="form-control" name="password_confirmation"
                                    placeholder="Ulangi password">
                            </div>

                        </div>

                        <div class="box-footer">
                            <a href="{{ url()->previous() }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
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
