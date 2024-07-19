@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Pegawai</b></h3>
            <div class="card-tools">
                <a href="{{ url('/home/pegawai/tambah') }}" class="btn btn-success"><i class="fa fa-plus"
                        aria-hidden="true"></i> Tambah Pegawai</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger col-5 text-center">
                    {{ session('error') }}
                </div>
            @endif
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Posisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawais as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->getRoleNames()->implode(', ') }}</td>
                            <td>
                                <form action="{{ url('/home/pegawai/hapus', $item->user_id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="" class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
