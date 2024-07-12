@extends('layouts.master-layouts')
@section('title')
    @lang('translation.Horizontal')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Layouts
        @endslot
        @slot('title')
            Horizontal
        @endslot
    @endcomponent
@endsection


@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
