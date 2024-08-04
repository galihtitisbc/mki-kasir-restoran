<div>
    <div class="card-body table-responsive p-0">
        <div class="text-center mx-auto my-4">
            <form action="{{ url('/dashboard/stock') }}" method="get">
                <div class="row d-flex justify-content-center">
                    <div class="col-3">
                        <label for="outlet"></label>
                        <select wire:model.live="outletSearch" class="form-control" id="">
                            <option value="" selected>-- Pilih Outlet --</option>
                            {{-- @foreach ($outlets as $item)
                                <option value="{{ $item->slug }}"
                                    {{ request('outlet') == $item->slug ? 'selected' : '' }}>
                                    {{ $item->outlet_name }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="outlet"></label>
                        <select wire:model.live="outletSearch" class="form-control" id="">
                            <option value="" selected>-- Pilih Kategori --</option>
                            {{-- @foreach ($outlets as $item)
                                <option value="{{ $item->slug }}"
                                    {{ request('outlet') == $item->slug ? 'selected' : '' }}>
                                    {{ $item->outlet_name }}
                                </option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-2">
                        Dari Tanggal : <input type="date" wire:model.live="fromDate" class="form-control"
                            id="fromDate">
                    </div>
                    <div class="col-2">
                        Ke Tanggal : <input type="date" wire:model.live="toDate" class="form-control" id="toDate">
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
