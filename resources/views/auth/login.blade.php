@extends('layouts.auth-layout')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">

            </div>
            <div class="card-body">
                <p class="login-box-msg">Silahkan Login Melanjutkan</p>
                @error('login')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <form action="{{ url('auth/login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email"
                            class="form-control @error('email')
                                                is-invalid
                                            @enderror"
                            name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="password" name="password"
                            class="form-control @error('nama_instansi')
                                                password
                                            @enderror"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row">
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
