<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="DCG Registration">

    @if(isset($title))
    <title>{{ $title }}</title>
    @elseif(request()->has('title'))
    <title>{{ request('title') }}</title>
    @else
    <title>Default Title</title>
    @endif


    <!-- Stylesheets -->

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleStudent.css') }}">
    <link rel="stylesheet" href="{{ asset('css/googleapisFont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/nouislider.min.css') }}">

    <style>
        body {
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }



        /* Make input and select boxes fully responsive */
        @media (max-width: 768px) {
            table {
                width: 100%;
                display: block;
                overflow-x: auto;
                overflow: auto;
                white-space: nowrap;
                flex-direction: row;
            }

            tr {
                display: flex;
                width: 100%;
                flex-direction: row;
            }

            td {
                display: flex;
                flex-direction: row;
                width: 100%;
                margin-bottom: 10px;
            }

            .form-control,
            .form-select-3 {
                width: 100% !important;
                min-width: 0;
                flex: 1;
            }
        }

        tr,
        td {
            flex-direction: row;
        }

        .table-modern td {
            font-size: small;
            border: 1px solid rgb(194 192 192 / 44%);
        }

        .table-modern th {
            background-color: rgba(143, 159, 194, 0.9);
            font-weight: bold;
        }

        .table-modern {
            padding: 1px;
        }

        .table-modern>tbody tr:hover {
            background-color: rgb(232, 43, 43);
            transition: background-color 0.2s ease-in-out;
            cursor: pointer;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/import.js') }}"></script>
    <script src="{{ asset('js/tabSwitching.js') }}"></script>
    <script src="{{ asset('js/sweetAlert.js') }}"></script>
    <script>
        loadBaseData(student);
    </script>

    @foreach ($errors as $error)
    <p>{{ $error }}</p>
    @endforeach
    <script>
        let ch1 = "{{isset($error)}}";
        console.log(ch1);
        let errorMessage = "{{ request('error') ?? '' }}";
        if (ch1) {
            errorMessage = "{{ isset($error) ? $error : null }}";
        }
        console.log(errorMessage);

        let ch2 = "{{isset($success)}}";

        let successMessage = "{{ request('success') ?? '' }}";
        if (ch2) {
            successMessage = "{{ isset($success) ? $success : null }}";
        }
        console.log(successMessage);

        let ch3 = "{{isset($delete_message)}}";

        let deleteMessage = "{{ request('delete_message') ?? null }}";
        if (ch3) {
            successMessage = "{{ isset($delete_message) ? $success : null }}";
        }
        console.log(deleteMessage);
    </script>

    <style>
        .btn-danger {
            margin: 5px;
        }

        .btn-success {
            margin: 5px;
        }
    </style>

</head>