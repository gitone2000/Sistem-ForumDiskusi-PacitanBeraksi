@extends('admin.layouts.master')

@section('container')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tambah Channel Forum</h3>
                    </div><!-- /.box-header -->

                    <!-- form start -->
                    <form action="{{ route('channel.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama Channel</label>
                                <input required type="text" class="form-control" name="nama"
                                    placeholder="Masukkan Nama Channel">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi singkat channel..."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Gambar Channel (Opsional)</label>
                                <input type="file" name="gambar" class="form-control">
                                <small class="text-muted">Ukuran maksimal 2MB. Format: jpg, png, jpeg.</small>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <a href="{{ route('channel.index') }}" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection
