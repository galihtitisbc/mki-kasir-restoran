<div>
    <div class="card-body table-responsive p-0">
        <div class="text-center mx-auto my-4">
            <div class="row d-flex flex-wrap justify-content-center">
                <div class="col-lg-2 col-md-2 col-sm-7">
                    <label for="outlet">Pilih Outlet :</label>
                    <select wire:model.live="outletSearch" class="form-control" id="">
                        <option value="" selected>-- Pilih Outlet --</option>
                        @foreach ($outlets as $item)
                            <option value="{{ $item->slug }}" {{ request('outlet') == $item->slug ? 'selected' : '' }}>
                                {{ $item->outlet_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-7">
                    <label for="outlet">Nama Produk :</label>
                    <input type="text" class="form-control" {{ $outletSearch == null ? 'disabled' : '' }}
                        wire:model.live.debounce.300ms="productSearch" id="">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-7">
                    <label for="outlet">Pilih Kategori :</label>
                    <select wire:model.live="categorySearch" {{ $outletSearch == null ? 'disabled' : '' }}
                        class="form-control" id="category">
                        <option value="" selected>-- Pilih Kategori --</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->slug }}"
                                {{ request('categories') == $item->slug ? 'selected' : '' }}>
                                {{ $item->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-7">
                    <label for="fromDate">Dari Tanggal :</label>
                    <input type="date" wire:model.live="fromDate" {{ $outletSearch == null ? 'disabled' : '' }}
                        class="form-control" id="fromDate">
                </div>
                <div class="col-lg-2 col-md-2 col-sm-7">
                    <label for="toDate">Ke Tanggal :</label>
                    <input type="date" wire:model.live="toDate" {{ $outletSearch == null ? 'disabled' : '' }}
                        class="form-control" id="toDate">
                </div>

            </div>
        </div>
        @if ($outletSearch)
            <div class="text-right mr-5">
                <button class="btn btn-danger" wire:click="printPdf('pdf')">Export PDF</button>
                <button class="btn btn-success" wire:click="printExcel('excel')">Export Excel</button>
            </div>
        @endif
        @if (!is_null($transactions))
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Kasir</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Outlet</th>
                                <th>Harga Produk</th>
                                <th>Quantity</th>
                                <th>Total Harga</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($transactions as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>
                                        @foreach ($item->product->categories as $cat)
                                            {{ $loop->last ? $cat->category_name : $cat->category_name . ',' }}
                                        @endforeach
                                    </td>
                                    <td>{{ $item->outlet->outlet_name }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->total_price }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
