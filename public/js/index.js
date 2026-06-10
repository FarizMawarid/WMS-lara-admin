//Handle request need validation

$(document).ready(function () {

    $('.select2').select2({
        width: '100%'
    });

    // Bootstrap validation
    $('.needs-validation').on('submit', function (event) {

        // Validasi Select2
        $('.select2[required]').each(function () {
            if ($(this).val() == null || $(this).val() === '') {
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        $(this).addClass('was-validated');
    });

    // Hapus error saat select2 dipilih
    $('.select2').on('change', function () {
        $(this).removeClass('is-invalid');
    });

});
