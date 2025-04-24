document.addEventListener("DOMContentLoaded", function () {
    const url = new URL(window.location.href);
    if (url.searchParams.has("delete_message")) {
        setTimeout(() => {
            url.searchParams.delete("delete_message");
            window.history.replaceState(
                {},
                document.title,
                url.pathname + url.search
            );
        }, 1);
    }
    if (url.searchParams.has("error")) {
        setTimeout(() => {
            url.searchParams.delete("error");
            window.history.replaceState(
                {},
                document.title,
                url.pathname + url.search
            );
        }, 1);
    }
    if (url.searchParams.has("success")) {
        setTimeout(() => {
            url.searchParams.delete("success");
            window.history.replaceState(
                {},
                document.title,
                url.pathname + url.search
            );
        }, 1);
    }
});

$("#fname").select2({
    placeholder: "Search by First Name",
    allowClear: true,
    ajax: {
        url: fnameRoute,
        type: "POST",
        dataType: "json",
        delay: 250,
        data: (params) => ({
            query: params.term,
            _token: csrfToken,
        }),
        processResults: (data) => ({
            results: data.map((item) => ({
                id: item.fname,
                text: item.fname,
            })),
        }),
    },
});

if (oldFname) {
    let newOption = new Option(oldFname, oldFname, true, true);
    $("#fname").append(newOption).trigger("change");
}





function validateForm() {

    var url = "http://127.0.0.1:8000/search";
    var queryString = ''; 

    if ($('#fname').val()) {
        queryString += 'fname='+$('#fname').val()+'&';
    }
    if  ($('#uid').val()) {
        queryString += 'uid='+$('#uid').val()+'&';
    }
    if  ($('#gender_id').val()) {
        queryString += 'gender_id='+$('#gender_id').val()+'&';
    }
    if  ($('#school_id').val()) {
        queryString += 'school_id='+$('#school_id').val()+'&';
    }
    if  ($('#country_id').val()) {
        queryString += 'country_id='+$('#country_id').val()+'&';
    }
    if  ($('#state_id').val()) {
        queryString += 'state_id='+$('#state_id').val()+'&';
    }
    if  ($('#district_id').val()) {
        queryString += 'district_id='+$('#district_id').val()+'&';
    }
    if  ($('#date_from').val()) {
        queryString += 'date_from='+$('#date_from').val()+'&';
    }
    if  ($('#date_to').val()) {
        queryString += 'date_to='+$('#date_to').val+'&';
    }

    if(queryString.length >0){
        queryString = queryString.slice(0,-1);
    }
        url += "?" + queryString;
        
    window.location.href = url;
}
