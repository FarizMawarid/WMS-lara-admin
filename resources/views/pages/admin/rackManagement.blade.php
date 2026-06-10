@extends('adminlte::page')
@section('meta_tags')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('title', 'WMS')

@section('content_header')
    <h1>Rack Management | Admin</h1>
@stop

@section('content')
<div class="col-lg-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                Generate Rack
            </h3>
            <div class="card-tools">
                <button type="button"
                        class="btn btn-tool"
                        data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <form action="/admin/rack-management"
            method="POST">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label">
                            Factory :
                        </label>
                        <select name="factory" class="form-control">
                            <option selected disabled>
                                Select Factory
                            </option>
                            <option>ESGI Klego</option>
                            <option>ESGI Sambi</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select Factory.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Department :
                        </label>
                        <select name="department" class="form-control">
                            <option selected disabled>
                                Select Department
                            </option>
                            <option>Finish Goods 1</option>
                            <option>Finish Goods 2</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select Department.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Rack Code :
                        </label>
                        <input
                            type="text"
                            name="rack_code"
                            class="form-control">
                        <div class="invalid-feedback">
                            Please enter an Rack Code.
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" type="submit" id="btn-add-rack">
                    Generate Rack
                </button>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                Token Active
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Factory</th>
                            <th>Department</th>
                            <th>Rack Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($racks as $rack)
                    <tr>
                        <td>{{ $rack->factory }}</td>
                        <td>{{ $rack->department }}</td>
                        <td>{{ $rack->rack_code }}</td>
                        <td>

                            <form action="/admin/rack-management/{{ $rack->id }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm btn-edit-rack"
                                    data-id="{{ $rack->id}}"
                                    data-factory="{{ $rack->factory }}"
                                    data-department="{{ $rack->department }}"
                                    data-rack-code="{{ $rack->rack_code}}">
                                    Edit
                                </button>

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm btn-delete-rack">
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

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'success',
        text: '{{ session('success')}}',
        confirmButtonColor: '#24c4dd'
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        confirmButtonColor: '#24c4dd'
});
</script>
@endif
@stop
