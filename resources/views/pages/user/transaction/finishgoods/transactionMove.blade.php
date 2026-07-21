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

        <form class="needs-validation" method="POST" action="#" novalidate>
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">PO :</label>
                        <select class="form-select select2" required>
                            <option value="" selected disabled>Select PO</option>
                            <option value="PO-001">PO-001</option>
                            <option value="PO-002">PO-002</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Style :</label>
                        <input type="text" class="form-control" value="ST-001" readonly>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Current Rack :</label>
                        <select class="form-select select2" required>
                            <option value="" selected disabled>Select Rack</option>
                            <option value="R-01">R-01</option>
                            <option value="R-02">R-02</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Destination Rack :</label>
                        <select class="form-select select2" required>
                            <option value="" selected disabled>Select Rack</option>
                            <option value="R-03">R-03</option>
                            <option value="R-04">R-04</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity Carton :</label>
                        <input type="number" class="form-control" min="1" value="10" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantity Garment :</label>
                        <input type="number" class="form-control" min="1" value="120" required>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="alert alert-light border mb-0">
                            <h5 class="mb-3">Move Preview</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>From :</strong> R-01</p>
                                    <p class="mb-2"><strong>To :</strong> R-03</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Qty Carton :</strong> 10</p>
                                    <p class="mb-2"><strong>Qty Garment :</strong> 120</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="small-box bg-info mb-0">
                            <div class="inner">
                                <h3>2</h3>
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

