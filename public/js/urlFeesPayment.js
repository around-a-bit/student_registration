const initialUrl = "http://127.0.0.1:8000/adminPaymentOpenPanel";

function urlFilterFees(page = 1) {
    let queryString = '';

    const semester_id = $('#semester_id').val();
    const specialization_id = $('#specialization_id').val();
    const academic_id = $('#academic_id').val();
    const search_term = $('#search_term').val();
    const perPage = $('#perPage').val() || 5;

    const offset = (page - 1) * perPage;


    if(!search_term){
        if (semester_id) queryString += 'semester_id=' + semester_id + '&';
        if (specialization_id) queryString += 'specialization_id=' + specialization_id + '&';
        if (academic_id) queryString += 'academic_id=' + academic_id + '&';
    }

    if (search_term) queryString += 'search_term=' + search_term + '&';

    queryString += 'perPage=' + perPage + '&';
    queryString += 'offset=' + offset + '&';
    queryString += 'page=' + page;


    const newUrl = initialUrl + '?' + queryString;
    // alert(newUrl);
    window.location.href = newUrl;
}

$(document).ready(function () {

    $('#validateFormFees').on('click', function () {
        urlFilterFees();
    });

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        const page = new URL($(this).attr('href')).searchParams.get('page');
        urlFilterFees(page);
    });
});