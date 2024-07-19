@extends('layouts.app')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('/home/pegawai/tambah') }}" method="POST">
            @csrf
            <div class="card-body ms-5">

                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Nama Pegawai : </label>
                    <input type="text" name="name"
                        class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                        placeholder="Masukkan Nama" value="{{ old('name') }}">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Username Pegawai : </label>
                    <input type="text" name="username"
                        class="form-control @error('username')
                                                is-invalid
                                            @enderror"
                        placeholder="Masukkan Username" value="{{ old('username') }}">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Email : </label>
                    <input type="email" name="email"
                        class="form-control @error('email')
                                                is-invalid
                                            @enderror"
                        placeholder="Masukkan Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Nomor Hp : </label>
                    <input type="text" name="no_hp"
                        class="form-control @error('no_hp')
                                                is-invalid
                                            @enderror"
                        placeholder="Masukkan Nomor Hp" value="{{ old('no_hp') }}">
                    @error('no_hp')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Password Pegawai : </label>
                    <input type="text" name="password"
                        class="form-control @error('password')
                                                is-invalid
                                            @enderror"
                        placeholder="Masukkan Password Pegawai" value="{{ old('password') }}">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <label for="exampleInputEmail1">Posisi Pegawai : </label>
                    <select name="role"
                        class="form-control @error('role')
                                                is-invalid
                                            @enderror"
                        id="" value="{{ old('role') }}">
                        <option value="">--- Pilih Posisi ---</option>
                        <option value="DAPUR">Dapur</option>
                        <option value="KASIR">Kasir</option>
                    </select>
                    @error('role')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
@endsection
