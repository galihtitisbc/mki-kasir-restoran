<div>
    <div class="card-header text-center">
        <h3 class="card-title"><b>Pergerakan Stock</b></h3>
        <div class="card-tools">
            <a href="{{ url('/dashboard/stock/sesuaikan?outlet=' . $outletSearch) }}" class="btn btn-primary">Update
                Stock</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <div class="mbuh col-6 text-center mx-auto my-4">
            <form action="{{ url('/dashboard/stock') }}" method="get">
                <div class="row">
                    <div class="col-6">
                        <label for="outlet"></label>
                        <select wire:model.live="outletSearch" class="form-control" id="">
                            <option value="" selected>-- Pilih Outlet --</option>
                            @foreach ($outlets as $item)
                                <option value="{{ $item->slug }}"
                                    {{ request('outlet') == $item->slug ? 'selected' : '' }}>
                                    {{ $item->outlet_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        Dari Tanggal : <input type="date" wire:model.live="fromDate" class="form-control"
                            id="fromDate">
                    </div>
                    <div class="col-3">
                        Ke Tanggal : <input type="date" wire:model.live="toDate" class="form-control" id="toDate">
                    </div>
                </div>
            </form>
        </div>
        @if ($outlets)
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Shift</th>
                        <th>Nama Bahan</th>
                        <th>Stock Masuk</th>
                        <th>Stock Keluar</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->shift }}</td>
                            <td>{{ $item->bahan->nama_bahan }}</td>
                            <td>{{ $item->stock_masuk == null ? '-' : $item->stock_masuk }}</td>
                            <td>{{ $item->stock_keluar == null ? '-' : $item->stock_keluar }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
