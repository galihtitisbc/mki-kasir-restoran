<div>
    <div class="card-body table-responsive p-3">
        <div class="row d-flex justify-content-center mt-3">
            <div class="col-4">
                <select wire:model.live="outletSearch" class="form-control" id="">
                    <option value="" selected>-- Semua Outlet --</option>
                    @foreach ($outlets as $item)
                        <option value="{{ $item->slug }}" {{ request('outlet') == $item->slug ? 'selected' : '' }}>
                            {{ $item->outlet_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <table class="table table-hover text-center mt-3">
            <thead>
                <th>No</th>
                <th>Di Generate</th>
                <th>Untuk Bulan</th>
                <th>Jumlah Bayar</th>
                <th>Pajak Yang Dibayar</th>
            </thead>
            <tbody>
                @foreach ($riwayatPajak as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}</td>
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
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
