@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Outlet</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah-modal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Outlet
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <div class="mbuh col-6 text-center mx-auto">
                @error('outlet_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Outlet</th>
                        <th>Alamat</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->outlet_name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <form action="{{ url('/home/outlet', $item->slug) }}" class="form-delete" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#edit-modal{{ $item->slug }}">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-danger delete">Delete</button>
                                </form>
                            </td>
                            <div class="modal fade" id="edit-modal{{ $item->slug }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Outlet</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/home/outlet', $item->slug) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Outlet : </label>
                                                    <input type="text" name="outlet_name"
                                                        class="form-control @error('outlet_name')
                                                is-invalid
                                            @enderror"
                                                        placeholder="Masukkan Nama" value="{{ $item->outlet_name }}">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Alamat Outlet : </label>
                                                    <input type="text" name="address"
                                                        class="form-control @error('address')
                                                is-invalid
                                            @enderror"
                                                        placeholder="Masukkan Alamat" value="{{ $item->address }}">

                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nomor Hp Outlet : </label>
                                                    <input type="text" name="phone"
                                                        class="form-control @error('phone')
                                                is-invalid
                                            @enderror"
                                                        placeholder="Masukkan No Hp" value="{{ $item->phone }}">

                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit Data</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="tambah-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Outlet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/home/outlet') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Outlet : </label>
                                <input type="text" name="outlet_name"
                                    class="form-control @error('outlet_name')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Nama" value="{{ old('outlet_name') }}">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Outlet : </label>
                                <input type="text" name="address"
                                    class="form-control @error('address')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Alamat" value="{{ old('address') }}">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nomor Hp Outlet : </label>
                                <input type="text" name="phone"
                                    class="form-control @error('phone')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan No Hp" value="{{ old('phone') }}">

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Tambah Data</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    @push('js')
        <script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(".delete").click(function() {
                Swal.fire({
                    title: "Apakah Anda yakin ?",
                    text: "Anda Tidak Bisa Mengembalikan Data ini",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                        setTimeout(() => {
                            $('.form-delete').submit();
                        }, 1500);
                    }
                });
            });
        </script>
        @if (session('status'))
            <input type="hidden" id="status" value="{{ session('status') }}">
            <script>
                let msg = $('#status').val();
                toastr.success(msg);
            </script>
        @endif
        @if (session('error'))
            <input type="hidden" id="status" value="{{ session('error') }}">
            <script>
                let msg = $('#status').val();
                toastr.danger(msg);
            </script>
        @endif
    @endpush
@endsection
