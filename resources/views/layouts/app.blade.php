@extends('adminlte::page')

@section('title')
    {{ config('adminlte.title') }}
    @hasSection('subtitle') | @yield('subtitle') @endif
@stop

{{-- Extend and customize the page content header --}}

@section('content_header')
    @hasSection('content_header_title')
        <h1 class="text-muted">
            @yield('content_header_title')

            @hasSection('content_header_subtitle')
                <small class="text-dark">
                    <i class="fas fa-xs fa-angle-right text-muted"></i>
                    @yield('content_header_subtitle')
                </small>
            @endif
        </h1>
    @endif
@stop

{{-- Rename section content to content_body --}}

@section('content')
    @yield('content_body')
@stop

{{-- Create a common footer --}}

@section('footer')
    <div class="float-right">
        Version: {{ config('app.version', '1.0.0') }}
    </div>
    <strong>
        <a href="{{ config('app.company_url', 'http://one.panbrothers.co.id/') }}">
            {{ config('app.company_name', 'Eco Smart Garment Indonesia') }}
        </a>
    </strong>
@stop


{{-- Add common Javasript customizations --}}
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/index.js') }}"></script>
<script src="{{ asset('js/modalAlert.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
@endpush

{{-- Initialize Select2 after page load --}}
@push('js')
<script>
    $(function() {
        if ($('.select2').length) {
            $('.select2').select2({
                width: '100%',
                allowClear: false
            });
        }
    });
</script>
@endpush

{{-- Add common CSS customizations --}}
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
<link rel="stylesheet" href="{{ asset('css/select2Addon.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('css/solid.css') }}">
<link rel="stylesheet" href="{{ asset('css/regular.css') }}">
<link rel="stylesheet" href="{{ asset('css/light.css') }}">
<link rel="stylesheet" href="{{ asset('css/duotone.css') }}">
@endpush
