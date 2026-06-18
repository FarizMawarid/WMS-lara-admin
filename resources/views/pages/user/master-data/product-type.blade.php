@extends('layouts.app')  <!-- di app.blade.php -->

@section('title', 'WMS')

@section('content_header')
    <h1>Product Type | Finish Goods</h1>
@stop

@section('content_body')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Data Master Product Type
            </div>
            <div class="card-tools">
                <button class="btn btn-danger" type="button" id="btn-add-product-type">
                    Add Product Type
                </button>
                <button class="btn btn-success" type="button" id="btn-import-product-type">
                    <i class="fa-solid fa-file-excel"></i>
                    Import
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="userTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>PO</th>
                        <th>KP</th>
                        <th>Season</th>
                        <th>Style</th>
                        <th>Destination</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/select2Addon.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('css/solid.css') }}">
<link rel="stylesheet" href="{{ asset('css/regular.css') }}">
<link rel="stylesheet" href="{{ asset('css/light.css') }}">
<link rel="stylesheet" href="{{ asset('css/duotone.css') }}">
@stop

@section('js')
<script
    src="{{ asset('js/plugins.js') }}">
</script>
<script
    src="{{ asset('js/modalAlert.js') }}">
</script>
@stop
