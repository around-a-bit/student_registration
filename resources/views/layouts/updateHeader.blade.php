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
    <!-- <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/googleapisFont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/cropper.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <!-- <script src="{{ asset('js/jquery-ui.js') }}"></script> -->
    <!-- <script src="{{ asset('js/select2.min.js') }}"></script> -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="{{ asset('js/import.js') }}"></script> -->
    <script src="{{ asset('js/tabSwitching.js') }}"></script>
    <script src="{{ asset('js/sweetAlert.js') }}"></script>

    </script>

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
<!-- <body style="background-image: url('/images/img2.jpg');"> -->

<body>

    <style>
        body {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1073%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(173%2c 149%2c 183%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c532.274C97.839%2c535.924%2c169.328%2c442.51%2c242.785%2c377.781C306.599%2c321.549%2c367.597%2c261.184%2c397.853%2c181.693C426.99%2c105.143%2c406.093%2c23.059%2c408.956%2c-58.799C412.553%2c-161.653%2c471.013%2c-273.688%2c416.84%2c-361.194C362.845%2c-448.412%2c243.27%2c-465.07%2c143.276%2c-487.955C48.091%2c-509.739%2c-49.657%2c-515.671%2c-143.726%2c-489.484C-238.683%2c-463.05%2c-327.755%2c-414.415%2c-391.368%2c-339.122C-454.546%2c-264.344%2c-491.507%2c-169.19%2c-496.918%2c-71.446C-502.078%2c21.763%2c-469.696%2c112.654%2c-420.778%2c192.163C-375.656%2c265.503%2c-298.384%2c305.961%2c-231.416%2c360.091C-155.094%2c421.781%2c-98.068%2c528.616%2c0%2c532.274' fill='%23745781'%3e%3c/path%3e%3cpath d='M1440 1237.298C1565.665 1215.362 1600.7069999999999 1045.723 1704.46 971.5070000000001 1800.329 902.931 1965.261 929.3820000000001 2017.9 823.918 2070.2039999999997 719.124 1982.708 598.501 1946.173 487.223 1915.747 394.552 1882.836 305.204 1822.4470000000001 228.608 1759.761 149.098 1691.194 63.57400000000001 1592.9279999999999 39.176000000000045 1495.738 15.044999999999959 1403.818 84.09300000000002 1304.969 100.12700000000001 1187.533 119.17599999999999 1053.38 71.31700000000001 957.825 142.19299999999998 859.517 215.111 822.419 347.575 807.561 469.069 792.885 589.079 821.412 709.655 875.186 817.942 927.795 923.8820000000001 1013.74 1004.988 1108.709 1075.499 1209.422 1150.275 1316.431 1258.868 1440 1237.298' fill='%23e3dae6'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1073'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
            /* background-image: url("{{ asset('images/backgroundreg.jpg') }}"); */

            min-height: 100vh;
        }

        /* Global Styles */
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }



        .card {
            padding: 2rem;
            box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.5);
            background: rgba(255, 255, 255, 0.1);
            
        }


        /* Body Styles */
        body {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            padding: 1px;
            margin: 1px;
            border: 2rem;
            justify-content: center;
            color: #333;

            display: flex;
            flex-direction: column;

        }

        .error-message {
            font-size: 0.875em;
            color: #dc3545;
        }

        .is-invalid {
            border-color: #dc3545 !important;
        }





        .card h1 {
            font-size: 2.5rem;
            color: rgba(0, 0, 0, 0.88);
            margin: 1rem;
        }

        .nav-link.active {
            background-color: #512E5F !important;
            /* background-color:rgb(81, 46, 95) !important; */
            color: white !important;
            box-shadow: 0px 0px 8px #512E5F;
            border-radius: 5px;
            transition: 0.3s;
        }

        .nav-link {
            cursor: pointer;
            color: rgb(0, 0, 0);
            font-weight: bold;
        }

        .text-white {
            text-decoration: none;
            color: #fff;
            cursor: pointer;
            display: block;
            /* Ensures it behaves like a block element */
            margin: 5px;
            /* Adds vertical spacing */
            padding: 5px;
            border: none;
        }

        #image-preview {
            max-width: 100%;
        }

        .cropper-container {
            max-width: 100%;
        }

        i {
            cursor: pointer;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 20px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            width: auto;
        }

        .btn-primary:hover {
            background-color: #000000;
            color: #ffffff;
        }
    </style>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Edit Student Details</h1>
                        <p class="card-title text-center">Edit the details carefully.</p>
                        <!-- Alert Messages -->
                        @if(request()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach(request()->get('error') as $field => $messages)
                            @if(is_array($messages))
                            @foreach($messages as $message)
                            <p>{{ implode(', ', (array) $message) }}</p>
                            @endforeach
                            @else
                            <p>{{ $messages }}</p>
                            @endif
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <!-- =================================== TAB HEADERS =================================== -->

                        <script>
                            // Ensure only the first tab is visible on page load
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById("basic-details").style.display = "block";
                                document.getElementById("new-course-selection").style.display = "none";
                                document.getElementById("course-selection").style.display = "none";
                                document.getElementById("address").style.display = "none";
                                document.getElementById("upload-document").style.display = "none";
                            });
                        </script>
                        <ul class="nav nav-tabs" style=" justify-content: space-between;">
                            <li class="nav-item"><span class="nav-link active" onclick="openTab(event, 'basic-details')">Basic Details</span></li>
                            <li class="nav-item"><span class="nav-link" onclick="openTab(event, 'course-selection')">Course Selection</span></li>
                            <li class="nav-item"><span class="nav-link" onclick="openTab(event, 'new-course-selection')">New Course Selection</span></li>
                            <li class="nav-item"><span class="nav-link" onclick="openTab(event, 'address')">Address</span></li>
                            <li class="nav-item"><span class="nav-link" onclick="openTab(event, 'upload-document')">Upload Document</span></li>
                        </ul>