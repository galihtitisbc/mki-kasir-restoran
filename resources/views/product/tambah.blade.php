@extends('layouts.app')
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
                            <label for="exampleInputEmail1">Stok : ( Opsional )</label>
                            <input type="text" name="stock"
                                class="form-control @error('stock')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan stock ( Opsional )" value="{{ old('stock') }}">
                            @error('stock')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
                            <div class="row">
                                @foreach ($category as $item)
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="category_id[]"
                                                    id="checkboxPrimary3-{{ $item->slug }}"
                                                    value="{{ $item->category_id }}" @checked(in_array($item->category_id, old('category_id', [])))>
                                                <label for="checkboxPrimary3-{{ $item->slug }}">
                                                    {{ $item->category_name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Produk Untuk Outlet :</label>
                            <br>
                            <div class="row">
                                @foreach ($outlet as $item)
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="outlet_id[]"
                                                    id="checkboxPrimary3{{ $item->slug }}"
                                                    value="{{ $item->outlet_id }}" @checked(in_array($item->outlet_id, old('outlet_id', [])))>
                                                <label for="checkboxPrimary3{{ $item->slug }}">
                                                    {{ $item->outlet_name }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
@endsection
