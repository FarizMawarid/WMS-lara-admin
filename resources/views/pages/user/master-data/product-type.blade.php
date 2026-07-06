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
<div class="card card-primary" id="card-add-product-type" style="display:none">
    <div class="card-header">
        <h3 class="card-title">Add Product Type</h3>
    </div>
    <form
        id="form-add-product-type"
        action="/admin/product-type"
        method="POST">

        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="po">PO</label>
                <input type="text" class="form-control" id="po" name="po" placeholder="Enter PO">
            </div>

            <div class="form-group">
                <label for="kp">KP</label>
                <input type="text" class="form-control" id="kp" name="kp" placeholder="Enter KP">
            </div>

            <div class="form-group">
                <label for="season">Season</label>
                <input type="text" class="form-control" id="season" name="season" placeholder="Enter Season">
            </div>

            <div class="form-group">
                <label for="style">Style</label>
                <input type="text" class="form-control" id="style" name="style" placeholder="Enter Style">
            </div>

            <div class="form-group">
                <label for="destination">Destination</label>
                <input type="text" class="form-control" id="destination" name="destination" placeholder="Enter Destination">
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" id="btn-cancel-product-type">Cancel</button>
        </div>
    </form>
</div>
@stop
