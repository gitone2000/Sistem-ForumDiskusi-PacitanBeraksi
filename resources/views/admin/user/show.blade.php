@extends('admin.layouts.master')
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Detail Biodata User</h1>
</section>

<section class="content">
    <div class="row">
        <!-- Left column -->
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ $user->nama }}</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $user->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>{{ $user->nim }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ ucfirst($user->jenis_kelamin) }}</td>
                        </tr>
                        <tr>
                            <th>Tempat, Tanggal Lahir</th>
                            <td>{{ $user->tempat_lahir }}, {{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>No. Whatsapp</th>
                            <td>{{ $user->whatsapp }}</td>
                        </tr>
                        <tr>
                            <th>Kecamatan</th>
                            <td>{{ $user->kecamatan?->nama }}</td>
                        </tr>
                        <tr>
                            <th>Desa</th>
                            <td>{{ $user->desa?->nama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Lengkap</th>
                            <td>{{ $user->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Bidang Keilmuan</th>
                            <td>{{ $user->bidang?->nama }}</td>
                        </tr>
                        <tr>
                            <th>Perguruan Tinggi</th>
                            <td>{{ $user->perguruan?->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kota Perguruan Tinggi</th>
                            <td>{{ $user->kotaPerguruan?->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jenjang</th>
                            <td>{{ $user->jenjang }}</td>
                        </tr>
                        <tr>
                            <th>Program Studi</th>
                            <td>{{ $user->program_studi }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Masuk</th>
                            <td>{{ $user->tahun_masuk }}</td>
                        </tr>
                        <tr>
                            <th>LinkedIn</th>
                            <td>
                                @if($user->linkedin)
                                    <a href="{{ $user->linkedin }}" target="_blank">Lihat LinkedIn</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Portofolio</th>
                            <td>
                                @if($user->portofolio)
                                    <a href="{{ $user->portofolio }}" target="_blank">Lihat Portofolio</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Instagram</th>
                            <td>
                                @if($user->ig)
                                    <a href="{{ $user->ig }}" target="_blank">{{ $user->ig }}</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right column -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Foto Diri</h3>
                </div>
                <div class="box-body text-center">
                    @if ($user->foto_diri)
                        <img src="{{ asset('storage/' . $user->foto_diri) }}" class="img-responsive" style="max-height: 300px; margin: auto;" alt="Foto Diri">
                    @else
                        <p>- Tidak ada foto -</p>
                    @endif
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Kartu Tanda Mahasiswa</h3>
                </div>
                <div class="box-body text-center">
                    @if ($user->ktm)
                        <img src="{{ asset('storage/' . $user->ktm) }}" class="img-responsive" style="max-height: 300px; margin: auto;" alt="KTM">
                    @else
                        <p>- Tidak ada KTM -</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Footer with buttons -->
    <div class="box-footer">
        <button onclick="window.history.back()" class="btn btn-default">Kembali</button>
    </div>
</section>
@endsection
