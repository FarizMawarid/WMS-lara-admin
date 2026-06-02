@extends('adminlte::page')

@section('title', 'Warehouse Management System')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>User Management | Admin</h1>
@stop

@section('content')
<div class="col-lg-12">
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                User Information
            </h3>
            <div class="card-tools">
                <button type="button"
                        class="btn btn-tool"
                        data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <form class="needs-validation" novalidate>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-label">
                            Factory :
                        </label>
                        <select class="form-control select2" required>
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
                            Role :
                        </label>
                        <select class="form-control select2" required>
                            <option selected disabled>
                                Select Role
                            </option>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select Role.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            NIK :
                        </label>
                        <input type="text" class="form-control" placeholder="Username" required>
                        <div class="invalid-feedback">
                            Please enter a NIK.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Password :
                        </label>
                        <input type="password" class="form-control" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Please enter a password.
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            Department :
                        </label>
                        <select class="form-control select2" required>
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
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" type="button" id="btn-add-user">
                    Add User
                </button>
            </div>
        </form>
    </div>
</div>
<div class="col-lg-12">
    <div class="card card-info card-outline mb-4">
        <div class="card-header">
            <div class="card-title">
                User Information
            </div>
        </div>
        <div class="card-body">
            <table id="userTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Factory</th>
                        <th>Role</th>
                        <th>Username</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ESGI Klego</td>
                        <td>Admin</td>
                        <td>admin_klego</td>
                        <td>Finish Goods 1</td>
                        <td>
                            <button class="btn btn-primary btn-sm" type="button" id="btn-edit-user">Edit</button>
                            <button class="btn btn-danger btn-sm" type="button" id="btn-delete-user">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
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
@stop