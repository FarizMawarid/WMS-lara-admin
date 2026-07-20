@extends('layouts.app')

@section('title', 'WMS - Finish Goods Dashboard')

@section('content_header')
    <h2 class="fw-bold mb-0">FINISHED GOODS DASHBOARD</h2>
@stop

@section('content_body')
@php
    $summaryCards = [
        [
            'title' => 'Total Karton',
            'value' => $totalKarton,
            'icon' => 'boxes',
            'class' => 'accent-blue',
            'footer' => '<i class="fas fa-arrow-up me-1"></i>' . $percentageChange . '% vs Yesterday',
        ],
        [
            'title' => 'Incoming Today',
            'value' => $incomingToday,
            'icon' => 'sign-in-alt',
            'class' => 'accent-green',
            'footer' => '<i class="fas fa-cube me-1"></i>' . $incomingCount . ' Transaction',
        ],
        [
            'title' => 'Outgoing Today',
            'value' => $outgoingToday,
            'icon' => 'sign-out-alt',
            'class' => 'accent-orange',
            'footer' => '<i class="fas fa-cube me-1"></i>' . $outgoingCount . ' Transaction',
        ],
    ];
@endphp

<div class="app-content-header dashboard-shell">
    <div class="container-fluid">
        <div class="row g-3 mb-3">
            @foreach ($summaryCards as $card)
                <div class="col-lg-3 col-md-6">
                    <div class="card dashboard-card border-0 shadow-sm h-100 {{ $card['class'] }}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="text-white-50 mb-2">{{ $card['title'] }}</h6>
                                    <h2 class="mb-0 text-white">{{ $card['value'] }}</h2>
                                </div>
                                <i class="fas fa-{{ $card['icon'] }} fa-2x text-white-50"></i>
                            </div>
                            <small class="text-white-50">{!! $card['footer'] !!}</small>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-lg-3 col-md-6">
                <div class="card dashboard-card accent-dark border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="date-box">
                            <label class="small text-white-50 d-block mb-1">Date</label>
                            <form action="{{ route('finish-goods-dashboard') }}" method="GET" class="d-flex flex-column gap-2">
                                <input type="date" name="date" class="form-control form-control-sm" id="datePicker" value="{{ $selectedDate }}" onchange="this.form.submit()">
                            </form>
                            <small class="text-white-50 d-block mt-2" id="dateDisplay">
                                {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-xl-8 col-lg-7">
                <div class="card dashboard-panel border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-2">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <h5 class="mb-0 fw-bold">Layout Rack</h5>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <form method="GET" action="{{ route('finish-goods-dashboard') }}" class="d-flex gap-2 align-items-center">
                                    <input type="hidden" name="date" value="{{ $selectedDate }}">
                                    <select name="factory" class="form-select form-select-sm dashboard-select">
                                        @foreach ($factoryOptions as $factoryOption)
                                            <option value="{{ $factoryOption }}" {{ $selectedFactory === $factoryOption ? 'selected' : '' }}>{{ $factoryOption }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-sm btn-outline-secondary" type="submit">Go</button>
                                </form>
                                <div class="input-group dashboard-search">
                                    <input type="text" class="form-control form-control-sm" placeholder="Search PO" id="rackSearch">
                                    <button class="btn btn-sm btn-outline-secondary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge badge-filled">Filled: {{ $filledRacks }}</span>
                            <span class="badge badge-available">Available: {{ $emptyRacks }}</span>
                            <span class="badge badge-factory">Factory: {{ $factoryName }}</span>
                        </div>

                        <div class="rack-grid" id="rackContainer">
                            @foreach ($rackStatus as $rack)
                                <div class="rack-item" data-rack="{{ $rack['rack_code'] }}" data-po="{{ strtolower($rack['po']) }}">
                                    <div class="rack-cell {{ $rack['status'] === 'filled' ? 'rack-filled' : 'rack-available' }}">
                                        <div class="rack-code fw-bold">{{ $rack['rack_code'] }}</div>
                                        <div class="rack-po">PO: {{ $rack['po'] }}</div>
                                        <div class="rack-carton">Carton: {{ $rack['cartons'] }}</div>
                                        <div class="rack-status {{ $rack['status'] === 'filled' ? 'text-danger' : 'text-success' }}">
                                            {{ $rack['status'] === 'filled' ? 'Filled' : 'Available' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5 d-flex flex-column gap-2">
                <div class="card dashboard-panel border-0 shadow-sm activity-card">
                    <div class="card-header bg-white border-0 py-2">
                        <h5 class="mb-0 fw-bold">Live Activity</h5>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-muted">Time</th>
                                        <th class="text-muted">Rack</th>
                                        <th class="text-muted">Carton</th>
                                        <th class="text-muted">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($liveActivity as $activity)
                                        <tr>
                                            <td class="small fw-bold">{{ $activity['time'] }}</td>
                                            <td class="small">{{ $activity['rack_code'] }}</td>
                                            <td class="small">{{ $activity['qty_carton'] }}</td>
                                            <td class="text-end">
                                                @if ($activity['empty'])
                                                    <span class="badge bg-secondary">No Data</span>
                                                @elseif ($activity['action_type'] == 'in')
                                                    <span class="badge bg-success">In</span>
                                                @else
                                                    <span class="badge bg-danger">Out</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card dashboard-panel border-0 shadow-sm utilization-card">
                    <div class="card-body">
                        <div class="row align-items-center g-2">
                            <div class="col-7">
                                <div class="row text-center g-2">
                                    <div class="col-4">
                                        <h4 class="text-primary mb-1">{{ $totalRacks }}</h4>
                                        <small class="text-muted">Total</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-warning mb-1">{{ $emptyRacks }}</h4>
                                        <small class="text-muted">Availeble</small>
                                    </div>
                                    <div class="col-4">
                                        <h4 class="text-success mb-1">{{ $filledRacks }}</h4>
                                        <small class="text-muted">Filled</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5 text-center">
                                <div class="utilization-chart-wrap">
                                    <canvas id="utilizationChart"></canvas>
                                </div>
                                <h4 class="mb-1 text-dark">{{ number_format($utilization, 1) }}%</h4>
                                <small class="text-muted">Utilization</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const datePicker = document.getElementById('datePicker');
    const dateDisplay = document.getElementById('dateDisplay');

    if (datePicker && dateDisplay) {
        datePicker.addEventListener('change', function () {
            const date = new Date(this.value);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            dateDisplay.textContent = date.toLocaleDateString('en-US', options);
        });
    }

    const rackSearch = document.getElementById('rackSearch');
    if (rackSearch) {
        rackSearch.addEventListener('keyup', function () {
            const searchValue = this.value.toLowerCase();
            const rackItems = document.querySelectorAll('.rack-item');

            rackItems.forEach(item => {
                const rackCode = item.getAttribute('data-rack').toLowerCase();
                const poValue = item.getAttribute('data-po').toLowerCase();
                const match = rackCode.includes(searchValue) || poValue.includes(searchValue);
                item.style.display = match ? '' : 'none';
            });
        });
    }

    const ctx = document.getElementById('utilizationChart');
    if (ctx) {
        const utilization = {{ $utilization }};
        const remaining = 100 - utilization;

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Used', 'Available'],
                datasets: [{
                    data: [utilization, remaining],
                    backgroundColor: ['#3b82f6', '#e5e7eb'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    setInterval(function () {
        location.reload();
    }, 120000);
</script>
@endpush

@push('css')
<style>
    body {
        background: #f4f7fb;
    }

    .dashboard-shell .container-fluid {
        max-width: 1800px;
    }

    .dashboard-card {
        border-radius: 16px;
        color: #fff;
    }

    .dashboard-card .card-body {
        padding: 1rem 1.2rem;
    }

    .dashboard-card h2 {
        font-size: 2rem;
        font-weight: 700;
    }

    .accent-blue {
        background: linear-gradient(135deg, #1f4f8b 0%, #2d6cdf 100%);
    }

    .accent-green {
        background: linear-gradient(135deg, #0f7a4a 0%, #22c55e 100%);
    }

    .accent-orange {
        background: linear-gradient(135deg, #c96f00 0%, #f59e0b 100%);
    }

    .accent-dark {
        background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    }

    .dashboard-panel {
        border-radius: 16px;
    }

    .dashboard-select {
        min-width: 170px;
    }

    .dashboard-search {
        width: 220px;
    }

    .activity-card {
        max-height: 320px;
        overflow: hidden;
    }

    .activity-card .card-body {
        padding: 0.5rem 0.6rem;
        overflow-y: auto;
    }

    .activity-card .table {
        font-size: 0.78rem;
    }

    .activity-card .table th,
    .activity-card .table td {
        padding: 0.28rem 0.35rem;
    }

    .utilization-card {
        min-height: 160px;
    }

    .utilization-card .card-body {
        padding: 0.75rem 0.8rem;
    }

    .utilization-chart-wrap {
        position: relative;
        width: 110px;
        height: 110px;
        margin: 0 auto;
    }

    .date-box {
        min-width: 210px;
    }

    .date-box input {
        border-radius: 8px;
    }

    .rack-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(115px, 1fr));
        gap: 0.55rem;
    }

    .rack-item {
        min-width: 0;
    }

    .rack-cell {
        min-height: 92px;
        border-radius: 10px;
        padding: 0.45rem;
        border: 1px solid transparent;
        box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.7);
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        line-height: 1.2;
    }

    .rack-filled {
        background: linear-gradient(135deg, #fff4f4 0%, #ffd7d7 100%);
        border-color: #f4a7a7 !important;
    }

    .rack-available {
        background: linear-gradient(135deg, #f3fff7 0%, #dff8e8 100%);
        border-color: #8ee0a5 !important;
    }

    .rack-code {
        font-size: 0.9rem;
        color: #111827;
        margin-bottom: 0.2rem;
    }

    .rack-po,
    .rack-carton,
    .rack-status {
        font-size: 0.72rem;
        color: #4b5563;
    }

    .badge-filled {
        background: #ef4444;
        color: #fff;
    }

    .badge-available {
        background: #16a34a;
        color: #fff;
    }

    .badge-factory {
        background: #3b82f6;
        color: #fff;
    }

    .table th,
    .table td {
        padding: 0.45rem 0.5rem;
        vertical-align: middle;
    }

    .badge {
        font-size: 0.72rem;
        padding: 0.35rem 0.55rem;
    }
</style>
@endpush

