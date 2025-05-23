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
            <form action="{{ route('admin.payment.schedule.firstsubmit') }}" method="POST" class="form-control">
                @method('POST')
                @csrf
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4 p-3">Payment Schedule</h5>
                    <div id="degree-container" style="align-items: center;">
                        <div class="row mb-3 g-2">
                            <div class="col-md-6">
                                <label for="fees_structure_id" class="form-label small text-muted">Fees Structure<span class="text-danger">*</span></label>
                                <select name="fees_structure_id" id="fees_structure_id" class="form-select academic-select" required></select>
                            </div>
                            <div class="col-md-6">
                                <label for="amount" class="form-label small text-muted">Amount <span class="text-danger">*</span></label>
                                <input type="text" name="amount" class="form-control form-control" id="amount" readonly>
                            </div>
                        </div>

                        <div class="row mb-3 g-3">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-success w-auto">next<i class="bi bi-plus"></i></button>
                            </div>
                            <div class="col text-center">
                                <a href="{{ route('admin.payment.panel') }}" class="btn btn-warning w-auto">Back <i class="bi bi-arrow-clockwise"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectElement = document.getElementById('fees_structure_id'); // ← You missed this
            selectElement.addEventListener('change', (event) => {
                const fees_structure_id = event.target.value;
                $.ajax({
                    url: `/feesStructureAmount?fees_structure_id=${encodeURIComponent(fees_structure_id)}`,
                    type: "GET",
                    success: function(response) {
                        document.getElementById("amount").value = response ?? '';
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading amount:", error, xhr, status);
                    },
                });
            });
        });
        $(document).ready(function() {
            loadFeesStructure();


        });

        function loadFeesStructure() {
            $.ajax({
                url: "/feesStructure",
                type: "GET",
                success: function(response) {
                    $("#fees_structure_id").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Error loading countries: " + error + " " + xhr + " " + status);
                },
            });
        }
    </script>
    @include('layouts.footer')