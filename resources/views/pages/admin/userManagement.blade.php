@extends('adminlte::page')

@section('title', 'Warehouse Management System')

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
                    <i class="fas fa-minus"></i>
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
                            Username :
                        </label>
                        <input type="text" class="form-control" placeholder="Username" required>
                        <div class="invalid-feedback">
                            Please enter a username.
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
                <button class="btn btn-info" type="submit">
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
                            <button class="btn btn-primary btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop


@section('css')
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

    $('#userTable').DataTable({
        responsive: true,
        autoWidth: false
    });

});
</script>

@stop