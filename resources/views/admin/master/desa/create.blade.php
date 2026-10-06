@extends('admin.layouts.master')
@section('container')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Desa</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('desa.store') }}" method="POST">
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label for="kecamatan">Pilih Kecamatan</label>
                                <select name="kecamatan_id" class="form-control 
                                 select2" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach ($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Desa</label>
                                <input required type="text" class="form-control" name="nama"
                                    placeholder="Masukkan Nama Desa">
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <a href="{{ route('desa.index') }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
