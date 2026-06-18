@extends('layouts.app')  <!-- di app.blade.php -->

@section('title', 'WMS')

@section('content_header')
    <h1>Report In | Finish Goods</h1>
@stop

@section('content')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Carton Information</h3>
            <div class="card-tools">
                <button
                    type="button"
                    class="btn btn-tool"
                    data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
            <div class="card-body">
                <div class="row g-3">
                    {{-- FILTER --}}
                    <div class="col-md-2">
                        <label class="form-label">Filter :</label>
                        <select id="filterType" class="form-select select2" required>
                            <option selected disabled>Select Filter</option>
                            <option value="po">PO</option>
                            <option value="date">Date</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a filter.
                        </div>
                    </div>
                    {{-- PO FILTER --}}
                    <div class="col-md-2 filter-po">
                        <label class="form-label">PO :</label>
                        <select class="form-select select2" required>
                            <option selected disabled>Select PO</option>
                            <option>PO-001</option>
                            <option>PO-002</option>
                            <option>PO-003</option>
                        </select>
                    </div>
                    {{-- STYLE --}}
                    <div class="col-md-2 filter-po">
                        <label class="form-label">Style :</label>
                        <select class="form-select select2" disabled>
                            <option selected disabled>Select Style</option>
                        </select>
                    </div>
                    {{-- DESTINATION --}}
                    <div class="col-md-2 filter-po">
                        <label class="form-label">Destination :</label>
                        <select class="form-select select2" disabled>
                            <option selected disabled>Select Destination</option>
                        </select>
                    </div>
                    {{-- DATE FILTER --}}
                    <div class="col-md-2 filter-date d-none">
                        <label class="form-label">Start Date :</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-2 filter-date d-none">
                        <label class="form-label">Until Date :</label>
                        <input type="date" class="form-control">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" type="submit">
                    Find
                </button>
            </div>
    </div>
</div>
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Report Finish Goods Out
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Department</th>
                            <th>PO</th>
                            <th>Style</th>
                            <th>Destination</th>
                            <th>Qty Garment In</th>
                            <th>Qty Carton In</th>
                            <th>Rack</th>
                            <th>PIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2025-14-01</td>
                            <td>Finish Goods 1</td>
                            <td>PO-001</td>
                            <td>Style A</td>
                            <td>Destination A</td>
                            <td>1000</td>
                            <td>100</td>
                            <td>Rack 1</td>
                            <td>John Doe</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/select2Addon.css') }}">
@stop

@section('js')
<script
    src="{{ asset('js/plugins.js') }}">
</script>
<script
    src="{{ asset('js/modalAlert.js') }}">
</script>
@stop
