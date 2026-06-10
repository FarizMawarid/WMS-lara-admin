@extends('adminlte::page')

@section('title', 'WMS')

@section('content_header')
    <h1>Transaction In (Manual) | Finish Goods</h1>
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
                            <option selected disabled>
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
                            <option>Style A</option>
                            <option>Style B</option>
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
                            <option>Destination A</option>
                            <option>Destination B</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Quantity Carton :
                        </label>
                        <input type="number" class="form-control" required>
                        <div class="invalid-feedback">
                            Please input quantity carton
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Quantity Garment :
                        </label>
                        <input type="number" class="form-control" required>
                        <div class="invalid-feedback">
                            Please input quantity garment
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Rack :
                        </label>
                        <select class="form-select select2" required>
                            <option selected disabled>
                                Select Rack
                            </option>
                            <option>Rack A</option>
                            <option>Rack B</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select rack
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@stop


@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
<link rel="stylesheet" href="{{ asset('css/select2Addon.css') }}">
@stop

@section('js')
<script
    src="{{ asset('js/index.js') }}">
</script>
@stop
