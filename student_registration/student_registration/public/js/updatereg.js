$(document).ready(function () {


    async function loadBaseData(student) {
        try {
            await Promise.all([
                loadGenders(student),
                loadDegrees(student),
                loadSpecializations(student),
                loadSchools(student),
                loadCountries(student)
            ]);
        } catch (error) {
            console.error("Initial load failed:", error);
        }
    }

    function loadGenders(student) {
        return $.ajax({
            url: '/genders',
            type: 'GET',
            success: function (response) {
                $("#gender_id").html(response).val(student.gender_id);
            },
            error: function (xhr, status, error) {
                console.error("Error loading genders:", error);
            }
        });
    }

    function loadDegrees(student) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        return $.ajax({
            url: '/degrees',
            type: 'GET',
            success: function (response) {
                $("#degree_id").html(response).val(student.degree_id);
            },
            error: function (xhr, status, error) {
                console.error("Error loading degrees:", error);
            }
        });
    }

    function loadSpecializations(student) {
        return $.ajax({
            url: '/specializations',
            type: 'GET',
            success: function (response) {
                $("#specialization_id").html(response).val(student.specialization_id);
            },
            error: function (xhr, status, error) {
                console.error("Error loading specializations:", error);
            }
        });
    }

    function loadSchools(student) {
        return $.ajax({
            url: '/schools',
            type: 'GET',
            success: function (response) {
                $("#school_id").html(response).val(student.school_id);
            },
            error: function (xhr, status, error) {
                console.error("Error loading schools:", error);
            }
        });
    }

    function loadCountries(student) {
        return $.ajax({
            url: '/countries',
            type: 'GET',
            success: function (response) {
                $("#country_id").html(response).val(student.country_id);
                loadStates(student, student.country_id);
            },
            error: function (xhr, status, error) {
                console.error("Error loading countries:", error);
            }
        });
    }

    function loadStates(student, countryId) {
        return $.ajax({
            url: `/states/${countryId}`,
            type: 'GET',
            success: function (response) {
                $("#state_id").html(response).val(student.state_id);
                loadDistricts(student, student.state_id);
            },
            error: function (xhr, status, error) {
                console.error("Error loading states:", error);
            }
        });
    }

    function loadDistricts(student, stateId) {
        return $.ajax({
            url: `/districts/${stateId}`,
            type: 'GET',
            success: function (response) {
                $("#district_id").html(response).val(student.district_id);
            },
            error: function (xhr, status, error) {
                console.error("Error loading districts:", error);
            }
        });
    }

    // Event handlers
    $('#country_id').change(function () {
        loadStates(student, $(this).val());
    });

    $('#state_id').change(function () {
        loadDistricts(student, $(this).val());
    });

    // Initial data load
    loadBaseData(student);
});