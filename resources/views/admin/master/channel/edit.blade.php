@extends('admin.layouts.master')

@section('container')
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Channel Forum</h3>
                    </div><!-- /.box-header -->

                    <!-- form start -->
                    <form action="{{ route('channel.update', $channel->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label>Nama Channel</label>
                                <input required type="text" class="form-control"
                                    value="{{ old('nama', $channel->nama) }}" name="nama"
                                    placeholder="Masukkan Nama Channel">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi singkat channel...">{{ old('deskripsi', $channel->deskripsi) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Gambar Channel (Opsional)</label>
                                @if ($channel->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $channel->image) }}" width="150"
                                            class="img-thumbnail">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="hapus_gambar"
                                                value="1" id="hapus_gambar">
                                            <label class="form-check-label" for="hapus_gambar">Hapus gambar ini</label>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" name="gambar" class="form-control">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
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
