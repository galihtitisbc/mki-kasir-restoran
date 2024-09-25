@extends('layouts.app')
@push('css')
    @livewireStyles
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Daftar Outlet Milik : {{ $user->name }}</b></h3>
            <div class="card-tools">
            </div>
        </div>
        <div class="card-body table-responsive p-0 px-3 mt-4">
            <div class="row">
                @foreach ($user->supervisorHasOutlets as $outlet)
                    <div class="col-lg-4 col-6">
                        <!-- small card -->
                        <div class="small-box bg-{{ $outlet->sales_histories_count < 1 ? 'danger' : 'info' }}">
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
@endsection
@push('js')
    @livewireScripts
@endpush
