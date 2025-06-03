<!DOCTYPE html>
<html lang="en">

@include('layouts.header')


<body>
    <style>
        #button {
            background-color: black;
            color: #ffffff;
        }
    </style>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row align-items-center shadow-lg p-3 bg-white rounded">
            <!-- Left Side: Image -->
            <div class="col-md-6 d-none d-md-block">
                <img src="{{ asset('images/forget.png') }}" class="img-fluid" alt="Forget Password">
            </div>
            <div class="loader-container" id="loading-screen">
                <div class="loader"></div>
            </div>
            <!-- Right Side: Form -->
            <div class="col-md-6">
                <div class="card border-0">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-4">Verification of your email</h4>
                        <form action="{{ route('email.verification.pre') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">We will send the verification code on your email id</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <button id="button" type="submit" class="btn btn-primary w-100">Continue</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLoader() {
            document.getElementById("loading-screen").style.visibility = "visible";
        }

        function hideLoader() {
            document.getElementById("loading-screen").style.visibility = "hidden";
        }

        window.onload = hideLoader; // Hide loader after page loads

        document.querySelector("form")?.addEventListener("submit", function() {
            showLoader(); // Show loader on form submit
        });
    </script>


    @include('layouts.footer')