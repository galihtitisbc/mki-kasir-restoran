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

        <form action="{{ url('/dashboard/produk/' . $product->slug . '/tambah-bahan') }}" method="POST">
            @csrf
            <div class="card-body ms-5">
                <div class="bahan-container">
                    @if (old('bahan_id'))
                        @foreach (old('bahan_id') as $index => $oldBahanId)
                            <div class="row d-flex flex-wrap justify-content-center bahan-row">
                                <div class="col-lg-3 col-sm-1 col-md-1">
                                    <div class="form-group">
                                        <label for="bahan_id">Bahan : </label>
                                        <select class="form-control bahan-select" name="bahan_id[]">
                                            <option value="">--- Pilih Bahan ---</option>
                                            @foreach ($bahan as $item)
                                                <option value="{{ $item->bahan_id }}"
                                                    {{ $oldBahanId == $item->bahan_id ? 'selected' : '' }}>
                                                    {{ $item->nama_bahan }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('bahan_id.' . $index))
                                            <span class="text-danger">{{ $errors->first('bahan_id.' . $index) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-1 col-md-1">
                                    <div class="form-group">
                                        <label for="satuan_bahan">Satuan Bahan : </label>
                                        <select name="satuan_bahan[]" class="form-control" id="">
                                            <option value="">-- Pilih Satuan --</option>
                                            @foreach ($satuan as $item)
                                                <option value="{{ $item->satuan }}"
                                                    {{ old('satuan_bahan.' . $index) == $item->satuan ? 'selected' : '' }}>
                                                    {{ $item->satuan }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('satuan_bahan.' . $index))
                                            <span class="text-danger">{{ $errors->first('satuan_bahan.' . $index) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-1 col-md-1">
                                    <div class="form-group">
                                        <label for="takaran">Takaran: </label>
                                        <input type="text" name="takaran[]" class="form-control"
                                            placeholder="Masukkan Takaran" value="{{ old('takaran.' . $index) }}">
                                        @if ($errors->has('takaran.' . $index))
                                            <span class="text-danger">{{ $errors->first('takaran.' . $index) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <button type="button" class="remove-bahan btn btn-danger"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </div>
                        @endforeach
                    @else
                        <div class="row d-flex flex-wrap justify-content-center bahan-row">
                            <div class="col-lg-3 col-sm-1 col-md-1">
                                <div class="form-group">
                                    <label for="bahan_id">Bahan : </label>
                                    <select class="form-control bahan-select" name="bahan_id[]">
                                        <option value="">--- Pilih Bahan ---</option>
                                        @foreach ($bahan as $item)
                                            <option value="{{ $item->bahan_id }}">{{ $item->nama_bahan }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('bahan_id.0'))
                                        <span class="text-danger">{{ $errors->first('bahan_id.0') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-1 col-md-1">
                                <div class="form-group">
                                    <label for="satuan_bahan">Satuan Bahan : </label>
                                    <select name="satuan_bahan[]" class="form-control" id="">
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach ($satuan as $item)
                                            <option value="{{ $item->satuan }}"
                                                {{ old('satuan_bahan.0') == $item->satuan ? 'selected' : '' }}>
                                                {{ $item->satuan }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('satuan_bahan.0'))
                                        <span class="text-danger">{{ $errors->first('satuan_bahan.0') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-1 col-md-1">
                                <div class="form-group">
                                    <label for="takaran">Takaran: </label>
                                    <input type="text" name="takaran[]" class="form-control"
                                        placeholder="Masukkan Takaran">
                                    @if ($errors->has('takaran.0'))
                                        <span class="text-danger">{{ $errors->first('takaran.0') }}</span>
                                    @endif
                                </div>
                            </div>
                            <button type="button" class="remove-bahan btn btn-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
                        </div>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <button type="button" id="add-bahan" class="btn btn-info">Tambah Bahan</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>

    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.bahan-select').select2({
                theme: "classic"
            });
            $('#add-bahan').click(function() {
                let newRow = `<div class="row d-flex flex-wrap justify-content-center bahan-row">
                <div class="col-lg-3 col-sm-1 col-md-1">
                    <div class="form-group">
                        <label for="bahan_id">Bahan : </label>
                        <select class="form-control bahan-select" name="bahan_id[]">
                            <option value="">--- Pilih Bahan ---</option>
                            @foreach ($bahan as $item)
                                <option value="{{ $item->bahan_id }}">{{ $item->nama_bahan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-1 col-md-1">
                    <div class="form-group">
                                        <label for="satuan_bahan">Satuan Bahan : </label>
                                        <select name="satuan_bahan[]" class="form-control" id="">
                                            <option value="">-- Pilih Satuan --</option>
                                            @foreach ($satuan as $item)
                                                <option value="{{ $item->satuan }}">
                                                    {{ $item->satuan }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                </div>
                <div class="col-lg-3 col-sm-1 col-md-1">
                    <div class="form-group">
                        <label for="takaran">Takaran: </label>
                        <input type="text" name="takaran[]" class="form-control" 
                               placeholder="Masukkan Takaran">
                    </div>
                </div>
                <button type="button" class="remove-bahan btn btn-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i></button>
            </div>`;
                $('.bahan-container').append(newRow);
                $('.bahan-select').select2({
                    theme: "classic"
                });
            });

            $(document).on('click', '.remove-bahan', function() {
                $(this).closest('.bahan-row').remove();
            });
        });
    </script>
@endpush
