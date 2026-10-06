@extends('admin.layouts.master')
@section('container')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Kecamatan</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('kecamatan.update', $kecamatan->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kecamatan</label>
                                <input required type="text" class="form-control"
                                    value="{{ old('nama', $kecamatan->nama) }}" name="nama" placeholder="Masukkan Nama Kecamatan">
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <a href="{{ route('kecamatan.index') }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
