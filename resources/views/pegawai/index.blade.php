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
            <div class="mbuh col-6 text-center mx-auto my-4">
                <form action="{{ url('/dashboard/pegawai') }}" method="get">
                    <div class="row">
                        <div class="col-9">
                            <select name="outlet" class="form-control" id="">
                                <option value="" selected>-- Pilih Outlet --</option>
                                @foreach ($outlet as $item)
                                    <option value="{{ $item->slug }}"
                                        {{ request('outlet') == $item->slug ? 'selected' : '' }}>{{ $item->outlet_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 d-flex">
                            <button type="submit" class="btn btn-primary mr-2">Cari</button>
                            <a href="{{ url('/dashboard/pegawai') }}" type="submit" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kerja Dioutlet</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pegawais as $item)
                        @if ($item->user_id == Auth::getuser()->user_id)
                            @continue
                        @endif
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#info-modal{{ $item->username }}">
                                    Info
                                </button>
                                <div class="modal fade" id="info-modal{{ $item->username }}">
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
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" data-id="{{ $item->username }}"
                                        class="custom-control-input status-akun" id="{{ $item->username }}"
                                        {{ $item->is_active ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $item->username }}"></label>
                                </div>
                            </td>
                            <td>
                                <form action="{{ url('/dashboard/pegawai/hapus', $item->email) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/dashboard/pegawai/edit', $item->email) }}"
                                        class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger delete">Delete</button>
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
            $('.status-akun').change(function() {
                let $checkbox = $(this);
                let username = $checkbox.data('id');
                let statusCheked = $checkbox.is(':checked') ? 1 : 0;
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: "/dashboard/pegawai/status-akun/" + username,
                    method: "PATCH",
                    contentType: "application/json",
                    success: function(response) {
                        toastr.success("Berhasil");
                    },
                    error: function(xhr, status, error) {
                        $checkbox.prop('checked', !statusCheked);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                        })
                    },
                });
            })
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
