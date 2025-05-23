<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="DCG Registration">
    <link rel="stylesheet" href="{{ asset('css/googleapisFont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    @if(isset($title))
    <title>{{ $title }}</title>
    @elseif(request()->has('title'))
    <title>{{ request('title') }}</title>
    @else
    <title>Default Title</title>
    @endif
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

           
            .shadow-sm {
                box-shadow: none !important;
            }
            .amount {
            text-align: right;
        }
        }

        body {
            font-family: "Poppins", sans-serif;
            font-size: 14px;
            margin-top: 2rem;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        .university-header {
            text-align: center;
        }

        .title {
            font-weight: bold;
            font-size: 18px;
            margin: 10px 0;
            text-decoration: underline;
        }

        .details,
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .details td {
            padding: 5px 10px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 8px 10px;
            text-align: left;
        }

        .amount {
            text-align: right;
        }

        .paid-label {
            border: 2px dashed black;
            font-weight: bold;
            text-align: center;
            letter-spacing: 5px;
            margin-top: 2rem;
            display: grid;
            margin-right: 10rem;
            margin-left: 10rem;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
        }

        .note {
            font-size: 12px;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>


<body>

    <div class="container">
        <div class="university-header">
            <img src="{{ asset('images/datacore-logo.png') }}" alt="Logo" height="40" class="mb-2">
            <h3>DCG</h3>
            <p>Sector II, Bidhannagar, Kolkata, West Bengal 700091</p>
            <div class="title">Payment Receipt</div>
        </div>

        <table class="table">
            <tr>
                <td><strong>Receipt Date:</strong></td>
                <td>{{ \Carbon\Carbon::parse($fee->payment_date)->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td><strong>Receipt No:</strong></td>
                <td>{{ $fee->reciept_number }}</td>
            </tr>
            <tr>
                <td><strong>Name:</strong></td>
                <td>{{ $fee->fname }} {{ $fee->lname }}</td>
            </tr>
            <tr>
                <td><strong>UID No.:</strong></td>
                <td>TNU{{ str_pad($fee->student_id, 10, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td><strong>Course:</strong></td>
                <td>{{ $fee->degree }} in {{ $fee->specialization }}</td>
            </tr>
            <tr>
                <td><strong>Academic:</strong></td>
                <td>{{ $fee->academic }}</td>
            </tr>
            <tr>
                <td><strong>Semester:</strong></td>
                <td>{{ $fee->semester }}</td>
            </tr>
            <tr>
                <td><strong>Contact No.:</strong></td>
                <td>{{ $fee->mobile ?? 'N/A' }}</td>
            </tr>

        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Heads</th>
                    <th class="amount">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($heads as $head)
                <tr>
                    <td>{{ $head->name }}</td>
                    <td class="amount">
                        {{ number_format($head->amount, 2) }}
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="amount"><strong>{{ number_format($fee->total_amount, 2) }}</strong></td>
                </tr>

            </tbody>

        </table>
        <div class="paid-label">
            PAID
        </div>
        <div class="text-center no-print mt-3">
            <button onclick="window.print()" class="btn btn-primary rounded-pill px-4">Print</button>
        </div>

        <div class="footer">
            <p>For DCG</p>
        </div>

        <div class="note">
            This is a computer generated Receipt and does not require signature.<br>
            {{ now()->format('d/m/Y h:i A') }}
        </div>
        <!-- Print Button -->

    </div>


</body>

</html>