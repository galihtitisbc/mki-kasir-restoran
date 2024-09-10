<div>
    <div class="card">
        <div class="card-header text-center">
            {{-- <h3 class="card-title"><b>Daftar Outlet Milik : {{ $user->name }}</b></h3> --}}
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-0 px-3 mt-4">
            <div class="search my-5 d-flex justify-content-center">
                <input type="text" class="form-control col-lg-3 col-sm-4" wire:model.live.debounce.300ms="outletSearch"
                    placeholder="Masukkan Nama Outlet">
            </div>
            <div class="row d-flex flex-wrap">
                @foreach ($outlets as $outlet)
                    <div class="col-lg-4">
                        <!-- small card -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h4>{{ $outlet->outlet_name }}</h4>
                                <p>{{ $outlet->address }}</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <a href="{{ url('dashboard/superadmin/pemilik-outlet/daftar-outlet/' . $outlet->slug . '/detail') }}"
                                class="small-box-footer" target="_blank">
                                Info Lebih Lanjut <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
