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
                    <div class="text-center my-4">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#tambah-satuan">Tambah Satuan Bahan</button>
                    </div>
                    @if (old('bahan_id'))
                        @foreach (old('bahan_id') as $index => $oldBahanId)
                            <div class="row d-flex flex-wrap justify-content-center bahan-row">
                                <div class="col-lg-3 col-sm-1 col-md-3">
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
                                <div class="col-lg-3 col-sm-1 col-md-3">
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
                                <div class="col-lg-3 col-sm-1 col-md-3">
                                    <label for="takaran">Takaran: </label>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-9">
                                            <div class="form-group">
                                                <input type="text" name="takaran[]" class="form-control"
                                                    placeholder="Masukkan Takaran" value="{{ old('takaran.' . $index) }}">
                                                @if ($errors->has('takaran.' . $index))
                                                    <span
                                                        class="text-danger">{{ $errors->first('takaran.' . $index) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3">
                                            <button type="button" class="remove-bahan btn btn-danger"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="row d-flex flex-wrap justify-content-center bahan-row">
                            <div class="col-lg-3 col-sm-1 col-md-3">
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
                            <div class="col-lg-3 col-sm-1 col-md-3">
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
                            <div class="col-lg-3 col-sm-1 col-md-3">
                                <label for="takaran">Takaran: </label>
                                <div class="row">
                                    <div class="col-lg-9 col-md-9">
                                        <div class="form-group">
                                            <input type="text" name="takaran[]" class="form-control"
                                                placeholder="Masukkan Takaran">
                                            @if ($errors->has('takaran.0'))
                                                <span class="text-danger">{{ $errors->first('takaran.0') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3">
                                        <button type="button" class="remove-bahan btn btn-danger"><i class="fa fa-trash"
                                                aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-around">
                    <button type="button" id="add-bahan" class="btn btn-info">Tambah Bahan</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
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
    <script>
        $(document).ready(function() {
            $('.bahan-select').select2({
                theme: "classic"
            });
            $('#add-bahan').click(function() {
                let newRow = `<div class="row d-flex flex-wrap justify-content-center bahan-row">
                <div class="col-lg-3 col-sm-1 col-md-3">
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
                <div class="col-lg-3 col-sm-1 col-md-3">
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
                  <div class="col-lg-3 col-sm-1 col-md-3">
                                    <label for="takaran">Takaran: </label>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-9">
                                            <div class="form-group">
                                        <input type="text" name="takaran[]" class="form-control" 
                                        placeholder="Masukkan Takaran">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button type="button" class="remove-bahan btn btn-danger"><i
                                                    class="fa fa-trash" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
            </div>`;
                $('.bahan-container').append(newRow);
                $('.bahan-select').select2({
                    theme: "classic"
                });
            });

            $(document).on('click', '.remove-bahan', function() {
                $(this).closest('.bahan-row').remove();
            });
            $("#form-tambah-satuan").submit((e) => {
                e.preventDefault();
                let satuan = $("#satuan").val();
                if (satuan === "") {
                    return;
                }
                $.ajax({
                    url: "/dashboard/store",
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        satuan: satuan,
                    },
                    success: function(response) {
                        $("#tambah-satuan").modal("hide");
                        window.location.reload(true);
                    },
                    error: function(error) {
                        console.log(error.message);
                    },
                });
            });
        });
    </script>
@endpush
