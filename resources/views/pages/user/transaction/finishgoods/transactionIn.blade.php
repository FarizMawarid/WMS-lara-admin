@extends('layouts.app')

@section('title', 'WMS')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Transaction In | Finish Goods</h1>
@stop

@section('content_body')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Carton Information
            </div>
        </div>
        <form class="needs-validation" method="POST" action="/admin/finish-goods-manual" novalidate>
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">PO :</label>
                        <select name="po" id="po" class="form-select select2" required>
                            <option value="" selected disabled>Select PO</option>
                            @foreach($productTypes as $productType)
                                <option value="{{ $productType->po }}" data-style="{{ $productType->style }}" data-destination="{{ $productType->destination }}">{{ $productType->po }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select PO.</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Style :</label>
                        <input type="text" name="style" id="style" class="form-control" readonly required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Destination :</label>
                        <input type="text" name="destination" id="destination" class="form-control" readonly required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity Carton :</label>
                        <input type="number" name="qty_carton" class="form-control" min="1" required>
                        <div class="invalid-feedback">Please input quantity carton</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity Garment :</label>
                        <input type="number" name="qty_garment" class="form-control" min="1" required>
                        <div class="invalid-feedback">Please input quantity garment</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Rack :</label>
                        <select name="rack_code" class="form-select select2" required>
                            <option value="" selected disabled>Select Rack</option>
                            @foreach($racks as $rack)
                                <option value="{{ $rack->rack_code }}">{{ $rack->rack_code }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select rack</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
@stop

@push('js')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: @json(session('success')),
        confirmButtonText: 'OK',
        confirmButtonColor: '#28a745'
    });
</script>
@endif
<script>
$(function () {
    $('#po').on('change', function () {
        const selected = $(this).find('option:selected');
        $('#style').val(selected.data('style') || '');
        $('#destination').val(selected.data('destination') || '');
    });
});
</script>
@endpush
