@extends('adminlte::page')

@section('title', 'WMS')

@section('content_header')
    <h1>Home | Warehouse Management System</h1>
@stop

@section('content')
<main class="app-main" id="main" tabindex="1">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row g-3">

                <!-- Card 1 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>Finish Goods</h3>
                            <p>Finish Goods Transaction</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Finish Goods</h3>
                            <p>Finish Goods Report</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Finish Goods</h3>
                            <p>View inventory status</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Finish Goods</h3>
                            <p>Rack Management</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>
@stop