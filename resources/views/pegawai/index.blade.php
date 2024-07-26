@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Pegawai</b></h3>
            <div class="card-tools">
                <a href="{{ url('/dashboard/pegawai/tambah') }}" class="btn btn-success"><i class="fa fa-plus"
                        aria-hidden="true"></i> Tambah Pegawai</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kerja Dioutlet</th>
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
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#info-modal{{ $item->user_id }}">
                                    Info
                                </button>
                                <div class="modal fade" id="info-modal{{ $item->user_id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                @foreach ($item->outletWorks as $outlet)
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nama Outlet : </label>
                                                        <input type="text" name="category_name" class="form-control"
                                                            placeholder="Masukkan Nama" value="{{ $outlet->outlet_name }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Alamat Outlet : </label>
                                                        <input type="text" name="category_name" class="form-control"
                                                            placeholder="Masukkan Nama" value="{{ $outlet->address }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nomor Telp Outlet : </label>
                                                        <input type="text" name="category_name" class="form-control"
                                                            placeholder="Masukkan Nama" value="{{ $outlet->phone }}">
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->getRoleNames()->implode(', ') }}</td>
                            <td>
                                <form action="{{ url('/dashboard/pegawai/hapus', $item->user_id) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/dashboard/pegawai/edit', $item->user_id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
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
