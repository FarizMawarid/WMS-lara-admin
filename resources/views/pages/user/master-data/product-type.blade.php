@extends('adminlte::page')

@section('title', 'WMS')

@section('content_header')
    <h1>Product Type | Finish Goods</h1>
@stop

@section('content')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Data Master Product Type
            </div>
            <div class="card-tools">
                <button class="btn btn-info" type="button" id="btn-add-product-type">
                    Add Product Type
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
                    </tr>
                </thead>
            </table>
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
