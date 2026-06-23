@extends('layouts.app')  <!-- di app.blade.php -->

@section('title', 'WMS')

@section('content_header')
    <h1>Transaction In (Barcode) | Finish Goods</h1>
@stop

@section('content_body')
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
                    <div class="col-md-12">
                        <label class="form-label">
                            Rack :
                        </label>
                        <select class="form-select select2">
                            <option>
                                Select Rack
                            </option>
                            <option>Rack A</option>
                            <option>Rack B</option>
                        </select>
                    </div>
                </div>
            </div>
            <form action="{{ url('admin/finish-goods-barcode-transaction') }}" method="POST">
                @csrf
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">
                        Submit
                    </button>
                </div>
            </form>
        </form>
    </div>
</div>
@stop


@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.select2-container {
    width: 100% !important;
}
.select2-container .select2-selection--single {
    height: 38px !important;
    padding-top: 4px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 28px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
}
body {
    overflow-x: hidden;
}
</style>
@stop

@section('js')
<script>
    $(document).ready(function () {

        $('.select2').select2({
            width: '100%'
        });

    });
</script>
@stop
