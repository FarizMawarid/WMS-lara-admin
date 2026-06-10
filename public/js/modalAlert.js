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
            confirmButtonColor: "#28a745",
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
                <select id=swal-factory class="swal2-select" value="${factory}">
                    <option class="swal2-option">ESGI KLego</option>
                    <option class="swal2-option">ESGI Sambi</option>
                </select>
                <select id=swal-role class="swal2-select" value="${role}">
                    <option class="swal2-option">Admin</option>
                    <option class="swal2-option">User</option>
                </select>
                <input
                    id="swal-nik"
                    class="swal2-input"
                    value="${nik}"
                    style="
                        width:225px;
                        height:45px;
                        border: solid 1px gray;
                        border-radius: 0;
                        ">
                <select id=swal-department class="swal2-select" value="${department}">
                    <option class="swal2-option">Finish Goods 1</option>
                    <option class="swal2-option">Finish Goods 2</option>
                </select>
            `,

            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: '#28a745',
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
            confirmButtonColor: "#28a745",
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
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
        }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Generated!",
                text: "The token has been generated.",
                icon: "success",
                confirmButtonColor: "#28a745",
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
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Deleted!",
                text: "The token has been deleted.",
                icon: "success",
                confirmButtonColor: "#28a745",
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
            confirmButtonColor: "#28a745",
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
            confirmButtonColor: "#28a745",
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
                <select id=swal-factory class="swal2-select" value="${factory}">
                    <option class="swal2-option">ESGI KLego</option>
                    <option class="swal2-option">ESGI Sambi</option>
                </select>
                <select id=swal-department class="swal2-select" value="${department}">
                    <option class="swal2-option">Finish Goods 1</option>
                    <option class="swal2-option">Finish Goods 2</option>
                </select>
                <input
                    id="swal-rack-code"
                    class="swal2-input"
                    value="${rackCode}"
                    style="
                        width:225px;
                        height:45px;
                        border: solid 1px gray;
                        border-radius: 0;
                        ">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Save',
            confirmButtonColor: '#28a745',
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

// ------------- Modal Alert Add Product Type -----------------
$(document).ready(function () {
      // Modal add product type
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
            confirmButtonColor: '#28a745',
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
                confirmButtonColor: '#28a745'
            });
        }
    });
    // Modal import excel start here
    $('#btn-import-product-type').click(async function (e) {

        e.preventDefault();

        let form = $(this).closest('form');

        const { value: file } = await Swal.fire({
            title: 'Import File',
            input: 'file',
            inputAttributes: {
                accept: '.xlsx,.xls,.csv',
                'aria-label': 'Upload import file'
            },
            showCancelButton: true,
            confirmButtonText: 'Import',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
        });

        if (file) {

            const formData = new FormData(form[0]);
            formData.append('file', file);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire(
                        'Success',
                        'File imported successfully',
                        'success'
                    );
                },
                error: function (xhr) {
                    Swal.fire(
                        'Error',
                        'Failed to import file',
                        'error'
                    );
                }
            });
        }
    });
});


// ------------- Modal Alert Transaction Out -----------------
$(document).ready(function () {

    $(document).on('click', '#btn-transaction-out', async function (e) {
        e.preventDefault();

        const { value: formValues } = await Swal.fire({
            title: 'Transaction Out',
            html: `
                <input id="swal-qtyGarment" class="swal2-input" placeholder="Qty Garment">
                <input id="swal-qtyCarton" class="swal2-input" placeholder="Qty Carton">
            `,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Confirm',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            preConfirm: () => {
                return {
                    qtyGarment: document.getElementById('swal-qtyGarment').value,
                    qtyCarton: document.getElementById('swal-qtyCarton').value
                };
            }
        });

        if (formValues) {
            Swal.fire({
                title: 'Updated!',
                text: 'Successfully Out Carton.',
                icon: 'success',
                confirmButtonColor: '#28a745'
            });
        }
    });

});
