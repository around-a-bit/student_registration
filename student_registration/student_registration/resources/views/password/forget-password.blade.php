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

        <!-- Right Side: Form -->
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Forget Password</h4>
                    <form action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <button id="button" type="submit" class="btn btn-primary w-100">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.footer')
