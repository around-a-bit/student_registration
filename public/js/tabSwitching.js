function openTab(event, tabName) {
    var currentTab = document.querySelector(
        ".tabcontent:not([style='display: none;'])"
    ).id;
    var inputs = document.querySelectorAll(
        `#${currentTab} input[required], #${currentTab} select[required]`
    );

    let tabList = [
        "basic-details",
        "course-selection",
        "new-course-selection",
        "address",
        "upload-document",
    ];
    let currentIndex = tabList.indexOf(currentTab);
    let targetIndex = tabList.indexOf(tabName);

    if (targetIndex > currentIndex) {
        // Moving forward
        for (let i = 0; i < inputs.length; i++) {
            if (!inputs[i].value.trim()) {
                Swal.fire({
                    icon: "warning",
                    title: "Incomplete Form",
                    text: "Please fill in all required fields for proceeding.",
                    confirmButtonColor: "#007bff",
                });
                return;
            }
        }
    }

    document
        .querySelectorAll(".tabcontent")
        .forEach((tab) => (tab.style.display = "none"));
    document
        .querySelectorAll(".nav-link")
        .forEach((link) => link.classList.remove("active"));

    document.getElementById(tabName).style.display = "block";
    document.querySelectorAll(".nav-tabs .nav-link").forEach(function (link) {
        if (link.getAttribute("onclick").includes(tabName)) {
            link.classList.add("active");
        }
    });

    localStorage.setItem("activeTab", tabName);
}

function addDegreeRow() {
    var container = document.getElementById("degree-container");
    var newRow = document.createElement("div");
    newRow.classList.add("row", "mb-3", "degree-row");

    newRow.innerHTML = `
            <div class="col">
                <label class="form-label small text-muted">University<span class="text-danger">*</span></label>
                <select name="school_id[]" class="form-control school-select" required></select>
            </div>
            <div class="col">
                <label class="form-label small text-muted">Degree<span class="text-danger">*</span></label>
                <select name="degree_id[]" class="form-control degree-select" required></select>
            </div>
            <div class="col">
                <label class="form-label small text-muted">Specialization<span class="text-danger">*</span></label>
                <select name="specialization_id[]" class="form-control specialization-select" required></select>
            </div>
            <div class="col">
                <label class="form-label small text-muted">Student UID<span class="text-danger">*</span></label>
                <input type="text" name="uid[]" class="form-control" minlength="16" maxlength="16" required>
            </div>
            <div class="col-auto d-flex align-items-end">
                <button type="button" class="btn btn-danger" onclick="removeDegreeRow(this)">Remove</button>
            </div>
        `;

    container.appendChild(newRow);

    // Load options for the newly created select boxes
    loadSchools(newRow.querySelector(".school-select"));
    loadDegrees(newRow.querySelector(".degree-select"));
    loadSpecializations(newRow.querySelector(".specialization-select"));
}

function loadSchools(selectElement) {
    return $.ajax({
        url: "/schools",
        type: "GET",
        success: function (response) {
            $(selectElement).html(response);
        },
        error: function (xhr, status, error) {
            console.error("Error loading schools:", error);
        },
    });
}

function loadDegrees(selectElement) {
    return $.ajax({
        url: "/degrees",
        type: "GET",
        success: function (response) {
            $(selectElement).html(response);
        },
        error: function (xhr, status, error) {
            console.error("Error loading degrees:", error);
        },
    });
}

function loadSpecializations(selectElement) {
    return $.ajax({
        url: "/specializations",
        type: "GET",
        success: function (response) {
            $(selectElement).html(response);
        },
        error: function (xhr, status, error) {
            console.error("Error loading specializations:", error);
        },
    });
}

function removeDegreeRow(button) {
    var row = button.closest(".degree-row");
    if (document.querySelectorAll(".degree-row").length > 1) {
        row.remove();
    }
}
