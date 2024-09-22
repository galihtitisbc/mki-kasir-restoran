@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Opsi Produk</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah-modal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Opsi
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <form action="{{ url('/dashboard/opsi-produk') }}" method="GET">
                <div class="row d-flex justify-content-center mt-3">
                    <div class="col-lg-4 col-md-4 col-sm-5">
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
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Opsi</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($opsi as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->opsi_name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary detail-opsi" data-toggle="modal"
                                    data-target="#modal-detail-opsi-{{ $item->slug }}"><i class="fa fa-eye"
                                        aria-hidden="true"></i></button>
                            </td>
                            <td>
                                <form action="{{ url('dashboard/opsi/hapus', $item->slug) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" class="btn btn-warning edit-btn"
                                        data-id="{{ $item->slug }}">Edit</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="modal-detail-opsi-{{ $item->slug }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Opsi </h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($item->detailOpsi as $detail)
                                            <div class="row d-flex justify-content-center my-3">
                                                <div class="col-lg-4 col-md-4">
                                                    <label for="opsi">Nama Opsi : </label>
                                                    <input type="text" class="form-control" value="{{ $detail->opsi }}"
                                                        disabled>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <label for="opsi">Harga : </label>
                                                    <input type="number" class="form-control" value="{{ $detail->harga }}"
                                                        disabled>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="tambah-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Opsi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group ">
                            <div class="opsi-name d-flex justify-content-start">
                                <label for="exampleInputEmail1">Nama Grup Opsi : </label>
                                <input type="text" id="opsi_name" name="opsi_name"
                                    class="form-control mx-4 col-lg-4 col-md-4 @error('opsi_name') is-invalid @enderror"
                                    placeholder="Masukkan Nama Grup Opsi" required value="{{ old('opsi_name') }}">
                                <button type="button" class="btn btn-success tambah-form-opsi"><i class="fa fa-plus-circle"
                                        aria-hidden="true"></i>Tambah Detail Opsi</button>
                            </div>
                            @error('opsi_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="detail-opsi" id="form-container">
                            <div class="col-5 mx-auto">
                                <select class="select-opsi" name="outlet_id" data-placeholder="Pilih Outlet"
                                    style="width: 100%;">
                                    <option value=""> -- Pilih Outlet --</option>
                                    @foreach ($outlet as $item)
                                        <option value="{{ $item->outlet_id }}">
                                            {{ $item->outlet_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-detail-opsi">
                                <div class="row d-flex justify-content-center my-3">
                                    <div class="col-lg-4 col-md-4">
                                        <label for="opsi">Nama Opsi : </label>
                                        <input type="text" class="form-control opsi" name="opsi[]" id="opsi">
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <label for="opsi">Harga : </label>
                                        <input type="number" class="form-control harga" name="harga[]" id="harga">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="simpan-opsi" class="btn btn-success">Tambah Data</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="update-modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Opsi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="form-group ">
                            <div class="opsi-name d-flex justify-content-start">
                                <label for="exampleInputEmail1">Nama Grup Opsi : </label>
                                <input type="text" name="opsi_name_update"
                                    class="form-control mx-4 col-lg-4 col-md-4 opsi_name_update"
                                    placeholder="Masukkan Nama Grup Opsi" required>
                                <button type="button" class="btn btn-success tambah-form-opsi-update"><i
                                        class="fa fa-plus-circle" aria-hidden="true"></i>Tambah Detail Opsi</button>
                            </div>
                        </div>
                        <div class="detail-opsi" id="form-container-update">
                            <div class="col-5 mx-auto">
                                <select class="select-opsi-update" name="outlet_id_update"
                                    data-placeholder="Pilih Outlet" style="width: 100%;">
                                    <option value=""> -- Pilih Outlet --</option>
                                    @foreach ($outlet as $item)
                                        <option value="{{ $item->outlet_id }}">
                                            {{ $item->outlet_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-detail-opsi-update">
                                {{-- <div class="row d-flex justify-content-center my-3">
                                    <div class="col-lg-4 col-md-4">
                                        <label for="opsi">Nama Opsi : </label>
                                        <input type="text" class="form-control opsi-update" name="opsi[]"
                                            id="opsi">
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <label for="opsi">Harga : </label>
                                        <input type="number" class="form-control harga-update" name="harga[]"
                                            id="harga">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" id="simpan-opsi-update" class="btn btn-success">Edit Data</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        @push('js')
            <script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="{{ asset('js/kelolaOpsi.js') }}"></script>
            @if (session('status'))
                @if (session('status') == 'success')
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                        });
                    </script>
                @elseif(session('status') == 'error')
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                        });
                    </script>
                @endif
            @endif
        @endpush
    @endsection
