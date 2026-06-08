// Admin
// ------------- Modal Alert User Management begins here -----------------
$(document).ready(function () {
    // Modal adding user begins here
    $('#btn-add-user').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to add this user?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#24c4dd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Added!",
                text: "The user has been added.",
                icon: "success",
                confirmButtonColor: "#24c4dd",
            });
            });
    });
    // Modal adding user ends here

    // Modal editing user begins here
    $('#btn-edit-user').click(async function (e) {
        e.preventDefault();
        const { value: formValues } = await Swal.fire({
            title: 'Edit User',
            html: `
                <input id="swal-Factory" class="swal2-input" placeholder="Factory">
                <input id="swal-NIK" type="number" class="swal2-input" placeholder="NIK">
                <input id="swal-role" class="swal2-input" placeholder="Role">
                <input id="swal-department" class="swal2-input" placeholder="Department">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: '#24c4dd',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                return {
                    factory: document.getElementById('swal-Factory').value,
                    NIK: document.getElementById('swal-NIK').value,
                    role: document.getElementById('swal-role').value,
                    department: document.getElementById('swal-department').value
                };
            }
        });
        if (formValues) {
            Swal.fire({
                title: 'Updated!',
                text: `User ${formValues.NIK} has been updated.`,
                icon: 'success',
                confirmButtonColor: '#24c4dd'
            });
        }
    });
    // Modal editing user ends here

    // Modal delete user begins here
    $('#btn-delete-user').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this user?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#24c4dd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Deleted!",
                text: "The user has been deleted.",
                icon: "success",
                confirmButtonColor: "#24c4dd",
            });
            });
    });
    // Modal delete user ends here
});
// ------------- Modal Alert User Management ends here -----------------

// ------------- Modal Alert Token Management begins here -----------------
$(document).ready(function () {
    // Modal adding token begins here
    $('#btn-add-token').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to generate this token?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#24c4dd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
        }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Generated!",
                text: "The token has been generated.",
                icon: "success",
                confirmButtonColor: "#24c4dd",
            });
        });
    });
    // Modal adding token ends here
    
    // Modal delete token begins here
    $('#btn-delete-token').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this token?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#24c4dd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Deleted!",
                text: "The token has been deleted.",
                icon: "success",
                confirmButtonColor: "#24c4dd",
            });
            });
    });
    // Modal delete token ends here
});
// ------------- Modal Alert Token Management ends here -----------------

// ------------- Modal Alert Rack Management begins here -----------------
$(document).ready(function () {

    $('#btn-add-rack').click(function (e) {
        
        e.preventDefault();

        let form = $(this).closest('form');

        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to generate this rack?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#24c4dd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"

        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }
    });
});
    // Modal adding rack ends here

    // Modal delete rack begins here
    $('.btn-delete-rack').click(function (e) {
        e.preventDefault();

        let form = $(this).closest('form');
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this rack?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#24c4dd",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"

        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }
            });
        
    });
    // Modal delete rack ends here

    // Modal editing rack begins here
    $('#btn-edit-rack').click(async function (e) {
        e.preventDefault();
        const { value: formValues } = await Swal.fire({
            title: 'Edit Rack',
            html: `
                <input id="swal-Factory" class="swal2-input" placeholder="Factory">
                <input id="swal-Department" class="swal2-input" placeholder="Department">
                <input id="swal-Rack-code" class="swal2-input" placeholder="Rack Code">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: '#24c4dd',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                return {
                    factory: document.getElementById('swal-Factory').value,
                    department: document.getElementById('swal-Department').value,
                    rackCode: document.getElementById('swal-Rack-code').value
                };
            }
        });
        if (formValues) {
            Swal.fire({
                title: 'Updated!',
                text: `Rack ${formValues.rackCode} has been updated.`,
                icon: 'success',
                confirmButtonColor: '#24c4dd'
            });
        }
    });
    // Modal editing rack ends here
});