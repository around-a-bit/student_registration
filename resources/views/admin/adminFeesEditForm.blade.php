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

<script>
    $(document).ready(function() {

        function checkAndTriggerAjax() {
            let academic_id = $('#academic_id').val();
            let specialization_id = $('#specialization_id').val();

            if (academicId && courseId) {
                $.ajax({
                    url: '/fetchFeesDetails', // route
                    method: 'GET',
                    data: {
                        academic_id: academic_id,
                        specialization_id: specialization_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('Data fetched:', response);
                    },
                    error: function(xhr) {
                        console.log('Something went wrong');
                    }
                });
            }
        }

        $('#academic_id, #course_id').change(function() {
            checkAndTriggerAjax();
        });
    });
</script>
</head>

<body>
    <main class="container-fluid p-4 d-flex align-items-center justify-content-center">
        <div class="card glassy-card w-100">
            <form action="{{ route('admin.addFees',$id) }}" method="POST" class="form-control">
                @method('POST')
                @csrf
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4 p-3">Fees Structure</h5>
                    <div id="degree-container">
                        <div class="row mb-3 g-3">


                            <div class="col-md-4">
                                <label for="academic_id" class="form-label small text-muted">Academic Year <span class="text-danger">*</span></label>
                                <select name="academic_id" id="academic_id" class="form-select academic-select" data-selected="{{ $fees_structure->academic_id }}" required>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="specialization_id" class="form-label small text-muted">Course <span class="text-danger">*</span></label>
                                <select name="specialization_id" id="specialization_id" data-selected="{{ $fees_structure->course_id }}" class="form-select specialization-select" required>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="semester_id" class="form-label small text-muted">Semester <span class="text-danger">*</span></label>
                                <select name="semester_id" id="semester_id" class="form-select semester-select" data-selected="{{ $fees_structure->semester_id }}" required>

                                </select>
                            </div>
                        </div>
                    </div>
                    @foreach ($feesDetails as $i => $fee)

                    <div class="row degree-row g-3">
                        <div class="col-md-3">
                            <label for="fees_head_id_{{ $i }}" class="form-label small text-muted">Fee Type <span class="text-danger">*</span></label>
                            <select name="fees_head_id[]" id="fees_head_id_{{ $i }}" class="form-select fees-select" data-selected="{{ $fee->fees_head_id }}">
                            </select>
                            
                        </div>
                        <script>
                            loadFeesType(newRow.querySelector(".fees-select"));
                            </script>
                        <div class="col-md-3">
                            <label for="amount_{{ $i }}" class="form-label small text-muted">Amount <span class="text-danger">*</span></label>
                            <input type="number" name="amount[]" id="amount_{{ $i }}" class="form-control" value="{{ $fee->amount }}">
                        </div>

                        <div class="col-auto d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-fee-row" onclick="removeDegreeRow(this)">Remove</button>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-success" onclick="addFeesRow()">Add Fees Type <i class="bi bi-plus"></i></button>
                        <button type="submit" class="btn btn-primary">Store <i class="bi bi-database-fill-down"></i></button>
                    </div>
                </div>
            </form>

        </div>
    </main>

    <script>
        function addFeesRow() {
            var container = document.getElementById("degree-container");
            var newRow = document.createElement("div");
            newRow.classList.add("row", "mb-3", "degree-row");

            newRow.innerHTML = `
    <div class="row degree-row g-3">
        <div class="col-md-3">
            <label for="fees_head__id" class="form-label small text-muted">Fees Type <span class="text-danger">*</span></label>
            <select name="fees_head_id[]" class="form-select fees-select" data-selected="" required>
            </select>
        </div>
        <div class="col-md-3">
            <label for="amount" class="form-label small text-muted">Amount <span class="text-danger">*</span></label>
            <input type="text" name="amount[]" class="form-control" placeholder="Enter amount" required>
        </div>
        <div class="col-auto d-flex align-items-end">
            <button type="button" class="btn btn-danger" onclick="removeDegreeRow(this)">Remove</button>
        </div>
    </div>
    `;

            container.appendChild(newRow);


            loadFeesType(newRow.querySelector(".fees-select"));
        }

        $(document).ready(function() {
            loadAcademicYear(); 
            loadSpecialization(); 
            loadSemester(); 

            $(".fees-select").each(function() {
                loadFeesType(this); 
            });
        });



        function loadAcademicYear(selectElement = $("#academic_id")) {
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

        function loadFeesType(selectElement = $(".fees-select")) {
            const selectedId = $(selectElement).data("selected");
            return $.ajax({
                url: '/feesType',
                type: 'GET',
                success: function(response) {
                    $(selectElement).html(response);
                    if (selectedId) {
                        $(selectElement).val(selectedId);
                    }
                },
                error: function(error) {
                    console.error("Error loading Fees Type:", error);
                }
            });
        }

        function loadSpecialization(selectElement = $("#specialization_id")) {
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

        function loadSemester(selectElement = $("#semester_id")) {
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
    </script>




    @include('layouts.footer')