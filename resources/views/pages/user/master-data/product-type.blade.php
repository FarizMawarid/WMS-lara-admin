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

                <tbody>

                    @foreach ($products as $product)

                    <tr>
                        <td>{{ $product->po }}</td>
                        <td>{{ $product->kp }}</td>
                        <td>{{ $product->season }}</td>
                        <td>{{ $product->style }}</td>
                        <td>{{ $product->destination }}</td>

                        <td>

                          <button
                                class="btn btn-primary btn-sm btn-edit-product"
                                data-id="{{ $product->id }}"
                                data-po="{{ $product->po }}"
                                data-kp="{{ $product->kp }}"
                                data-season="{{ $product->season }}"
                                data-style="{{ $product->style }}"
                                data-destination="{{ $product->destination }}">
                                Edit
                            </button>  
                        <form
                            action="/admin/product-type/{{ $product->id }}"
                            method="POST"
                            style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm btn-delete-product">
                                Delete
                            </button>

                        </form>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<form
    id="form-add-product-type"
    action="/admin/product-type"
    method="POST"
    style="display:none">

    @csrf

    <input type="hidden" name="po" id="po">
    <input type="hidden" name="kp" id="kp">
    <input type="hidden" name="season" id="season">
    <input type="hidden" name="style" id="style">
    <input type="hidden" name="destination" id="destination">

</form>
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
