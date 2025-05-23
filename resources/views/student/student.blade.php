<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DCG Registration</title>

    <script src="{{ asset('js/print.min.js') }}"></script>
    <style>

        @media print {
            body {
                font-size: 12px;
            }

            .btn {
                display: none;
            }

            @page {
                margin: 0;
                size: auto;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 10px;
            padding: 10px;
            border: 1px solid;
        }

        button {
            background-color: #0057FF;
            color: white;
            font-weight: bold;
            border: 3px solid rgb(255, 255, 255);
            padding: 10px 25px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
            text-align: center;
        }

        button:hover {
            background-color: #0046D1;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        /* Header Styling */
        .section-header {
            background-color: #87CEFA;
            font-weight: bold;
            padding: 8px;
            text-transform: uppercase;
            border: 1px solid #000;
        }

        /* Table Styling */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .details-table th,
        .details-table td {
            text-align: center;
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            word-wrap: break-word;
        }

        .details-table th {

            background-color: #f9f9f9;
            font-weight: bold;
        }

        /* Personal Details */
        .photo,
        .signature {
            width: 100px;
            border: 1px solid #000;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            flex-direction: column;
        }

        .photo img,
        .signature img {
            width: 100%;
            height: auto;
            max-height: 100%;
            padding: 2px;
            margin: 1px;
            object-fit: contain;
        }

        @media print {
            body {
                font-size: 12px;
            }

            .btn {
                display: none;
                /* Hide print button when printing */
            }
        }
    </style>
</head>

<body>

    @if (!empty($student))
    @php
    $photoPath = !empty($student->photo) ? public_path('storage/uploads/photos/' . $student->photo) : null;
    $signaturePath = !empty($student->signature) ? public_path('storage/uploads/signatures/' . $student->signature) : null;
    @endphp
    @endif

    <h1 style="text-align: center;">Student Details</h1>

    <div class="container">
        <!--  ADD PRINT SECTION HERE -->
        <div id="print-section">
            <!-- Basic Details -->
            <div class="section-header">Reference ID</div>
            <table class="details-table">
                <tr>
                    <th>Registration Number</th>
                    <td>{{ $student->registration_no ?? 'Pending' }}</td>
                </tr>
                <tr>
                    <th>Applied for</th>
                    <td>{{ $student->degree_id_opt_name ?? 'Pending' }} <span>in</span> {{ $student->specialization_id_opt_name ?? 'Pending' }}</td>
                </tr>
            </table>

            <!-- Personal Details -->
            <div class="section-header">Personal Details</div>
            <table class="details-table">
                <tr>
                    <th>Name</th>
                    <td>{{ $student->fname ?? 'N/A' }} {{ $student->lname ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td>{{ $student->gender ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ $student->dob ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Photo</th>
                    <td>
                        <div class="photo">
                            @if(!empty($student->photo) && file_exists($photoPath))
                            <img src="{{ asset('storage/uploads/photos/' . $student->photo) }}" alt="User Photo">
                            @else
                            <span>No photo uploaded</span>
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>Signature</th>
                    <td>
                        <div class="signature">
                            @if(!empty($student->signature) && file_exists($signaturePath))
                            <img src="{{ asset('storage/uploads/signatures/' . $student->signature) }}" alt="User signature">
                            @else
                            <span>No signature uploaded</span>
                            @endif
                        </div>
                    </td>
                </tr>
            </table>

            <!-- Contact Details -->
            <div class="section-header">Contact Details</div>
            <table class="details-table">
                <tr>
                    <th>Email Id</th>
                    <td>{{ $student->email ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td>{{ $student->mobile ?? 'N/A' }}</td>
                </tr>
            </table>
            <!-- Address Details -->
            <div class="section-header">Address Details</div>
            <table class="details-table">
                <tr>
                    <th>Street/Lane </th>
                    <td>{{ $student->street ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>District</th>
                    <td>{{ $student->district ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>State</th>
                    <td>{{ $student->state ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $student->country ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>PIN Code</th>
                    <td>{{ $student->pin ?? 'N/A' }}</td>
                </tr>
            </table>

            <!-- Education Details -->
            <div class="section-header">Education Details</div>


            <table class="details-table">
                <thead>
                    <tr>
                        <th style="text-align: center;">Institution</th>
                        <th style="text-align: center;">Degree</th>
                        <th style="text-align: center;">Course</th>
                        <th style="text-align: center;">UID</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                    $uids = explode(',', $student->uids);
                    $degrees = explode(',', $student->degrees);
                    $specializations = explode(',', $student->specializations);
                    $schools = explode(',', $student->schools);
                    @endphp
                    @for ($i = 0; $i < count($uids); $i++)
                        <tr>
                        <td>{{ $schools[$i] }}</td>
                        <td>{{ $degrees[$i] }}</td>
                        <td>{{ $specializations[$i] }}</td>
                        <td>{{ $uids[$i] }}</td>

                        </tr>
                        @endfor
                </tbody>
            </table>


        </div>
        <!--  END PRINT SECTION -->

        <!-- Print Button -->
        <div style="text-align: center;">
            <button onclick="printDocument()" class="btn btn-primary">Print</button>
        </div>
    </div>

    <script>
        function printDocument() {
            let printContent = document.getElementById('print-section').innerHTML;
            let originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>


</html>