// call this plugins every page that requires it. 
$(document).ready(function () {

    //-------select2 begin here-------//
    $('.select2').select2({
        width: '100%'
    });
    //-------select2 end here-------//

    //-------dataTable begin here-------//
    $('#userTable').DataTable({
        responsive: true,
        autoWidth: false
    });
    //-------dataTable end here-------//

    //-------datepicker begin here-------//
    $('#filterType').on('change', function () {
        let value = $(this).val();
        if (value === 'date') {
            $('.filter-po').addClass('d-none');
            $('.filter-date').removeClass('d-none');
        } else {
            $('.filter-po').removeClass('d-none');
            $('.filter-date').addClass('d-none');
        }
    });
    //-------datepicker end here-------//
});