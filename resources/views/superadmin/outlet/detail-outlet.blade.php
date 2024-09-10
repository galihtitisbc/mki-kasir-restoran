@extends('layouts.app')
@push('css')
    <style>
        .produk .produk-table {
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Outlet Milik : {{ $outlet->supervisor->name }}</b></h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-0 px-3 mt-4">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-5 col-sm-3">
                    <div class="image">
                        <img src="{{ asset('/img/outlet.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="data text-left">
                        <p><b>Pemilik Outlet : </b>{{ $outlet->supervisor->name }}</p>
                        <p><b>Nama Outlet : </b>{{ $outlet->outlet_name }}</p>
                        <p><b>Alamat Outlet : </b>{{ $outlet->address }}</p>
                        <p><b>Nomor Telpon Outlet : </b>{{ $outlet->phone }}</p>
                        <p><b>Tanggal Outlet Didaftarkan : </b>{{ $outlet->created_at }}</p>
                    </div>
                </div>
                <div class="col-lg-7 col-sm-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <p>
                                    <h3>{{ $transaksiBulanIni }}</h3>
                                    </p>
                                    <p>Transaksi Bulan Ini</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <p>
                                    <h3>{{ $terlaris->product_name }}</h3>
                                    </p>
                                    <p>Produk Terlaris, Terjual Sebanyak {{ $terlaris->terjual }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="produk mt-4">
                        <h5>Daftar Produk Di Outlet : {{ $outlet->outlet_name }}</h5>
                        <div class="produk-table">
                            <table class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Nama</th>
                                    <th>Terjual</th>
                                </thead>
                                <tbody>
                                    @foreach ($outlet->products as $product)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->salesHistories->count() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="my-5">
                        <div class="pegawai w-100">
                            <h5>Daftar Pegawai</h5>
                            <table class="table">
                                <thead>
                                    <th>Nama</th>
                                    <th>No HP</th>
                                </thead>
                                <tbody>
                                    @foreach ($outlet->outletHasPegawai as $pegawai)
                                        <tr>
                                            <td>{{ $pegawai->name }}</td>
                                            <td>{{ $pegawai->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="my-5">
                        <table class="table table-hover text-center">
                            <thead>
                                <th>No</th>
                                <th>Tanggal Bayar</th>
                                <th>Untuk Bulan</th>
                                <th>Jumlah Bayar</th>
                                <th>Pajak Yang Dibayar</th>
                            </thead>
                            <tbody>
                                @foreach ($riwayatPajak as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td>{{ $item->untuk_bulan }}</td>
                                        <td>{{ $item->jumlah_bayar }}</td>
                                        <td>
                                            <button class="btn btn-outline-primary" data-toggle="modal"
                                                data-target="#detail-modal{{ $item->id }}">Detail</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="detail-modal{{ $item->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Pajak Yang Dibayar</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @foreach ($item->pajakYangDibayar as $pajak)
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="">Pajak</label>
                                                                <input type="text" disabled class="form-control"
                                                                    value="{{ $pajak->nama_pajak }}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="">Total</label>
                                                                <input type="text" disabled class="form-control"
                                                                    value="{{ $pajak->total }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
