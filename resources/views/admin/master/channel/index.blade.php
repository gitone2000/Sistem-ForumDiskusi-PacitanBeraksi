@extends('admin.layouts.master')

@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manajemen Channel Forum
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{ route('channel.create') }}" class="btn btn-md bg-green">Tambah</a>
                    </div><!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Channel</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($channels as $channel)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $channel->nama }}</td>
                                        <td>{{ $channel->deskripsi }}</td>
                                        <td>
                                            @if ($channel->image)
                                                <img src="{{ asset('storage/' . $channel->image) }}" alt="gambar channel"
                                                    width="80">
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-warning"
                                                href="{{ route('channel.edit', $channel->id) }}">Edit</a>
                                            <form action="{{ route('channel.destroy', $channel->id) }}" method="post"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger"
                                                    onclick="return confirm('Yakin ingin hapus channel ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection
