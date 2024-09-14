@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"></h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-0 px-3 mt-4">
            <form action="{{ url('/dashboard/superadmin/edit-pemilik', $user->email) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body ms-5">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pemilik Resto : </label>
                                <input type="text" name="name"
                                    class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Nama" value="{{ $user->name }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username Pemilik Resto : </label>
                                <input type="text" name="username"
                                    class="form-control @error('username')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Username" value="{{ $user->username }}">
                                @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email : </label>
                                <input type="email" name="email"
                                    class="form-control @error('email')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Hp : </label>
                                <input type="text" name="no_hp"
                                    class="form-control @error('no_hp')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Nomor Hp" value="{{ $user->phone }}">
                                @error('no_hp')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password Pemilik Resto : ( Opsional )</label>
                                <input type="text" name="password"
                                    class="form-control @error('password')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Password Pemilik Resto">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
