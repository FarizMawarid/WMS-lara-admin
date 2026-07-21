@extends('layouts.app')

@section('title', 'WMS')

@section('content_body')
<main class="app-main" id="main" tabindex="1">
    <!-- Welcome Dashboard Section -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-1">
                <div class="col-12">
                    <div class="card card-outline card-primary mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <i class="fas fa-sharp fa-solid fa-bullhorn fa-lg" style="color: #007bff;"></i>
                                <span class="ms-2">Welcome to Warehouse Management System</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>Halo, {{ Auth::user()->name }}!</h5>
                            <p class="text-muted">Last login: {{ Auth::user()->updated_at ? Auth::user()->updated_at->diffForHumans() : 'Baru' }}</p>
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
                            <span class="info-box-number">{{ $totalRacks ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Users</span>
                            <span class="info-box-number">{{ $totalUsers ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="fas fa-layer-group"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Product Types</span>
                            <span class="info-box-number">{{ $totalProductTypes ?? 0 }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="info-box">
                        <span class="info-box-icon bg-purple"><i class="fas fa-history"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Transactions Today</span>
                            <span class="info-box-number">{{ $transactionsToday ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transaction Log Terbaru -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-title">
                                <i class="fas fa-exchange-alt fa-lg" style="color: #007bff;"></i>
                                <span class="ms-2">Recent Transactions</span>
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
                                            <th width="20%">Description</th>
                                            <th width="25%">Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentTransactions as $transaction)
                                        <tr>
                                            <td>
                                                <span class="badge bg-info">{{ $transaction->rack_code }}</span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $transaction->action_type === 'in' ? 'bg-success' : 'bg-danger' }}">
                                                    <i class="fas fa-arrow-{{ $transaction->action_type === 'in' ? 'down' : 'up' }}"></i>
                                                    {{ strtoupper($transaction->action_type) }}
                                                </span>
                                            </td>
                                            <td>
                                                <strong>{{ $transaction->qty_carton }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">-</span>
                                            </td>
                                            <td>
                                                {{ $transaction->po }} - {{ $transaction->destination }}
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $transaction->created_at->format('d M Y, H:i') }}</small>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                No recent transactions available.
                                            </td>
                                        </tr>
                                        @endforelse
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
