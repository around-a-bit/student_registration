const initialUrl = "http://127.0.0.1:8000/search";

function urlFilter(page = 1) {
    let queryString = '';
    console.log("http://127.0.0.1:8000/search");
    const countryId = $('#country_id').val();
    const stateId = $('#state_id').val();
    const districtId = $('#district_id').val();
    const schoolId = $('#school_id').val();
    const dateFrom = $('#date_from').val();
    const dateTo = $('#date_to').val();
    const genderId = $('#gender_id').val();
    const search_term = $('#search_term').val();
    console.log(search_term);
    const fname = $('#fname').val();
    const perPage = $('#perPage').val() || 5;

    const offset = (page - 1) * perPage;

    if(!search_term){
        if (fname) queryString += 'fname=' + fname + '&';
        if (countryId) queryString += 'country_id=' + countryId + '&';
        if (stateId) queryString += 'state_id=' + stateId + '&';
        if (districtId) queryString += 'district_id=' + districtId + '&';
        if (schoolId) queryString += 'school_id=' + schoolId + '&';
        if (dateFrom) queryString += 'date_from=' + dateFrom + '&';
        if (dateTo) queryString += 'date_to=' + dateTo + '&';
        if (genderId) queryString += 'gender_id=' + genderId + '&';
    }

    if (search_term) queryString += 'search_term=' + search_term + '&';


    queryString += 'perPage=' + perPage + '&';
    queryString += 'offset=' + offset + '&';
    queryString += 'page=' + page;

    // alert(newUrl);
    const newUrl = initialUrl + '?' + queryString;
    window.location.href = newUrl;
}

$(document).ready(function () {



    $('#button').on('click', function () {
        urlFilter();
    });

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        const page = new URL($(this).attr('href')).searchParams.get('page');
        urlFilter(page);
    });
});