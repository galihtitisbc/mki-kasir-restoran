@extends('layouts.app')
@push('css')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Pegawai</b></h3>
            <div class="card-tools">
                <a href="{{ url('/dashboard/stock/sesuaikan') }}" class="btn btn-primary">Update Stock</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <div class="mbuh col-6 text-center mx-auto my-4">
                <form action="{{ url('/dashboard/stock') }}" method="get">
                    <div class="row">
                        <div class="col-9">
                            <select name="outlet" class="form-control" id="">
                                <option value="" selected>-- Pilih Outlet --</option>
                                @foreach ($outlet as $item)
                                    <option value="{{ $item->slug }}"
                                        {{ request('outlet') == $item->slug ? 'selected' : '' }}>{{ $item->outlet_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3 d-flex">
                            <button type="submit" class="btn btn-primary mr-2">Cari</button>
                            <a href="{{ url('/dashboard/pegawai') }}" type="submit" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kerja Dioutlet</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Posisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($pegawais as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#info-modal{{ $item->user_id }}">
                                    Info
                                </button>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->getRoleNames()->implode(', ') }}</td>
                            <td>
                                <form action="{{ url('/dashboard/pegawai/hapus', $item->user_id) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/dashboard/pegawai/edit', $item->user_id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    @push('js')
        @livewireScripts
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
