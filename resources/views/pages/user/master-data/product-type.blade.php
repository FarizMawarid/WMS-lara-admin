@extends('layouts.app')

@section('title', 'WMS')
@section('plugins.Sweetalert2', true)

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
                <a href="/admin/product-type/template" class="btn btn-outline-secondary" type="button">
                    <i class="fa-solid fa-download"></i>
                    Template
                </a>
                <button class="btn btn-success" type="button" id="btn-import-product-type">
                    <i class="fa-solid fa-file-excel"></i>
                    Import
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                                    style="display:inline"
                                    class="form-delete-product">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
</div>

<!-- Modal Add/Edit -->
<div class="modal fade" id="modalProductType" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Product Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-product-type" method="POST">
                @csrf
                <input type="hidden" id="product_id" name="product_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="po">PO</label>
                        <input type="text" class="form-control" id="po" name="po" required>
                    </div>
                    <div class="form-group">
                        <label for="kp">KP</label>
                        <input type="text" class="form-control" id="kp" name="kp" required>
                    </div>
                    <div class="form-group">
                        <label for="season">Season</label>
                        <input type="text" class="form-control" id="season" name="season" required>
                    </div>
                    <div class="form-group">
                        <label for="style">Style</label>
                        <input type="text" class="form-control" id="style" name="style" required>
                    </div>
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" class="form-control" id="destination" name="destination" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Import -->
<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Product Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-import-product-type" method="POST" enctype="multipart/form-data" action="/admin/product-type/import">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file">Choose File (XLSX / XLS)</label>
                        <input type="file" class="form-control-file" id="file" name="file" accept=".xlsx,.xls" required>
                        <small class="form-text text-muted">Format: XLSX atau XLS</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
$(document).ready(function() {
    // Add button
    $('#btn-add-product-type').on('click', function() {
        $('#product_id').val('');
        $('#form-product-type')[0].reset();
        $('#form-product-type').attr('data-mode', 'add');
        $('#modalTitle').text('Add Product Type');
        $('#modalProductType').modal('show');
    });

    // Edit button
    $(document).on('click', '.btn-edit-product', function() {
        const id = $(this).data('id');
        const po = $(this).data('po');
        const kp = $(this).data('kp');
        const season = $(this).data('season');
        const style = $(this).data('style');
        const destination = $(this).data('destination');

        $('#product_id').val(id);
        $('#po').val(po);
        $('#kp').val(kp);
        $('#season').val(season);
        $('#style').val(style);
        $('#destination').val(destination);

        $('#form-product-type').attr('data-mode', 'edit');
        $('#modalTitle').text('Edit Product Type');
        $('#modalProductType').modal('show');
    });

    // Import button
    $('#btn-import-product-type').on('click', function() {
        $('#form-import-product-type')[0].reset();
        $('#modalImport').modal('show');
    });

    // Form submit
    $('#form-product-type').on('submit', function(e) {
        e.preventDefault();
        const mode = $(this).attr('data-mode');
        const productId = $('#product_id').val();
        let action = '/admin/product-type';
        let method = 'POST';

        if (mode === 'edit') {
            action = `/admin/product-type/${productId}`;
            method = 'PUT';
        }

        const formData = new FormData(this);
        if (method === 'PUT') {
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: action,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#modalProductType').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                let errorMsg = 'Terjadi kesalahan';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }
                alert('Error: ' + errorMsg);
            }
        });
    });
});
</script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Import Berhasil',
        text: '{{ session('success') }}',
        confirmButtonColor: '#24c4dd'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Import Gagal',
        text: '{{ session('error') }}',
        confirmButtonColor: '#dd4b39'
    });
</script>
@endif
@endpush
@stop
