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
        <form action="{{ url('/dashboard/bahan') }}" method="POST">
            @csrf
            <div class="card-body ms-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="bahan_name">Nama Bahan : </label>
                            <input type="text" name="nama_bahan"
                                class="form-control @error('nama_bahan') is-invalid @enderror" placeholder="Masukkan Nama"
                                value="{{ old('nama_bahan') }}">
                            @error('nama_bahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_bahan_per_satuan">Harga Bahan (Per Satuan): </label>
                            <input type="text" name="harga_bahan_per_satuan"
                                class="form-control @error('harga_bahan_per_satuan') is-invalid @enderror"
                                placeholder="Masukkan Harga" value="{{ old('harga_bahan_per_satuan') }}">
                            @error('harga_bahan_per_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_bahan">Stok Bahan : </label>
                            <input type="text" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                placeholder="Masukkan Jumlah Barang" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="outlet_id">Bahan Untuk Outlet : </label>
                            <div class="row">
                                @foreach ($outlet as $item)
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="outlet_id[]"
                                                    id="checkboxPrimary3{{ $item->slug }}" value="{{ $item->outlet_id }}"
                                                    @checked(in_array($item->outlet_id, old('outlet_id', [])))>
                                                <label for="checkboxPrimary3{{ $item->slug }}">
                                                    {{ $item->outlet_name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">Pilih Supplier Bahan : </label>
                            <select name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror">
                                <option value="">-- Pilih Supplier --</option>
                                @foreach ($supplier as $item)
                                    <option value="{{ $item->supplier_id }}"
                                        {{ old('supplier_id') == $item->supplier_id ? 'selected' : '' }}>
                                        {{ $item->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satuan_bahan">Satuan Bahan : </label>
                            <div class="container d-flex flex-warp justify-content-between">
                                <select name="satuan_bahan" class="satuan-bahan form-control" style="width: 80%"id="">

                                </select>
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#tambah-satuan"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            </div>
                            @error('satuan_bahan')
                                <div class="bg bg-danger invalid">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
        <div class="modal fade" id="tambah-satuan">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-tambah-satuan">
                            <div class="form-group">
                                <label for="satuan">Nama Satuan : </label>
                                <input type="text" id="satuan" class="form-control">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/satuan-bahan.js') }}"></script>
@endpush
