@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Pemilik Outlet</b></h3>
            <div class="card-tools">
                <a href="{{ url('dashboard/superadmin/pemilik-resto') }}" class="btn btn-success">Tambah Pemilik Restoran</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0 px-3 mt-4">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Status Akun</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" data-id="{{ $user->username }}"
                                        class="custom-control-input status-akun" id="{{ $user->username }}"
                                        {{ $user->is_active ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $user->username }}"></label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ url('/dashboard/superadmin/pemilik-outlet/daftar-outlet/' . $user->email) }}"
                                    class="btn btn-outline-primary">Lihat
                                    Outlet</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('status'))
        <input type="hidden" id="status" value="{{ session('status') }}">
        <script>
            console.log("sukses");

            let msg = $('#status').val();
            toastr.success(msg);
        </script>
    @endif
    @if (session('error'))
        <input type="hidden" id="status" value="{{ session('error') }}">
        <script>
            console.log("gagal");

            let msg = $('#status').val();
            toastr.danger(msg);
        </script>
    @endif
    <script>
        $('.status-akun').change(function() {
            let $checkbox = $(this);
            let username = $checkbox.data('id');
            let statusCheked = $checkbox.is(':checked') ? 1 : 0;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "/dashboard/superadmin/status-akun/" + username,
                method: "PATCH",
                contentType: "application/json",
                success: function(response) {
                    toastr.success("Berhasil");
                },
                error: function(xhr, status, error) {
                    $checkbox.prop('checked', !statusCheked);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                    })
                },
            });
        })
    </script>
@endpush
