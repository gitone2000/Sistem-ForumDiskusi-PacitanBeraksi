@extends('admin.layouts.master')
@section('container')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Perguruan Tinggi</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="{{ route('perguruan.update', $perguruan->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Perguruan Tinggi</label>
                                <input required type="text" class="form-control"
                                    value="{{ old('nama', $perguruan->nama) }}" name="nama" placeholder="Masukkan Nama Perguruan Tinggi">
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <a href="{{ route('perguruan.index') }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
