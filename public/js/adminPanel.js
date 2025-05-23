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







