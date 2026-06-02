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
            confirmButtonColor: "#17A2B8",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Added!",
                text: "The user has been added.",
                icon: "success",
                confirmButtonColor: "#17A2B8",
            });
            });
    });
    // Modal adding user ends here

    // Modal editing user begins here
    // $('#btn-edit-user').click(function (e) {
    //     e.preventDefault();
    //         const { value: formValues } = await Swal.fire({
    //         title: "Multiple inputs",
    //         html: `
    //             <input id="swal-input1" class="swal2-input">
    //             <input id="swal-input2" class="swal2-input">
    //         `,
    //         focusConfirm: false,
    //         preConfirm: () => {
    //             return [document.getElementById("swal-input1").value, document.getElementById("swal-input2").value];
    //         }
    //         });
    //         if (formValues) Swal.fire(JSON.stringify(formValues));
    //     });
    // Modal editing user ends here

    // Modal delete user begins here
    $('#btn-delete-user').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this user?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#17A2B8",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Deleted!",
                text: "The user has been deleted.",
                icon: "success",
                confirmButtonColor: "#17A2B8",
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
            confirmButtonColor: "#17A2B8",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
        }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Generated!",
                text: "The token has been generated.",
                icon: "success",
                confirmButtonColor: "#17A2B8",
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
            confirmButtonColor: "#17A2B8",
            cancelButtonColor: "#d33",
            confirmButtonText: "Confirm"
            }).then((result) => {
            if (result.isConfirmed) Swal.fire({
                title: "Deleted!",
                text: "The token has been deleted.",
                icon: "success",
                confirmButtonColor: "#17A2B8",
            });
            });
    });
    // Modal delete token ends here
});
// ------------- Modal Alert Token Management ends here -----------------