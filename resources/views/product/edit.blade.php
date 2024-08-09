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
        <form action="{{ url('/dashboard/produk', $produk->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body ms-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Produk : </label>
                            <input type="text" name="product_name"
                                class="form-control @error('product_name')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan Nama" value="{{ $produk->product_name }}">
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
                                placeholder="Masukkan Harga Produk" value="{{ $produk->price }}">
                            @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Stok : ( Opsional )</label>
                            <input type="text" name="stock"
                                class="form-control @error('stock')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan stock ( Opsional )" value="{{ $produk->stock }}">
                            @error('stock')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload Gambar : </label>
                            <input type="file" name="gambar" class="form-control" id="">
                            @error('gambar')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kategori Produk :</label>
                            <br>
                            <select class="form-control edit-select" name="category_id[]" multiple="multiple"
                                data-placeholder="Pilih Outlet" style="width: 100%;">
                                <option value=""> -- Pilih Kategori --</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->category_id }}" @selected(in_array($item->category_id, $selectedCategory))>
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
                            <select class="form-control edit-select" name="outlet_id[]" multiple="multiple"
                                data-placeholder="Pilih Outlet" style="width: 100%;">
                                <option value=""> -- Pilih Outlet --</option>
                                @foreach ($outlet as $item)
                                    <option value="{{ $item->outlet_id }}" @selected(in_array($item->outlet_id, $selectedOutlet))>
                                        {{ $item->outlet_name }}</option>
                                @endforeach
                            </select>
                            @error('outlet_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
    </div>
    </form>
    </div>
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.edit-select').select2();
            });
        </script>
    @endpush
@endsection
