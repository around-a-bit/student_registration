@include('layouts.adminHeader')
<!-- -------------------------------------------------------------------------------- -->
<style>
    main {
        display: block;
    }

    .card-body {
        padding: 0.5rem;
    }

    body {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1073%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(173%2c 149%2c 183%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c532.274C97.839%2c535.924%2c169.328%2c442.51%2c242.785%2c377.781C306.599%2c321.549%2c367.597%2c261.184%2c397.853%2c181.693C426.99%2c105.143%2c406.093%2c23.059%2c408.956%2c-58.799C412.553%2c-161.653%2c471.013%2c-273.688%2c416.84%2c-361.194C362.845%2c-448.412%2c243.27%2c-465.07%2c143.276%2c-487.955C48.091%2c-509.739%2c-49.657%2c-515.671%2c-143.726%2c-489.484C-238.683%2c-463.05%2c-327.755%2c-414.415%2c-391.368%2c-339.122C-454.546%2c-264.344%2c-491.507%2c-169.19%2c-496.918%2c-71.446C-502.078%2c21.763%2c-469.696%2c112.654%2c-420.778%2c192.163C-375.656%2c265.503%2c-298.384%2c305.961%2c-231.416%2c360.091C-155.094%2c421.781%2c-98.068%2c528.616%2c0%2c532.274' fill='%23745781'%3e%3c/path%3e%3cpath d='M1440 1237.298C1565.665 1215.362 1600.7069999999999 1045.723 1704.46 971.5070000000001 1800.329 902.931 1965.261 929.3820000000001 2017.9 823.918 2070.2039999999997 719.124 1982.708 598.501 1946.173 487.223 1915.747 394.552 1882.836 305.204 1822.4470000000001 228.608 1759.761 149.098 1691.194 63.57400000000001 1592.9279999999999 39.176000000000045 1495.738 15.044999999999959 1403.818 84.09300000000002 1304.969 100.12700000000001 1187.533 119.17599999999999 1053.38 71.31700000000001 957.825 142.19299999999998 859.517 215.111 822.419 347.575 807.561 469.069 792.885 589.079 821.412 709.655 875.186 817.942 927.795 923.8820000000001 1013.74 1004.988 1108.709 1075.499 1209.422 1150.275 1316.431 1258.868 1440 1237.298' fill='%23e3dae6'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1073'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
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
                <div class="col-md-6 mb-4">
            <div class="chart-card bg-white p-3 rounded-3 shadow">
                <h5 class="text-center mb-3">Course distribution</h5>
                <div class="chart-container">
                    <canvas id="courseChart"></canvas>
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

        // Gender Chart (Pie)
    Highcharts.chart('container', {
        chart: {
            styledMode: true
        },
        title: {
            text: 'Mobile vendor market share, June 2024'
        },
        series: [{
            type: 'pie',
            allowPointSelect: true,
            keys: ['name', 'y', 'selected', 'sliced'],
            data: chartData,
            showInLegend: true
        }]
    });
</script>

@include('layouts.footer')