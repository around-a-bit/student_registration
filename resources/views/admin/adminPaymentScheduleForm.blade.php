<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
@include('layouts.adminHeader')
<style>
    main {
        margin-bottom: 15rem;
    }

    .p-4 {
        padding: 3.5rem !important;
    }

    body {
        background-image: url("/images/backgroundreg.jpg");
    }

    .glassy-card {
        max-width: 1200px;
        border-radius: 0;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.77);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glassy-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }

    .card-title {
        font-size: 1.5rem;
        color: #ffffff;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        background-image: linear-gradient(to right, #784c00, rgba(0, 0, 0, 0.79));
        box-shadow: 0 0 8px rgba(61, 61, 61, 0.3);
    }



    .form-control:focus,
    .form-select:focus {
        border-color: #784c00;
        box-shadow: 0 0 8px rgba(120, 76, 0, 0.3);
        background: rgba(255, 255, 255, 0.9);
    }

    .btn-success:hover,
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        filter: brightness(1.1);
    }

    hr {
        border: 0;
        height: 1px;
        background: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0));
        margin: 1.5rem 0;
    }

    @media (max-width: 768px) {
        .glassy-card {
            margin: 1rem;
        }
    }
</style>

</head>

<body>
    <main class="container-fluid p-4 d-flex align-items-center justify-content-center">
        <div class="card glassy-card w-100">
            <form action="{{ route('admin.payment.schedule.finalsubmit') }}" method="POST" class="form-control">
                @method('POST')
                @csrf
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4 p-3">Payment Schedule From</h5>

                    <div id="degree-container" style="align-items: center;">
                        <div class="row">
                            <div class="col">
                                <label for="start_date" class="form-label small text-muted">Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="end_date" class="form-label small text-muted">End Date <span class="text-danger">*</span></label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                            </div>
                            <div class="col">
                                <label for="extended_date" class="form-label small text-muted">Extended Date</label>
                                <input type="date" name="extended_date" id="extended_date" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="late_fine" class="form-label small text-muted">Late Fine</label>
                                <input type="number" name="late_fine" id="late_fine" placeholder="Enter the amount" class="form-control">
                            </div>

                            <div class="col">
                                <label for="total_amount" class="form-label small text-muted">Total Amount</label>
                                <input id="total_amount" value="{{$total_amount}}" class="form-control" readonly>
                                <input type="hidden" name="fees_structure_id" value="{{$fees_structure_id}}">
                            </div>
                            <div class="col">
                                <label for="description" class="form-label small text-muted">Descryption</label>
                                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Type here...(Optional)" oninput="limitWords(this, 100)"></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class=" col text-center">
                                <button type="submit" class="btn btn-primary w-auto">Store <i class="bi bi-database-fill-down"></i></button>
                            </div>
                            <div class="col text-center">
                                <a href="{{ route('admin.payment.schedule') }}" class="btn btn-warning w-auto">Back <i class="bi bi-arrow-clockwise"></i></a>
                            </div>
                        </div>




                    </div>

                </div>
            </form>
        </div>
    </main>



    <!-- <script>
        function load() {
            const academic = document.getElementById("academic_id_hidden").value.trim();
            const specialization = document.getElementById("specialization_id_hidden").value.trim();
            const semester = document.getElementById("semester_id_hidden").value.trim();

            let errorMessage = null;

            if (!academic || !specialization || !semester) {
                errorMessage = "Please select all the fields.";
            }

            if (errorMessage) {
                const url = new URL(window.location.href);
                url.searchParams.delete("error");
                window.history.replaceState({}, document.title, url.pathname + url.search);

                Swal.fire({
                    title: "Oops!",
                    text: errorMessage,
                    icon: "error",
                    confirmButtonText: "OK"
                });
                errorMessage = null;
            } else {
                $.ajax({
                    url: `/forSchedule?academic_id=${encodeURIComponent(academic)}&specialization_id=${encodeURIComponent(specialization)}&semester_id=${encodeURIComponent(semester)}`,
                    type: 'GET',
                    success: function(check) {
                        if (check.total_amount) {
                            console.log(check);
                            document.getElementById("fee-details-container").classList.remove("d-none");
                            document.getElementById("total_amount").value = check.total_amount ?? '';
                            document.getElementById("start_date").value = check.start_date ?? '';
                            document.getElementById("end_date").value = check.end_date ?? '';
                            document.getElementById("extended_date").value = check.extended_date ?? '';
                            document.getElementById("late_fine").value = check.late_fine ?? '';
                            document.getElementById("description").value = check.description ?? '';


                            document.getElementById('academic_id').value = document.getElementById('academic_id_hidden').value;
                            document.getElementById('specialization_id').value = document.getElementById('specialization_id_hidden').value;
                            document.getElementById('semester_id').value = document.getElementById('semester_id_hidden').value;


                            document.getElementById("academic_id_hidden").removeAttribute("required");
                            document.getElementById("academic_id_hidden").setAttribute("disabled", "disabled");

                            document.getElementById("specialization_id_hidden").removeAttribute("required");
                            document.getElementById("specialization_id_hidden").setAttribute("disabled", "disabled");

                            document.getElementById("semester_id_hidden").removeAttribute("required");
                            document.getElementById("semester_id_hidden").setAttribute("disabled", "disabled");

                        } else {
                            document.getElementById("fee-details-container").classList.add("d-none");
                            let errorMessage = "No Defined Fees Structure for this!"
                            if (errorMessage) {
                                const url = new URL(window.location.href);
                                url.searchParams.delete("error");
                                window.history.replaceState({}, document.title, url.pathname + url.search);

                                Swal.fire({
                                    title: "Oops!",
                                    text: errorMessage,
                                    icon: "error",
                                    confirmButtonText: "OK"
                                });
                            }
                            errorMessage = null;
                        }

                    },
                    error: function(xhr, status, error) {
                        alert("Lol");
                        console.error("Error loading data:", error);
                    }
                });


            }
        }




        $(document).ready(function() {
            loadAcademicYear();
            loadSpecialization();
            loadSemester();

            $(".fees-select").each(function() {
                loadFeesType(this);
            });
        });



        function loadAcademicYear(selectElement = $("#academic_id_hidden")) {
            const selectedId = $(selectElement).data("selected");
            return $.ajax({
                url: '/academicYear',
                type: 'GET',
                success: function(response) {
                    $(selectElement).html(response);
                    if (selectedId) {
                        $(selectElement).val(selectedId);
                    }
                },
                error: function(error) {
                    console.error("Error loading Academic Year:", error);
                }
            });
        }


        function loadSpecialization(selectElement = $("#specialization_id_hidden")) {
            const selectedId = $(selectElement).data("selected");
            return $.ajax({
                url: '/specializations',
                type: 'GET',
                success: function(response) {
                    $(selectElement).html(response);
                    if (selectedId) {
                        $(selectElement).val(selectedId);
                    }
                },
                error: function(error) {
                    console.error("Error loading Specialization:", error);
                }
            });
        }

        function loadSemester(selectElement = $("#semester_id_hidden")) {
            const selectedId = $(selectElement).data("selected");
            return $.ajax({
                url: '/semesters',
                type: 'GET',
                success: function(response) {
                    $(selectElement).html(response);
                    if (selectedId) {
                        $(selectElement).val(selectedId);
                    }
                },
                error: function(error) {
                    console.error("Error loading Semester:", error);
                }
            });
        }
    </script> -->
    @include('layouts.footer')