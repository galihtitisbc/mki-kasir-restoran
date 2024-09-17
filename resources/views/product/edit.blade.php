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
                        <div class="form-group my-4">
                            <input type="hidden" name="is_food" value="0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_food" class="custom-control-input" id="bahan-switch"
                                    {{ $produk->is_food == true ? 'checked' : '' }}>
                                <label class="custom-control-label" for="bahan-switch">Aktifkan Jika Produk Masakan</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stock : ( Opsional )</label>
                            <input type="text" name="stock"
                                class="form-control @error('stock')
                                                is-invalid
                                            @enderror"
                                placeholder="Masukkan stock ( Opsional )" value="{{ $produk->stock }}">
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
                            <select class="form-control edit-select" name="category_id[]" multiple="multiple"
                                data-placeholder="Pilih Kategori" style="width: 100%;">
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Opsi Untuk Produk ( Opsional ) :</label>
                            @foreach ($opsi as $val)
                                <div class="custom-control custom-checkbox d-flex justify-content-between my-2">
                                    <input class="custom-control-input" name="opsi_id[]" value="{{ $val->id }}"
                                        type="checkbox" id="customCheckbox{{ $loop->index }}"
                                        {{ in_array($val->id, $selectedOpsi) ? 'checked' : '' }}>
                                    <label for="customCheckbox{{ $loop->index }}"
                                        class="custom-control-label">{{ $val->opsi_name }}</label>
                                    <button type="button" class="btn btn-primary detail-opsi" data-toggle="modal"
                                        data-target="#modal-detail-opsi-{{ $val->slug }}"><i class="fa fa-eye"
                                            aria-hidden="true"></i></button>
                                </div>
                                <div class="modal fade" id="modal-detail-opsi-{{ $val->slug }}">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Detail Opsi </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach ($val->detailOpsi as $detail)
                                                    <div class="row d-flex justify-content-center my-3">
                                                        <div class="col-4">
                                                            <label for="opsi">Nama Opsi : </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $detail->opsi }}" disabled>
                                                        </div>
                                                        <div class="col-4">
                                                            <label for="opsi">Harga : </label>
                                                            <input type="number" class="form-control"
                                                                value="{{ $detail->harga }}" disabled>
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
                $('.edit-select').select2({
                    theme: "classic",
                });
            });
        </script>
    @endpush
@endsection
