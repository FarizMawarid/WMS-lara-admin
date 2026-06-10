@extends('adminlte::page')

@section('title', 'WMS')

@section('content_header')
    <h1>Transaction Out | Finish Goods</h1>
@stop

@section('content')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Carton Information
            </div>
        </div>
        <form class="needs-validation" novalidate>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">
                            PO :
                        </label>
                        <select class="form-select select2" required>
                            <option value="" selected disabled>
                                Select PO
                            </option>
                            <option>PO-001</option>
                            <option>PO-002</option>
                            <option>PO-003</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select PO.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Style :
                        </label>
                        <select class="form-select select2" disabled>
                            <option selected disabled>
                                Select Style
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Destination :
                        </label>
                        <select class="form-select select2" disabled>
                            <option selected disabled>
                                Select Destination
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" type="submit">
                    Find
                </button>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Carton In
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>PO</th>
                            <th>Style</th>
                            <th>Destination</th>
                            <th>Token</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ESGI Klego</td>
                            <td>Finish Goods 1</td>
                            <td>192.168.1.100</td>
                            <td>http://warehouse-management-system-esgi-klego</td>
                            <td>
                                <button class="btn btn-danger btn-sm" type="button" id="btn-delete-token">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop


@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
<link rel="stylesheet" href="{{ asset('css/select2Addon.css') }}">
<style>
    body{
        overflow: hidden;
    }
</style>
@stop

@section('js')
<script
    src="{{ asset('js/index.js') }}">
</script>
@stop
