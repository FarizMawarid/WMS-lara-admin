// Admin
// ------------- Modal Alert User Management -----------------
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
    // Modal adding user ends here
    });

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
    // Modal delete user ends here
    });

});