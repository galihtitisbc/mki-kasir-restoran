@extends('layouts.app')
@push('css')
    @livewireStyles
@endpush
@section('content')
    <livewire:seluruh-outlet />
@endsection
@push('js')
    @livewireScripts
@endpush
