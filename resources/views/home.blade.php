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
                        <i class="fas fa-home text-primary"></i>
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
                        <div class="col-sm-2">
                            <div class="card text-center p-1 broder-0 text-bold">
                                <h4>
                                    <i
                                        class="fas fa-exchange-alt text-warning">
                                    </i>
                                </h4>
                                Transaction
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="card text-center p-1 broder-0 text-bold">
                                <h4>
                                    <i
                                        class="fas fa-exchange-alt text-warning">
                                    </i>
                                </h4>
                                Report
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
