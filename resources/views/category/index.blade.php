@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Kategori Produk</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah-modal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Kategori
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <form action="{{ url('/dashboard/kategori') }}" method="GET">
                <div class="row d-flex justify-content-center mt-3">
                    <div class="col-4">
                        <select name="outlet" class="form-control" id="">
                            <option value="" selected>-- Semua Outlet --</option>
                            @foreach ($outlet as $item)
                                <option value="{{ $item->slug }}"
                                    {{ request('outlet') == $item->slug ? 'selected' : '' }}>
                                    {{ $item->outlet_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            @error('category_name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('outlet')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->category_name }}</td>
                            <td>
                                <form action="{{ url('/dashboard/kategori', $item->slug) }}"class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#edit-modal{{ $item->slug }}">
                                        Edit
                                    </button>
                                    <button type="submit" class="btn btn-danger delete">Delete</button>
                                </form>
                            </td>
                            <div class="modal fade" id="edit-modal{{ $item->slug }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Kategori</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/dashboard/kategori', $item->slug) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Kategori : </label>
                                                    <input type="text" name="category_name"
                                                        class="form-control @error('category')
                                                is-invalid
                                            @enderror"
                                                        placeholder="Masukkan Nama" value="{{ $item->category_name }}">
                                                    @error('category')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
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
                        <h4 class="modal-title">Tambah Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/kategori') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Kategori : </label>
                                <input type="text" name="category_name"
                                    class="form-control @error('category')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Nama" value="{{ old('category') }}">
                                @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="outlet" class="form-control" id="">
                                    <option value="" selected>-- Semua Outlet --</option>
                                    @foreach ($outlet as $item)
                                        <option value="{{ $item->slug }}">
                                            {{ $item->outlet_name }}
                                        </option>
                                    @endforeach
                                </select>
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
            $(".form-delete").submit(function(e) {
                e.preventDefault();
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
                            $(this)[0].submit();
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
