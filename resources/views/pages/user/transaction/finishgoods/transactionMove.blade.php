@extends('layouts.app')

@section('title', 'WMS')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Transaction Move | Finish Goods</h1>
@stop

@section('content_body')
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Move Rack Information
            </div>
        </div>

        <form class="needs-validation" method="POST" action="{{ url('admin/finish-goods-move') }}" novalidate>
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">PO :</label>
                        <select name="po" id="po" class="form-select select2" required>
                            <option value="" selected disabled>Select PO</option>
                            @foreach($poOptions as $poOption)
                                <option value="{{ $poOption }}">{{ $poOption }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select PO.</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Style :</label>
                        <input type="text" name="style" id="style" class="form-control" readonly required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Current Rack :</label>
                        <select name="from_rack_code" id="from_rack_code" class="form-select select2" required>
                            <option value="" selected disabled>Select PO first</option>
                        </select>
                        <div class="invalid-feedback">Please select current rack.</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Destination Rack :</label>
                        <select name="to_rack_code" id="to_rack_code" class="form-select select2" required>
                            <option value="" selected disabled>Select current rack first</option>
                        </select>
                        <div class="invalid-feedback">Please select destination rack (tidak boleh sama dengan rack asal).</div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity Carton :</label>
                        <input type="number" name="qty_carton" id="qty_carton" class="form-control" min="1" required>
                        <div class="invalid-feedback">Qty carton melebihi sisa stok di rack asal.</div>
                        <small class="form-text text-muted" id="maxCartonInfo"></small>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity Garment :</label>
                        <input type="number" name="qty_garment" id="qty_garment" class="form-control" min="1" required>
                        <div class="invalid-feedback">Qty garment melebihi sisa stok di rack asal.</div>
                        <small class="form-text text-muted" id="maxGarmentInfo"></small>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="alert alert-light border mb-0">
                            <h5 class="mb-3">Move Preview</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>From :</strong> <span id="previewFrom">-</span></p>
                                    <p class="mb-2"><strong>To :</strong> <span id="previewTo">-</span></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Qty Carton :</strong> <span id="previewCarton">0</span></p>
                                    <p class="mb-2"><strong>Qty Garment :</strong> <span id="previewGarment">0</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="small-box bg-info mb-0">
                            <div class="inner">
                                <h3 id="availableRackCount">0</h3>
                                <p>Available rack options</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" type="submit">Submit Move</button>
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

    // Data sisa stok per PO -> daftar rack (dari transaksi IN dikurangi OUT)
    const poRackStock = @json($poRackStock);

    // Semua kode rack yang ada di sistem (buat opsi Destination Rack)
    const allRacks = @json($racks->pluck('rack_code'));

    function resetSelect($el, placeholder) {
        $el.empty().append(`<option value="" selected disabled>${placeholder}</option>`);
        $el.trigger('change');
    }

    function updatePreview() {
        $('#previewFrom').text($('#from_rack_code').val() || '-');
        $('#previewTo').text($('#to_rack_code').val() || '-');
        $('#previewCarton').text($('#qty_carton').val() || 0);
        $('#previewGarment').text($('#qty_garment').val() || 0);
    }

    function rebuildDestinationOptions() {
        const currentRack = $('#from_rack_code').val();
        const $destSelect = $('#to_rack_code');

        $destSelect.empty().append('<option value="" selected disabled>Select Rack</option>');

        const available = allRacks.filter(r => r !== currentRack);
        available.forEach(function (rackCode) {
            $destSelect.append(`<option value="${rackCode}">${rackCode}</option>`);
        });

        $('#availableRackCount').text(available.length);
        $destSelect.trigger('change');
        updatePreview();
    }

    // 1) Pilih PO -> isi dropdown Current Rack dari rack yang masih punya stok PO ini
    $('#po').on('change', function () {
        const po = $(this).val();
        const racks = poRackStock[po] || [];

        $('#style').val('');
        $('#qty_carton').val('').removeAttr('max');
        $('#qty_garment').val('').removeAttr('max');
        $('#maxCartonInfo, #maxGarmentInfo').text('');

        const $rackSelect = $('#from_rack_code');
        $rackSelect.empty();

        if (racks.length === 0) {
            resetSelect($rackSelect, 'No stock available for this PO');
            resetSelect($('#to_rack_code'), 'Select current rack first');
            $('#availableRackCount').text(0);
            updatePreview();
            return;
        }

        $rackSelect.append('<option value="" selected disabled>Select Rack</option>');
        racks.forEach(function (r) {
            $rackSelect.append(
                `<option value="${r.rack_code}"
                    data-style="${r.style}"
                    data-remaining-carton="${r.remaining_carton}"
                    data-remaining-garment="${r.remaining_garment}">
                    ${r.rack_code} (Sisa: ${r.remaining_carton} carton / ${r.remaining_garment} garment)
                </option>`
            );
        });

        if (racks.length === 1) {
            $rackSelect.val(racks[0].rack_code);
        }

        $rackSelect.trigger('change');
    });

    // 2) Pilih Current Rack -> auto-fill Style, Qty Carton, Qty Garment (max = sisa stok)
    $('#from_rack_code').on('change', function () {
        const selected = $(this).find('option:selected');
        const style = selected.data('style');
        const remCarton = selected.data('remaining-carton');
        const remGarment = selected.data('remaining-garment');

        if (style === undefined) {
            $('#style').val('');
            $('#qty_carton').val('').removeAttr('max');
            $('#qty_garment').val('').removeAttr('max');
            $('#maxCartonInfo, #maxGarmentInfo').text('');
        } else {
            $('#style').val(style);
            $('#qty_carton').val(remCarton).attr('max', remCarton);
            $('#qty_garment').val(remGarment).attr('max', remGarment);
            $('#maxCartonInfo').text(`Maksimal: ${remCarton} carton`);
            $('#maxGarmentInfo').text(`Maksimal: ${remGarment} garment`);
        }

        $('#qty_carton, #qty_garment').removeClass('is-invalid');
        rebuildDestinationOptions();
    });

    $('#to_rack_code').on('change', updatePreview);
    $('#qty_carton, #qty_garment').on('input', updatePreview);

    // Validasi tambahan sebelum submit: qty tidak boleh melebihi max, rack tujuan != rack asal
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
        if ($('#from_rack_code').val() && $('#from_rack_code').val() === $('#to_rack_code').val()) {
            $('#to_rack_code').addClass('is-invalid');
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
            e.stopPropagation();
        }
    });

    updatePreview();
});
</script>
@endpush