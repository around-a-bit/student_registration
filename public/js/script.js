// <!-- ---------------------------------------------------------------------------------------------------------- -->

function loadNewDropdowns(parentElement) {
    $.ajax({
        url: "/degrees",
        type: "GET",
        success: function (response) {
            $(parentElement).find("#degree_id").html(response);
        },
    });

    $.ajax({
        url: "/schools",
        type: "GET",
        success: function (response) {
            $(parentElement).find("#school_id").html(response);
        },
    });
    $.ajax({
        url: "/specializations",
        type: "GET",
        success: function (response) {
            $(parentElement).find("#specialization_id").html(response);
        },
    });
}

$(document).ready(function () {
    // Load countries, genders, degrees, etc. on page load
    function loadDropdowns() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // <!-- ---------------------------------------------------------------------------------------------------------- -->

        // <!-- ---------------------------------------------------------------------------------------------------------- -->
        // Load Genders
        $.ajax({
            url: "/genders",
            type: "GET",
            success: function (response) {
                $("#gender_id").html(response);
            },
            error: function (xhr, status, error) {
                console.error(
                    "Error loading countries: " +
                        error +
                        " " +
                        xhr +
                        " " +
                        status
                );
            },
        });
        // <!-- ---------------------------------------------------------------------------------------------------------- -->
        // Load Degrees
        $.ajax({
            url: "/degrees",
            type: "GET",
            success: function (response) {
                $("#degree_id").html(response);
                $("#degree_id").val(student.degree);
            },
            error: function (xhr, status, error) {
                console.error(
                    "Error loading countries: " +
                        error +
                        " " +
                        xhr +
                        " " +
                        status
                );
            },
        });
        // <!-- ---------------------------------------------------------------------------------------------------------- -->
        // Load Specializations
        $.ajax({
            url: "/specializations",
            type: "GET",
            success: function (response) {
                $("#specialization_id").html(response);
                $("#specialization_id").val(student.specialization);
            },
            error: function (xhr, status, error) {
                console.error(
                    "Error loading countries: " +
                        error +
                        " " +
                        xhr +
                        " " +
                        status
                );
            },
        });
        // <!-- ---------------------------------------------------------------------------------------------------------- -->
        // Load Academic Year
        $.ajax({
            url: "/academicYear",
            type: "GET",
            success: function (response) {
                $("#academic_id").html(response);
                $("#academic_id").val(student.specialization);
            },
            error: function (xhr, status, error) {
                console.error(
                    "Error loading countries: " +
                        error +
                        " " +
                        xhr +
                        " " +
                        status
                );
            },
        });
        // <!-- ---------------------------------------------------------------------------------------------------------- -->
        // Load Semesters
        $.ajax({
            url: "/semesters",
            type: "GET",
            success: function (response) {
                $("#semester_id").html(response);
                $("#semester_id").val(student.specialization);
            },
            error: function (xhr, status, error) {
                console.error(
                    "Error loading countries: " +
                        error +
                        " " +
                        xhr +
                        " " +
                        status
                );
            },
        });
        // <!-- ---------------------------------------------------------------------------------------------------------- -->
        // Load Schools
        $.ajax({
            url: "/schools",
            placeholder: "Select University",
            type: "GET",
            success: function (response) {
                $("#school_id").html(response);
                $("#school_id").val(student.school);
            },
            error: function (xhr, status, error) {
                console.error(
                    "Error loading countries: " +
                        error +
                        " " +
                        xhr +
                        " " +
                        status
                );
            },
        });
        // <!-- ---------------------------------------------------------------------------------------------------------- -->
        // Load Countries

        $.ajax({
            url: "/countries",
            type: "GET",
            success: function (response) {
                $("#country_id").html(response);
                if (selectedCountry) {
                    $("#country_id").val(selectedCountry).trigger("change");
                }
            },
        });
    }
    // <!-- ---------------------------------------------------------------------------------------------------------- -->
    loadDropdowns();

    // Load states when a country is selected
    $("#country_id").change(function () {
        var country_id = $(this).val();
        if (country_id !== "") {
            $.ajax({
                url: "/states/" + country_id,
                type: "GET",
                success: function (response) {
                    $("#state_id").html(response).prop("disabled", false);
                    $("#state_id").val("");
                    $("#district_id")
                        .html('<option value="">Select District</option>')
                        .prop("disabled", true);

                    if (selectedState) {
                        $("#state_id").val(selectedState).trigger("change"); // Trigger change to load districts
                    }
                },
            });
        } else {
            $("#state_id")
                .html('<option value="">Select State</option>')
                .prop("disabled", true);
            $("#district_id")
                .html('<option value="">Select District</option>')
                .prop("disabled", true);
        }
    });

    // Load districts when a state is selected
    $("#state_id").change(function () {
        var state_id = $(this).val();
        if (state_id !== "") {
            $.ajax({
                url: "/districts/" + state_id,
                type: "GET",
                success: function (response) {
                    $("#district_id").html(response).prop("disabled", false);
                    $("#district_id").val("");

                    if (selectedDistrict) {
                        $("#district_id").val(selectedDistrict);
                    }
                },
            });
        } else {
            $("#district_id")
                .html('<option value="">Select District</option>')
                .prop("disabled", true);
        }
    });
});
// <!-- ---------------------------------------------------------------------------------------------------------- -->
document.addEventListener("DOMContentLoaded", function () {
    const url = new URL(window.location.href);
    const params = url.searchParams;

    // Remove all error-related parameters
    [...params.keys()].forEach((key) => {
        if (key.startsWith("error")) {
            params.delete(key);
        }
    });

    // Replace the URL without reloading the page
    window.history.replaceState(
        {},
        document.title,
        url.pathname + (params.toString() ? "?" + params.toString() : "")
    );
});
// <!-- ---------------------------------------------------------------------------------------------------------- -->

function addMore() {
    let index = document.querySelectorAll(".edu-group").length;
    let div = document.createElement("div");
    div.classList.add("edu-group", "mb-3");
    div.innerHTML = `
    <hr>
        <div class="mb-3">
            <label>Student UID<span style="color: red;">*</span></label>
            <input type="text" name="uid[]" value="{{ old('uid.${index}') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Degree<span style="color: red;">*</span></label>
            <select id="degree_id" name="degree_id[]" class="form-control" required></select>
        </div>
        <div class="mb-3">
            <label>Specialization<span style="color: red;">*</span></label>
            <select id="specialization_id" name="specialization_id[]" class="form-control" required></select>
        </div>
        <div class="mb-3">
            <label>University<span style="color: red;">*</span></label>
            <select id="school_id" name="school_id[]" class="form-control" required></select>
        </div>
    `;
    document.getElementById("educationFields").appendChild(div);
}

// <!-- ---------------------------------------------------------------------------------------------------------- -->
