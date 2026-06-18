@extends('layouts.app')

@section('title', 'WMS')

@section('content_body')
<main class="app-main" id="main" tabindex="1">
    <!-- Welcome Dashboard Section -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-1 mt-4">
                <div class="col-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-sharp fa-solid fa-bullhorn fa-lg" style="color: #007bff;"></i>
                                <span class="ms-2">Welcome to Home</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>Halo, {{ Auth::user()->name }}!</h5>
                            <p class="text-muted">your last login at {{ now()->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-1">
                <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="fas fa-boxes"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Racks</span>
                            <span class="info-box-number">{{ \App\Models\Rack::count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Users</span>
                            <span class="info-box-number">{{ \App\Models\User::count() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Last Login</span>
                            <span class="info-box-number" style="font-size: 14px;">
                                {{ Auth::user()->updated_at ? Auth::user()->updated_at->diffForHumans() : 'Baru' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="fas fa-cog"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Status Sistem</span>
                            <span class="info-box-number" style="font-size: 14px; color: #28a745;">Active</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Log Terbaru -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fas fa-exchange-alt fa-lg" style="color: #007bff;"></i>
                                <span class="ms-2">Transaction Log</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th width="15%">Rack Code</th>
                                            <th width="10%">Type</th>
                                            <th width="12%">Quantity</th>
                                            <th width="18%">User</th>
                                            <th width="20%">Deskripsi</th>
                                            <th width="25%">Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Dummy Data -->
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">RAC-001</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success"><i class="fas fa-arrow-down"></i> IN</span>
                                            </td>
                                            <td>
                                                <strong>50</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">Admin User</span>
                                            </td>
                                            <td>
                                                Carton masuk dari PO-2025-001
                                            </td>
                                            <td>
                                                <small class="text-muted">17 Juni 2026, 14:35</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">RAC-002</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger"><i class="fas fa-arrow-up"></i> OUT</span>
                                            </td>
                                            <td>
                                                <strong>25</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">Warehouse Staff</span>
                                            </td>
                                            <td>
                                                Carton keluar ke Destination A
                                            </td>
                                            <td>
                                                <small class="text-muted">17 Juni 2026, 13:20</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">RAC-003</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success"><i class="fas fa-arrow-down"></i> IN</span>
                                            </td>
                                            <td>
                                                <strong>75</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">Admin User</span>
                                            </td>
                                            <td>
                                                Carton masuk dari PO-2025-002
                                            </td>
                                            <td>
                                                <small class="text-muted">17 Juni 2026, 11:45</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">RAC-001</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger"><i class="fas fa-arrow-up"></i> OUT</span>
                                            </td>
                                            <td>
                                                <strong>30</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">Warehouse Staff</span>
                                            </td>
                                            <td>
                                                Carton keluar ke Destination B
                                            </td>
                                            <td>
                                                <small class="text-muted">17 Juni 2026, 10:15</small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">RAC-004</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success"><i class="fas fa-arrow-down"></i> IN</span>
                                            </td>
                                            <td>
                                                <strong>100</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">Admin User</span>
                                            </td>
                                            <td>
                                                Carton masuk dari PO-2025-003
                                            </td>
                                            <td>
                                                <small class="text-muted">17 Juni 2026, 09:30</small>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
