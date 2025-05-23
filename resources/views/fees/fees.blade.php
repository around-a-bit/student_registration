<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fees Structure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 CDN -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


</head>
<style>
    @media print {
        body {
            margin: 0;
            padding: 0;
        }

        @page {
            size: A4;
            margin: 0;
            align-items: center;
        }



        .no-print {
            display: none !important;
        }

        .table th,
        .table td {
            padding: 6px !important;
            font-size: 12px;
        }

        .shadow-sm {
            box-shadow: none !important;
        }
    }

    body {
        background: #f8f9fa;
    }
</style>

<body class="p-3">

    <div class="container print-container border p-4 rounded shadow-sm bg-white">

        <!-- Header -->
        <div class="text-center mb-4">
            <img src="{{ asset('images/datacore-logo.png') }}" alt="Logo" height="40" class="mb-2">
            <p class="mb-1 small">Sector II, Bidhannagar, Kolkata, West Bengal 700091</p>
            <h4 class="fw-bold text-uppercase">Fees Structure</h4>
        </div>

        <!-- Info Table -->
        <table class="table table-bordered mb-4">
            <tbody>
                <tr>
                    <th scope="row" class="bg-light text-center">Course Name</th>
                    <td class="text-center">{{ $fees_structure->course ?? '' }}</td>
                </tr>
                <tr>
                    <th scope="row" class="bg-light text-center">Semester</th>
                    <td class="text-center">{{ $fees_structure->semester ?? '' }}</td>
                </tr>
                <tr>
                    <th scope="row" class="bg-light text-center">Academic Year</th>
                    <td class="text-center">{{ $fees_structure->academic ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Fees Breakdown Table -->
        <table class="table table-bordered table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th scope="col">Fees Head</th>
                    <th scope="col">Amount (₹)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($fees_heads as $head)
                @php
                $matched = $fees_head_structure->firstWhere('fees_head_id', $head->id);
                @endphp
                <tr>
                    <td>{{ $head->name }}</td>
                    <td>{{ $matched ? number_format($matched->amount, 2) : '0.00' }}</td>
                </tr>
                @endforeach
                <tr class="fw-bold bg-light">
                    <td>Total Amount</td>
                    <td>{{ $fees_structure->total_amount ?? '0.00' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Timestamp -->
        <div class="text-center text-muted small mt-4">
            Generated on: {{ now()->format('d/m/Y h:i A') }}
        </div>

        <!-- Print Button -->
        <div class="text-center no-print mt-3">
            <button onclick="window.print()" class="btn btn-primary rounded-pill px-4">Print</button>
        </div>

    </div>

</body>

</html>