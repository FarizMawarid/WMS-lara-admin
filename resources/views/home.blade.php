@extends('adminlte::page')

@section('title', 'WMS')

@section('content_header')
    <h1>Home | Warehouse Management System</h1>
@stop

@section('content')
<main class="app-main" id="main" tabindex="1">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <div class="card-title">
                        <i
                            class="fa-duotone fa-thin fa-lightbulb-exclamation-on fa-flip fa-lg"
                            style=
                                "--fa-primary-color: rgb(227, 18, 18);
                                --fa-secondary-color: rgb(194, 205, 40);
                                --fa-animation-duration: 3s;"
                                >
                        </i>
                        <span>Dashboard</span>
                    </div>
                    <div class="card-tools">
                        <!-- Collapse Button -->
                        <button
                            type="button"
                            class="btn btn-tool"
                            data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card text-center p-1 border-0">
                            <h4>
                                <i
                                    class="fad fa-scanner fa-3x"
                                    style=
                                        "--fa-primary-color: firebrick;
                                        --fa-secondary-color: dodgerblue;"
                                        >
                                </i>
                            </h4>
                            Scan Transaction
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-center p-1 border-0">
                            <h4>
                                <i
                                    class="fad fa-tablet-alt fa-3x"
                                    style=
                                        "--fa-primary-color: firebrick;
                                        --fa-secondary-color: dodgerblue;"
                                        >
                                </i>
                            </h4>
                            Manual Transaction
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-center p-1 border-0">
                            <h4>
                                <i
                                    class="fad fa-analytics fa-3x"
                                    style=
                                        "--fa-primary-color: firebrick;
                                        --fa-secondary-color: dodgerblue;"
                                        >
                                </i>
                            </h4>
                            Report Stock
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-center p-1 border-0">
                            <h4>
                                <i
                                    class="fad fa-chart-pie fa-3x"
                                    style=
                                        "--fa-primary-color: firebrick;
                                        --fa-secondary-color: dodgerblue;"
                                        >
                                </i>
                            </h4>
                            Dashboard
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</main>
@stop

@push('css')
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('css/solid.css') }}">
<link rel="stylesheet" href="{{ asset('css/regular.css') }}">
<link rel="stylesheet" href="{{ asset('css/light.css') }}">
<link rel="stylesheet" href="{{ asset('css/duotone.css') }}">
@endpush
