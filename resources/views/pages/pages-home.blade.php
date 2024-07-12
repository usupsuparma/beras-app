@extends('layouts.master-layouts')
@section('title')
    @lang('translation.Starter_Page')
@endsection
@section('content')
    {{-- @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Starter Page
        @endslot
    @endcomponent --}}
    <div style="height: 70vh;" class="div">
        <div class="d-flex h-100 flex-column justify-content-evenly align-items-center">
            <h1>Pabrik Beras Agung Jaya</h1>
            <h3>Buka 08:00 - 18:00 WIB</h3>
            <h3>Blok Heuleut RT/RW 003/006 Desa cieurih kec maja kab majalengka</h3>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
