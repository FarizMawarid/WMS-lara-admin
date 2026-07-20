@extends('layouts.app')

@section('title', 'Transaction In Out Log')

@section('content_header')
    <h1>Transaction In / Out Log</h1>
@stop

@section('content_body')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-info card-outline mb-4">
            <div class="card-header">
                <h3 class="card-title">{{ $editTransaction ? 'Edit Transaction' : 'Add Transaction' }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ $editTransaction ? route('admin.transaction-log.update', $editTransaction->id) : route('admin.transaction-log.store') }}">
                    @csrf
                    @if($editTransaction)
                        @method('PUT')
                    @endif
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">PO</label>
                            <select name="po" class="form-control" required>
                                <option value="">-- Select PO --</option>
                                @foreach($productTypes as $productType)
                                    <option value="{{ $productType->po }}" {{ ($editTransaction?->po ?? old('po')) == $productType->po ? 'selected' : '' }}>{{ $productType->po }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Style</label>
                            <input type="text" name="style" class="form-control" value="{{ $editTransaction?->style ?? old('style') }}" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Destination</label>
                            <input type="text" name="destination" class="form-control" value="{{ $editTransaction?->destination ?? old('destination') }}" required>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">Qty Carton</label>
                            <input type="number" name="qty_carton" class="form-control" value="{{ $editTransaction?->qty_carton ?? old('qty_carton') }}" required>
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">Qty Garment</label>
                            <input type="number" name="qty_garment" class="form-control" value="{{ $editTransaction?->qty_garment ?? old('qty_garment') }}" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Rack</label>
                            <select name="rack_code" class="form-control" required>
                                <option value="">-- Select Rack --</option>
                                @foreach($racks as $rack)
                                    <option value="{{ $rack->rack_code }}" {{ ($editTransaction?->rack_code ?? old('rack_code')) == $rack->rack_code ? 'selected' : '' }}>{{ $rack->rack_code }} ({{ $rack->factory }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Type</label>
                            <select name="action_type" class="form-control" required>
                                <option value="in" {{ ($editTransaction?->action_type ?? old('action_type')) == 'in' ? 'selected' : '' }}>In</option>
                                <option value="out" {{ ($editTransaction?->action_type ?? old('action_type')) == 'out' ? 'selected' : '' }}>Out</option>
                            </select>
                        </div>
                        <div class="col-md-2 align-self-end mt-2">
                            <button class="btn btn-info" type="submit">{{ $editTransaction ? 'Update' : 'Save' }}</button>
                            @if($editTransaction)
                                <a href="{{ route('admin.transaction-log.index') }}" class="btn btn-secondary">Cancel</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Transaction List</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="transactionTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>PO</th>
                                <th>Style</th>
                                <th>Destination</th>
                                <th>Qty Carton</th>
                                <th>Qty Garment</th>
                                <th>Rack</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                                    <td><span class="badge {{ $transaction->action_type == 'in' ? 'bg-success' : 'bg-danger' }}">{{ strtoupper($transaction->action_type) }}</span></td>
                                    <td>{{ $transaction->po }}</td>
                                    <td>{{ $transaction->style }}</td>
                                    <td>{{ $transaction->destination }}</td>
                                    <td>{{ $transaction->qty_carton }}</td>
                                    <td>{{ $transaction->qty_garment }}</td>
                                    <td>{{ $transaction->rack_code }}</td>
                                    <td>
                                        <a href="{{ route('admin.transaction-log.edit', $transaction->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form method="POST" action="{{ route('admin.transaction-log.destroy', $transaction->id) }}" style="display:inline;" onsubmit="return confirm('Delete this transaction?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No data available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
