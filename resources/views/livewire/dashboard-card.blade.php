<div>
    <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $pajakSeluruhOutlet }}</h3>
                <h4>
                    Pajak Seluruh Outlet Bulan Ini
                </h4>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
        </div>
    </div>
    <div class="pilih-outlet d-flex justify-content-center">
        <select wire:model.change="outletSearch" class="form-control col-sm-6 col-md-5 col-lg-4 mb-4" id="">
            <option value="">-- Pilih Outlet --</option>
            @foreach ($outlets as $item)
                <option value="{{ $item->slug }}" {{ request('outlet') == $item->slug ? 'selected' : '' }}>
                    {{ $item->outlet_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="row d-flex justify-content-between">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $transaksiHariIni }}</h3>
                    <p>Transaksi Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $pajakBulanIni }}</h3>
                    <p>
                        Pajak Bulan Ini
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $jumlahPegawai }}</h3>
                    <p>Jumlah Pegawai</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $jumlahProduk }}</h3>
                    <p>Jumlah Produk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
    </div>
</div>
