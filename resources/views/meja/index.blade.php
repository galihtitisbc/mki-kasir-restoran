@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Meja</b></h3>
            <div class="card-tools">
                <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#tambah-modal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Tambah Meja
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <div class="mbuh col-6 text-center mx-auto my-4">
                <form action="{{ url('/home/meja') }}" method="get">
                    <div class="row">
                        <div class="col-9">
                            <select name="outlet" class="form-control" id="">
                                @foreach ($outlet as $item)
                                    <option value="{{ $item->slug }}"
                                        {{ request('outlet') == $item->slug ? 'selected' : '' }}>{{ $item->outlet_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary">Cari</button>
                            <a href="{{ url('/home/meja') }}" type="submit" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @foreach ($data as $item)
                <div class="col">
                    <div class="card mx-3 my-3" style="width: 17rem;">
                        <div class="card-body text-center">
                            <h2>{{ $item->nomor_meja }}</h2>
                            <form action="{{ url('/home/meja', $item->meja_id) }}" class="mt-4 form-delete" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn btn-danger delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal fade" id="tambah-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Outlet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/home/meja') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Piih Outlet Yang Akan Ditambahkan Meja : </label>
                                <select name="outlet_slug" class="form-control" id="">
                                    @foreach ($outlet as $item)
                                        <option value="{{ $item->slug }}">{{ $item->outlet_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Tambah Data</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    </div>
    @push('js')
        <script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(".delete").click(function() {
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
                            $('.form-delete').submit();
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
