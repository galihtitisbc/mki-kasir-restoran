@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Bahan</b></h3>
            <div class="card-tools">
                <a href="{{ url('/dashboard/bahan/create') }}" class="btn btn-success"> <i class="fa fa-plus"
                        aria-hidden="true"></i> Tambah Bahan</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <form action="{{ url('/dashboard/bahan') }}" method="GET">
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

            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan</th>
                        <th>Harga Bahan ( Per Satuan )</th>
                        <th>Stok Bahan</th>
                        <th>Satuan Bahan</th>
                        <th>Harga Bahan ( Keseluruhan )</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bahan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_bahan }}</td>
                            <td>{{ $item->harga_bahan_per_satuan }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>{{ $item->satuan_bahan }}</td>
                            <td>{{ $item->harga_bahan_keseluruhan }}</td>
                            <td>
                                <form action="{{ route('bahan.destroy', $item->slug) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('bahan.edit', $item->slug) }}" class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
