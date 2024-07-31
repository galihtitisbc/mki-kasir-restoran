@extends('layouts.app')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('bahan.update', $bahan->slug) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body ms-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="bahan_name">Nama Bahan : </label>
                            <input type="text" name="nama_bahan"
                                class="form-control @error('nama_bahan') is-invalid @enderror" placeholder="Masukkan Nama"
                                value="{{ $bahan->nama_bahan }}">
                            @error('nama_bahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="satuan_bahan">Satuan Bahan : ( Liter, Kg, gr )</label>
                            <input type="text" name="satuan_bahan"
                                class="form-control @error('satuan_bahan') is-invalid @enderror"
                                placeholder="Masukkan Satuan" value="{{ $bahan->satuan_bahan }}">
                            @error('satuan_bahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_bahan_per_satuan">Harga Bahan (Per Satuan): </label>
                            <input type="text" name="harga_bahan_per_satuan"
                                class="form-control @error('harga_bahan_per_satuan') is-invalid @enderror"
                                placeholder="Masukkan Harga" value="{{ $bahan->harga_bahan_per_satuan }}">
                            @error('harga_bahan_per_satuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="total_bahan">Total Bahan : </label>
                            <input type="text" name="total_bahan"
                                class="form-control @error('total_bahan') is-invalid @enderror" placeholder="Masukkan Total"
                                value="{{ $bahan->total_bahan }}">
                            @error('total_bahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_bahan">Harga Bahan (Keseluruhan) : </label>
                            <input type="text" name="harga_bahan"
                                class="form-control @error('harga_bahan') is-invalid @enderror" placeholder="Masukkan Harga"
                                value="{{ $bahan->harga_bahan }}">
                            @error('harga_bahan')
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
                                                    id="checkboxPrimary3{{ $item->slug }}"
                                                    value="{{ $item->outlet_id }}"
                                                    {{ in_array($item->outlet_id, $selectedOutlet) ? 'checked' : '' }}>
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
                            <select name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror">
                                <option value="">-- Pilih Supplier --</option>
                                @foreach ($supplier as $item)
                                    <option value="{{ $item->supplier_id }}"
                                        {{ $bahan->supplier_id == $item->supplier_id ? 'selected' : '' }}>
                                        {{ $item->supplier_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>

    </div>
@endsection
