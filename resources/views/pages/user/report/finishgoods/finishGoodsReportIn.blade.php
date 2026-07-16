@extends('layouts.app')  <!-- di app.blade.php -->

@section('title', 'WMS')

@section('content_header')
    <h1>Report In | Finish Goods</h1>
@stop

@section('content_body')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <h3 class="card-title">Carton Information</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <form method="GET" action="{{ url('/admin/finish-goods-reportIn') }}">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">PO :</label>
                        <select name="po" class="form-select select2">
                            <option value="">All PO</option>
                            @foreach($productTypes as $productType)
                                <option value="{{ $productType->po }}" {{ request('po') === $productType->po ? 'selected' : '' }}>{{ $productType->po }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Start Date :</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Until Date :</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2 align-self-end">
                        <button class="btn btn-info" type="submit">Find</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Report Finish Goods In
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
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                                <td>Finish Goods</td>
                                <td>{{ $transaction->po }}</td>
                                <td>{{ $transaction->style }}</td>
                                <td>{{ $transaction->destination }}</td>
                                <td>{{ $transaction->qty_garment }}</td>
                                <td>{{ $transaction->qty_carton }}</td>
                                <td>{{ $transaction->rack_code }}</td>
                                <td>-</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Belum ada transaksi masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
