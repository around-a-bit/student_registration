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
                $("#gender_id").html(response);
                if (student.gender_id) {
                    $("#gender_id").val(student.gender_id).change();
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading genders:", error);
            }
        });
    }
    function loadDegrees(student) {
        return $.ajax({
            url: '/degrees',
            type: 'GET',
            success: function (response) {
                $("select[name='degree_id[]']").each(function (index) {
                    $(this).html(response);
                    const selectedValue = $(this).data('selected') || '';
                    const finalValue = selectedValue || (student.degrees && student.degrees[index] ? student.degrees[index] : '');
                    $(this).val(finalValue).change();
                    console.log("Degree Dropdown", index, "selected value:", finalValue);
                });
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
                $("select[name='specialization_id[]']").each(function (index) {
                    $(this).html(response);
                    const selectedValue = $(this).data('selected') || '';
                    const finalValue = selectedValue || (student.specializations && student.specializations[index] ? student.specializations[index] : '');
                    $(this).val(finalValue).change();
                    console.log("Specialization Dropdown", index, "selected value:", finalValue);
                });
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
                $("select[name='school_id[]']").each(function (index) {
                    $(this).html(response); 
    
                    const selectedValue = $(this).data('selected') || '';
    
                    const finalValue = selectedValue || (student.schools && student.schools[index] ? student.schools[index] : '');
                    $(this).val(finalValue).change();
    
                    console.log("School Dropdown", index, "selected value:", finalValue);
                });
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
                $("#country_id").html(response);
                if (student.country_id) {
                    $("#country_id").val(student.country_id).change();
                    loadStates(student, student.country_id);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading countries:", error);
            }
        });
    }

    function loadStates(student, countryId) {
        return $.ajax({
            url: '/states/' + countryId,
            type: 'GET',
            success: function (response) {
                $("#state_id").html(response);
                if (student.state_id) {
                    $("#state_id").val(student.state_id).change();
                    loadDistricts(student, student.state_id);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading states:", error);
            }
        });
    }

    function loadDistricts(student, stateId) {
        return $.ajax({
            url: '/districts/' + stateId,
            type: 'GET',
            success: function (response) {
                $("#district_id").html(response);
                if (student.district_id) {
                    $("#district_id").val(student.district_id).change();
                }
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