@extends('adminlte::page')

@section('title', 'WMS')

@section('content_header')
    <h1>Finish Goods Dashboard</h1>
@stop

@section('content')
<main class="app-main" id="main" tabindex="1">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row g-3">

                <!-- Card 1 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-solid">
                        <div class="inner">
                            <h3>Carton In Today</h3>
                            <p>Count of In Today</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-solid fa-box"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-solid">
                        <div class="inner">
                            <h3>Carton Out Today</h3>
                            <p>Count of Out Today</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-solid fa-boxes"></i>
                        </div>
                        <a href="#" class="small-box-footer">
                            More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-solid">
                        <div class="inner">
                            <h3>-</h3>
                            <p>-</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-warehouse"></i>
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
@endsection

