@extends('layouts.app')
@push('css')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('../../plugins/toastr/toastr.min.css') }}">
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h3 class="card-title"><b>Laporan Transaksi</b></h3>
            <div class="card-tools">

            </div>
        </div>
        <!-- /.card-header -->
        <livewire:laporan-transaksi-index>
            <!-- /.card-body -->
    </div>
    @push('js')
        @livewireScripts
        <script src="{{ asset('../../plugins/toastr/toastr.min.js') }}"></script>
    @endpush
@endsection
