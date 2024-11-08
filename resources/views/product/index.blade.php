@extends('layouts.app')
@push('css')
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Produk</b></h3>
            <div class="card-tools">
                <a href="{{ url('/dashboard/produk/tambah') }}" class="btn btn-success"><i class="fa fa-plus"
                        aria-hidden="true"></i>
                    Tambah Produk</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <div class="mbuh col-6 text-center mx-auto my-4">
                <form action="{{ url('/dashboard/produk') }}" method="get">
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
                            <a href="{{ url('/dashboard/produk') }}" type="submit" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
            <br>
            <h5 class="ml-3">Jumlah Produk : {{ $product->total() }}</h5>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Daftar Bahan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $item)
                        <tr>
                            <td>{{ $product->firstItem() + $loop->index }}</td>
                            <td>
                                @if ($item->gambar != null)
                                    <img src="{{ asset('storage/gambar/' . $item->gambar) }}" alt="" width="50"
                                        height="50">
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->product_name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->stock }}</td>
                            <td>
                                @if ($item->is_food == true)
                                    {{-- <button class="btn btn-outline-primary" data-toggle="modal"
                                        data-target="#detail-modal{{ $item->product_code }}">Detail</button> --}}
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal"
                                            data-target="#detail-modal{{ $item->product_code }}">Detail</button>
                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item"
                                                href="{{ url('/dashboard/produk/' . $item->slug . '/tambah-bahan') }}">Tambah
                                                Bahan</a>
                                        </div>
                                    </div>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" data-id="{{ $item->slug }}"
                                        class="custom-control-input status-product" id="{{ $item->slug }}"
                                        {{ $item->status ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="{{ $item->slug }}"></label>
                                </div>
                            </td>
                            <td>
                                <form action="{{ url('dashboard/produk/hapus', $item->slug) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/dashboard/produk', $item->slug) }}" class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <div class="modal fade" id="detail-modal{{ $item->product_code }}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Daftar Bahan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($item->bahans as $bahan)
                                            <div class="border border-secondary p-3 my-2">
                                                <div class="row my-2">
                                                    <div class="col">
                                                        <label for="">Bahan</label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" disabled class="form-control"
                                                            value="{{ $bahan->nama_bahan }}">
                                                    </div>
                                                </div>
                                                <div class="row my-2">
                                                    <div class="col">
                                                        <label for="">Qty</label>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" disabled class="form-control"
                                                            value="{{ $bahan->pivot->qty . ' ' . $bahan->pivot->satuan_bahan }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Close</button>
                                            <a href="{{ url('/dashboard/produk/' . $item->slug . '/tambah-bahan') }}"
                                                class="btn btn-info">Tambah Bahan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    @if (!is_null($product))
        <div class="pagination justify-content-center">
            {{ $product->links() }}
        </div>
    @endif
    @push('js')
        <script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('status'))
            @if (session('status') == 'success')
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                    });
                </script>
            @elseif(session('status') == 'error')
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                    });
                </script>
            @endif
        @endif
        <script>
            $('.status-product').change(function() {
                let $checkbox = $(this);
                let slug = $checkbox.data('id');
                let statusCheked = $checkbox.is(':checked') ? 1 : 0;
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    url: "/dashboard/produk/status/" + slug,
                    method: "PUT",
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
    @endpush
@endsection
