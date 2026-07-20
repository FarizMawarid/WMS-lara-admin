@extends('layouts.app')

@section('title', 'WMS')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Transaction Out | Finish Goods</h1>
@stop

@section('content_body')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Carton Information
            </div>
        </div>
        <form class="needs-validation" method="POST" action="/admin/finish-goods-out" novalidate>
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
                        <input type="number" name="qty_carton" id="qty_carton" class="form-control" min="1" required>
                        <div class="invalid-feedback">Quantity carton melebihi sisa stok rack ini.</div>
                        <small class="form-text text-muted" id="stockCartonInfo"></small>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity Garment :</label>
                        <input type="number" name="qty_garment" id="qty_garment" class="form-control" min="1" required>
                        <div class="invalid-feedback">Quantity garment melebihi sisa stok rack ini.</div>
                        <small class="form-text text-muted" id="stockGarmentInfo"></small>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Rack :</label>
                        <select name="rack_code" id="rack_code" class="form-select select2" required>
                            <option value="" selected disabled>Select PO first</option>
                        </select>
                        <div class="invalid-feedback">Please select rack</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" type="submit">Out</button>
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
@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: @json(session('error')),
        confirmButtonText: 'OK',
        confirmButtonColor: '#dd4b39'
    });
</script>
@endif
<script>
$(function () {

    // Data sisa stok per PO -> daftar rack (hasil dari transaksi IN dikurangi OUT)
    const rackStock = @json($rackStock);

    function resetRackSelect(message) {
        const $rackSelect = $('#rack_code');
        $rackSelect.empty();
        $rackSelect.append(`<option value="" selected disabled>${message}</option>`);
        $rackSelect.trigger('change'); // refresh tampilan select2
    }

    $('#po').on('change', function () {
        const selected = $(this).find('option:selected');
        $('#style').val(selected.data('style') || '');
        $('#destination').val(selected.data('destination') || '');

        const po = $(this).val();
        const racks = rackStock[po] || [];

        const $rackSelect = $('#rack_code');
        $rackSelect.empty();

        if (racks.length === 0) {
            resetRackSelect('No stock available for this PO');
            $('#stockCartonInfo').text('');
            $('#stockGarmentInfo').text('');
            return;
        }

        $rackSelect.append('<option value="" selected disabled>Select Rack</option>');
        racks.forEach(function (r) {
            $rackSelect.append(
                `<option value="${r.rack_code}" data-remaining-carton="${r.remaining_carton}" data-remaining-garment="${r.remaining_garment}">
                    ${r.rack_code} (Sisa: ${r.remaining_carton} carton / ${r.remaining_garment} garment)
                </option>`
            );
        });

        // Kalau cuma ada 1 rack yang punya stok PO ini, langsung auto-select
        if (racks.length === 1) {
            $rackSelect.val(racks[0].rack_code);
        }

        $rackSelect.trigger('change'); // refresh select2 + trigger info sisa stok
    });

    // Tampilkan info sisa stok saat rack dipilih + batasi input qty agar tidak melebihi stok
    $('#rack_code').on('change', function () {
        const selected = $(this).find('option:selected');
        const remCarton = selected.data('remaining-carton');
        const remGarment = selected.data('remaining-garment');

        $('#stockCartonInfo').text(remCarton !== undefined ? `Sisa stok: ${remCarton} carton` : '');
        $('#stockGarmentInfo').text(remGarment !== undefined ? `Sisa stok: ${remGarment} garment` : '');

        if (remCarton !== undefined) {
            $('#qty_carton').attr('max', remCarton);
        } else {
            $('#qty_carton').removeAttr('max');
        }

        if (remGarment !== undefined) {
            $('#qty_garment').attr('max', remGarment);
        } else {
            $('#qty_garment').removeAttr('max');
        }

        // Reset validasi lama saat rack berganti
        $('#qty_carton, #qty_garment').removeClass('is-invalid');
    });

    // Validasi manual tambahan sebelum submit, jaga-jaga kalau browser tidak trigger validasi max secara otomatis
    $('form.needs-validation').on('submit', function (e) {
        const qtyCarton = parseInt($('#qty_carton').val() || 0, 10);
        const qtyGarment = parseInt($('#qty_garment').val() || 0, 10);
        const maxCarton = parseInt($('#qty_carton').attr('max'), 10);
        const maxGarment = parseInt($('#qty_garment').attr('max'), 10);

        let hasError = false;

        if (!isNaN(maxCarton) && qtyCarton > maxCarton) {
            $('#qty_carton').addClass('is-invalid');
            hasError = true;
        }
        if (!isNaN(maxGarment) && qtyGarment > maxGarment) {
            $('#qty_garment').addClass('is-invalid');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
            e.stopPropagation();
        }
    });

});
</script>
@endpush