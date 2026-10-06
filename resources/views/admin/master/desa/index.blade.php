@extends('admin.layouts.master')
@section('container')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Desa
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{{ route('desa.create') }}" class="btn btn-md bg-green">Tambah</a>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Desa</th>
                                    <th>Kecamatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            @foreach ($desas as $desa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $desa->nama }}</td>
                                    <td>{{ $desa->kecamatan->nama ?? '-' }}</td>
                                    <td>
                                        {{-- <a class="btn btn-info" href="{{ route('users.show', $key->id) }}">Show</a> --}}
                                        <a class="btn btn-warning" href="{{ route('desa.edit', $desa->id) }}">Edit</a>
                                        <form action="{{ route('desa.destroy', $desa->id) }}" method="post" style="display: inline;">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger border-0 "
                                                onclick="return confirm('Yakin ingin hapus Desa ini')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection
