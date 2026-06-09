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
        <form action="/admin/user-management" method="POST">
            @csrf

            <input type="text" style="display:none">
            <input type="password" style="display:none">

            <div class="card-body">
                <div class="row">

                    <div class="col-md-2">
                        <label class="form-label">
                            Factory :
                        </label>
                        <select name="factory" class="form-control select2" required>
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
                        <select name="role" class="form-control select2" required>
                            <option selected disabled>
                                Select Role
                            </option>
                            <option>Admin</option>
                            <option>User</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">
                            NIK :
                        </label>
                        <input
                        type="text"
                        name="nik"
                        class="form-control" 
                        placeholder="NIK" 
                        autocomplete="off"
                        required>
                        <div class="invalid-feedback">
                            Please enter a NIK.
                    </div>
                    </div>


                    <div class="col-md-2">
                        <label class="form-label">
                            Password :
                        </label>
                        <input
                        type="password"
                        name="password"
                        class="form-control" 
                        placeholder="Password" 
                        autocomplete="new-password"
                        required>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">
                            Department :
                        </label>
                        <select
                        name="department"
                        class="form-control select2" required>
                            <option selected disabled>
                                Select Department
                            </option>
                            <option>Finish Goods 1</option>
                            <option>Finish Goods 2</option>
                        </select>
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
                        <th>NIK</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>

                        <td>{{ $user->factory }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->department }}</td>

                        <td>
                        <button
                            class="btn btn-primary btn-sm btn-edit-user"
                            type="button"
                            data-id="{{ $user->id }}"
                            data-factory="{{ $user->factory }}"
                            data-role="{{ $user->role }}"
                            data-nik="{{ $user->nik }}"
                            data-department="{{ $user->department }}">
                            Edit
                        </button>

                        <form action="/admin/user-management/{{ $user->id }}"
                            method="POST"
                            style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm btn-delete-user"
                                type="submit">
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
        title: 'success',
        text: '{{ session('success')}}',
        confirmButtonColor: '#24c4dd'
    });
</script>
@endif
@stop
