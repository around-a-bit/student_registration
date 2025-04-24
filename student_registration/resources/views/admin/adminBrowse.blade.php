@include('layouts.adminHeader')
<!-- -------------------------------------------------------------------------------- -->
<style>
    main {
        display: block;
    }

    .card-body {
        padding: 0.5rem;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main class="container-fluid p-4">
    <div class="row mt-5">
        <!-- Gender distribution -->
        <div class="col-md-6 mb-4">
            <div class="chart-card bg-white p-3 rounded-3 shadow">
                <h5 class="text-center mb-3">Gender distribution</h5>
                <div class="chart-container">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>
    </div>


</main>
<!-- ---------------------------------------------------------------------------------------------------------- -->
<script>
    // Gender Chart (Pie)
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'pie',
        data: {
            labels: ['Male', 'Female', 'Third Gender'],
            datasets: [{
                label: 'Total',
                data: ["{{ json_encode($maleCount) }}", "{{ json_encode($femaleCount)}}", "{{ json_encode($thirdCount) }}"],
                backgroundColor: [
                    '#36b9cc', // Cyan for Male
                    '#512E5F', // Yellow for Female
                    '#f6c23e'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    
</script>

@include('layouts.footer')