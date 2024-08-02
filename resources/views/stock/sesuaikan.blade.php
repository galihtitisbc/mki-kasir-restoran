@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Sesuaikan Stock Bahan</b></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <form action="{{ url('/dashboard/stock/sesuaikan') }}" method="GET">
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
            @if ($errors->any())
                <div class="alert alert-danger col-4 mx-auto">
                    <ul class="text-center">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ url('/dashboard/stock/sesuaikan') }}" method="POST"
                class="d-flex flex-column align-items-center">
                @csrf
                @if (!$bahan->isEmpty())
                    <div class="d-flex justify-content-end mb-3 mr-3">
                        <select name="shift" id="shift" class="form-control">
                            <option value="" selected>-- Pilih Shift --</option>
                            <option value="SIANG" {{ old('shift', request('shift')) == 'SIANG' ? 'selected' : '' }}>SIANG
                            </option>
                            <option value="MALAM" {{ old('shift', request('shift')) == 'MALAM' ? 'selected' : '' }}>MALAM
                            </option>
                        </select>
                    </div>
                @endif
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Satuan</th>
                            <th>Stock Awal</th>
                            <th>Stock Masuk</th>
                            <th>Stock Keluar</th>
                            <th>Stock Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bahan as $item)
                            <tr>
                                <td>
                                    <input type="hidden" name="bahan_id[]" value="{{ $item->bahan_id }}">
                                    <input type="text" disabled class="form-control" value="{{ $item->nama_bahan }}">
                                </td>
                                <td>
                                    <input type="text" disabled class="form-control" value="{{ $item->satuan_bahan }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" disabled value="{{ $item->stock }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="stock_masuk[]"
                                        value="{{ old('stock_masuk.' . $loop->index) }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="stock_keluar[]"
                                        value="{{ old('stock_keluar.' . $loop->index) }}">
                                </td>
                                <td>
                                    <input type="text" disabled class="form-control" value="{{ $item->stock }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (!$bahan->isEmpty())
                    <button type="submit" class="btn btn-primary mt-3 col-4">Simpan</button>
                @endif
            </form>
        </div>
    </div>
    @push('js')
        <script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
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
