@extends('layouts.app')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="card card-primary">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ url('/dashboard/produk/tambah') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body ms-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Produk : </label>
                            <input type="text" name="product_name"
                                class="form-control @error('product_name')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan Nama" value="{{ old('product_name') }}">
                            @error('product_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Harga : </label>
                            <input type="text" name="price"
                                class="form-control @error('price')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan Harga Produk" value="{{ old('price') }}">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload Gambar : ( Opsional )</label>
                            <input type="file" name="gambar" class="form-control" id="">
                            @error('gambar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="bahan-switch">
                                <label class="custom-control-label" for="bahan-switch">Aktifkan Jika Produk Makanan /
                                    Minuman</label>
                            </div>
                        </div>
                        <div class="form-group bahan-produk" hidden>
                            <label for="exampleInputEmail1">Bahan Untuk Produk</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori Produk :</label>
                            <br>
                            <select class="form-control tambah-select" name="category_id[]" multiple="multiple"
                                data-placeholder="Pilih Kategori" style="width: 100%;">
                                <option value=""> -- Pilih Kategori --</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->category_id }}">
                                        {{ $item->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Produk Untuk Outlet :</label>
                            <br>
                            <select class="form-control tambah-select" name="outlet_id[]" multiple="multiple"
                                data-placeholder="Pilih Outlet" style="width: 100%;">
                                <option value=""> -- Pilih Outlet --</option>
                                @foreach ($outlet as $item)
                                    <option value="{{ $item->outlet_id }}">
                                        {{ $item->outlet_name }}</option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="opsi d-flex justify-content-between">
                                <label for="exampleInputEmail1">Opsi Untuk Produk ( Opsional ) :</label>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#tambah-modal"><i class="fa fa-plus-circle"
                                        aria-hidden="true"></i></button>
                            </div>
                            <div class="daftar-opsi">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
    </div>
    </div>
    </form>
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
                                class="form-control mx-4 col-4 @error('opsi_name') is-invalid @enderror"
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
                                <div class="col-4">
                                    <label for="opsi">Nama Opsi : </label>
                                    <input type="text" class="form-control opsi" name="opsi[]" id="opsi">
                                </div>
                                <div class="col-4">
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
    <div class="modal fade" id="modal-detail-opsi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Opsi </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="detail-opsi" id="form-container">
                        <div class="form-group container-detail-opsi">

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('js/opsi.js') }}"></script>
        <script>
            $('#bahan-switch').change(function() {
                let status = $(this).is(':checked') ? 1 : 0;
                if (status === 1) {
                    $('.bahan-produk').removeAttr('hidden');
                }
                if (status === 0) {
                    $('.bahan-produk').attr('hidden', true);
                }
            })
        </script>
    @endpush
@endsection
