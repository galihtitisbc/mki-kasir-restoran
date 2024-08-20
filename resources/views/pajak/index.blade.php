@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Pajak</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah-modal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Pajak
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <form action="{{ url('/dashboard/pajak') }}" method="GET">
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
            <div class="col-4 text-center mx-auto mt-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="text-center">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <table class="table table-hover text-center mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pajak</th>
                        <th>Pajak Rate ( % )</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tax as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tax_name }}</td>
                            <td>{{ $item->tax_rate }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" data-id="{{ $item->slug }}"
                                        class="custom-control-input status-tax" id="{{ $item->slug }}"
                                        {{ $item->status ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $item->slug }}"></label>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('pajak.destroy', $item->slug) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="btn btn-warning" data-toggle="modal"
                                        data-target="#edit-modal{{ $item->slug }}">
                                        Edit
                                    </button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                            <div class="modal fade" id="edit-modal{{ $item->slug }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Pajak</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/dashboard/pajak', $item->slug) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Pajak : </label>
                                                    <input type="text" name="tax_name"
                                                        class="form-control @error('tax_name')
                                                is-invalid
                                            @enderror"
                                                        placeholder="Masukkan Nama" value="{{ $item->tax_name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Besaran Pajak ( % ) : </label>
                                                    <input type="text" name="tax_rate"
                                                        class="form-control @error('tax_rate')
                                                is-invalid
                                            @enderror"
                                                        placeholder="Masukkan Nama" value="{{ $item->tax_rate }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Deskripsi Pajak : </label>
                                                    <input type="text" name="description"
                                                        class="form-control @error('description')
                                                is-invalid
                                            @enderror"
                                                        placeholder="Masukkan Nama" value="{{ $item->description }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="outlet">Pilih Outlet:</label>
                                                    <select class="pajak-select" name="outlet_id[]" multiple="multiple"
                                                        data-placeholder="Pilih Outlet" style="width: 100%;">
                                                        <option value=""> -- Pilih Outlet --</option>
                                                        @foreach ($outlet as $o)
                                                            <option value="{{ $o->outlet_id }}"
                                                                {{ $item->outlets->contains('outlet_id', $o->outlet_id) ? 'selected' : '' }}>
                                                                {{ $o->outlet_name }}</option>
                                                        @endforeach
                                                    </select>
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
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pajak</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/dashboard/pajak') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Pajak : </label>
                                <input type="text" name="tax_name"
                                    class="form-control @error('tax_name')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Nama" value="{{ old('tax_name') }}">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Besaran Pajak ( % ) : </label>
                                <input type="text" name="tax_rate"
                                    class="form-control @error('tax_rate')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Nama" value="{{ old('tax_rate') }}">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Deskripsi Pajak : </label>
                                <input type="text" name="description"
                                    class="form-control @error('description')
                                                is-invalid
                                            @enderror"
                                    placeholder="Masukkan Nama" value="{{ old('description') }}">

                            </div>
                            <div class="form-group">
                                <label for="outlet">Pilih Outlet:</label>
                                <select class="pajak-select" name="outlet_id[]" multiple="multiple"
                                    data-placeholder="Pilih Outlet" style="width: 100%;">
                                    <option value=""> -- Pilih Outlet --</option>
                                    @foreach ($outlet as $item)
                                        <option value="{{ $item->outlet_id }}">{{ $item->outlet_name }}</option>
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
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $('.pajak-select').select2({
                    theme: "classic",
                });
            });
            $('.status-tax').change(function() {
                let slug = $(this).data('id');
                let status = $(this).is(':checked') ? 1 : 0;
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: "/dashboard/pajak/status/" + slug,
                    method: "PUT",
                    contentType: "application/json",
                    data: {
                        status: status
                    },
                    success: function(response) {
                        toastr.success("Berhasil");
                    },
                    error: function(xhr, status, error) {
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
