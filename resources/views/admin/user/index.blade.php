@extends('admin.layouts.master')
@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ $title }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{ route('user.create') }}" class="btn btn-md bg-green">Tambah</a>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Perguruan Tinggi</th>
                                    <th>Kota</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->nama}}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->perguruan->nama ?? "-" }}</td>
                                        <td>{{ $user->kotaPerguruan->nama ?? "-" }}</td>
                                        <td>
                                            <a class="btn btn-warning" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                            <a class="btn btn-info border-0" href="{{ route('user.show', $user->id) }}">Detail</a>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display: inline;">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                                                <button class="btn btn-danger border-0"
                                                    onclick="return confirm('Yakin ingin hapus data ini?')">Hapus</button>
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
