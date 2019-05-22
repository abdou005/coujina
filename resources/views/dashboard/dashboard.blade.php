@extends('dashboard.layouts.app')
@section('title')
    {{trans('messages.dashboard')}}
@endsection
@section('body_class','hold-transition skin-green-light sidebar-mini')

@section('content')
    <div class="wrapper">
        @include('dashboard.sections.header')
        @include('dashboard.sections.navigation')
        <div class="content-wrapper">
            @yield('contentPage')
        </div>
        @include('dashboard.sections.footer')
        {{--@include('admin.sections.sidebar')--}}
    </div>
    <div class="modals">
        @include('dashboard.includes.modal.logout')
        @include('dashboard.includes.modal.image')
        @include('dashboard.includes.modal.confirm-modal')
        @stack('modals')
    </div>
@endsection

@section('styles')
    @stack('stylesForAc')
@endsection
@section('scripts')
    <!-- AdminLTE App -->
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/formdata-polyfill.js')}}"></script>
    <script>
        /**
         * add the token to all request headers. This provides simple,
         * convenient CSRF protection for your AJAX based applications:
         */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scriptsForAc')
@endsection
