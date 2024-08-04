@extends('layouts.app')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('/dashboard/pegawai/edit', $data->email) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body ms-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Pegawai : </label>
                            <input type="text" name="name"
                                class="form-control @error('name')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan Nama" value="{{ $data->name }}">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username Pegawai : </label>
                            <input type="text" name="username"
                                class="form-control @error('username')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan Username" value="{{ $data->username }}">
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
                                placeholder="Masukkan Email" value="{{ $data->email }}">
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
                                placeholder="Masukkan Nomor Hp" value="{{ $data->phone }}">
                            @error('no_hp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Pegawai : </label>
                            <input type="text" name="password"
                                class="form-control @error('password')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan Password Pegawai">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Posisi Pegawai : </label>
                            <select name="role"
                                class="form-control @error('role')
                                                is-invalid
                                            @enderror"
                                id="">
                                <option value="">--- Pilih Posisi ---</option>
                                @foreach ($role as $item)
                                    <option value="{{ $item->name }}"
                                        {{ $item->name == $data->getRoleNames()->implode(', ') ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kerja Di Outlet : </label>
                            <div class="row">
                                @foreach ($outlet as $item)
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="outlet[]"
                                                    id="checkboxPrimary3{{ $item->slug }}"
                                                    value="{{ $item->outlet_id }}" @checked(in_array($item->outlet_id, $selectedOutlet))>
                                                <label for="checkboxPrimary3{{ $item->slug }}">
                                                    {{ $item->outlet_name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('outlet')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
