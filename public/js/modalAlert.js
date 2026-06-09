// Admin
// ------------- Modal Alert User Management begins here -----------------
$(document).ready(function () {
    // Modal adding user begins here
    $('#btn-add-user').click(function (e) {

        e.preventDefault();

        let form = $(this).closest('form');

        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to add this user?",
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
    // Modal adding user ends here

    // Modal editing user begins here
    $('.btn-edit-user').click(async function (e) {

        e.preventDefault();

        let id = $(this).data('id');
        let factory = $(this).data('factory');
        let role = $(this).data('role');
        let nik = $(this).data('nik');
        let department = $(this).data('department');

        const { value: formValues } = await Swal.fire({

            title: 'Edit User',

            html: `
                <input id="swal-factory" class="swal2-input" value="${factory}">
                <input id="swal-role" class="swal2-input" value="${role}">
                <input id="swal-nik" class="swal2-input" value="${nik}">
                <input id="swal-department" class="swal2-input" value="${department}">
            `,

            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: '#24c4dd',
            cancelButtonColor: '#d33',

            preConfirm: () => {

                return {

                    factory: document.getElementById('swal-factory').value,
                    nik: document.getElementById('swal-nik').value,
                    role: document.getElementById('swal-role').value,
                    department: document.getElementById('swal-department').value
                };
            }
        });
        if (formValues) {

            console.log(formValues);
            
            let form = document.createElement('form');

            form.method = 'POST';
            form.action = '/admin/user-management/' + id;

            form.innerHTML = `
                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                <input type="hidden" name="_method" value="PUT">

                <input type="hidden" name="factory" value="${formValues.factory}">
                <input type="hidden" name="role" value="${formValues.role}">
                <input type="hidden" name="nik" value="${formValues.nik}">
                <input type="hidden" name="department" value="${formValues.department}">
        `;

        document.body.appendChild(form);

        form.submit();
    }

});
    // Modal editing user ends here

    // Modal delete user begins here
    $('.btn-delete-user').click(function (e) {

        e.preventDefault();

        let form = $(this).closest('form');

        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this user?",
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
    $('.btn-edit-rack').click(async function (e) {
        e.preventDefault();

        let id = $(this).data('id');
        let factory = $(this).data('factory');
        let department = $(this).data('department');
        let rackCode = $(this).attr('data-rack-code');

        const { value: formValues } = await Swal.fire({
            title: 'Edit Rack',
            html: `
                <input id="swal-factory" class="swal2-input" value="${factory}">
                <input id="swal-department" class="swal2-input" value="${department}">
                <input id="swal-rack-code" class="swal2-input" value="${rackCode}">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: '#24c4dd',
            cancelButtonColor: '#d33',

            preConfirm: () => {
                return {
                    factory: document.getElementById('swal-factory').value,
                    department: document.getElementById('swal-department').value,
                    rackCode: document.getElementById('swal-rack-code').value
                };
            }
        });
        if (formValues) {
            
            let form = document.createElement('form');

            form.method = 'POST';
            form.action ='/admin/rack-management/' + id;

            form.innerHTML = `
                <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                <input type="hidden" name="_method" value="PUT">

                <input type="hidden" name="factory" value="${formValues.factory}">
                <input type="hidden" name="department" value="${formValues.department}">
                <input type="hidden" name="rack_code" value="${formValues.rackCode}">
            `;

            document.body.appendChild(form);
            form.submit();
        }
    });
    // Modal editing rack ends here
});

// ------------- Modal Alert Add Produc Type -----------------
    $('#btn-add-product-type').click(async function (e) {
        e.preventDefault();
        const { value: formValues } = await Swal.fire({
            title: 'Add Product Type',
            html: `
                <input id="swal-PO" class="swal2-input" placeholder="PO">
                <input id="swal-KP" class="swal2-input" placeholder="KP">
                <input id="swal-Season" class="swal2-input" placeholder="Season">
                <input id="swal-Style" class="swal2-input" placeholder="Style">
            `,

            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: '#24c4dd',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                return {
                    PO: document.getElementById('swal-PO').value,
                    KP: document.getElementById('swal-KP').value,
                    Season: document.getElementById('swal-Season').value,
                    Style: document.getElementById('swal-Style').value
                };
            }
        });
        if (formValues) {
            Swal.fire({
                title: 'Updated!',
                text: `Product Type has been updated.`,
                icon: 'success',
                confirmButtonColor: '#24c4dd'
            });
        }
    });
    // Modal editing user ends here
