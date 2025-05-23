<!DOCTYPE html>
<html lang="en">

@include('layouts.header')
<style>
.btn-primary {
    background-color:rgb(0, 0, 0);
    color: #ffffff;
}
    </style>
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row align-items-center shadow-lg p-3 bg-white rounded">
        <!-- Left Side: Image (Hidden on Small Screens) -->
        <div class="col-md-6 d-none d-md-block">
            <img src="{{ asset('images/forget.png') }}" class="img-fluid" alt="OTP Verification">
        </div>

        <!-- Right Side: OTP Form -->
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Verify OTP</h4>
                    <form action="{{ route('validate.otp.details') }}" method="POST">
                        <input type="hidden" name="email" value="{{ request('email') }}">
                        <input type="hidden" name="token" value="{{ request('token') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Enter OTP</label>
                            <input type="text" name="otp" minlength="4" maxlength="4" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layouts.footer')