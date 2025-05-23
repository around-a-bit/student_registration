<!DOCTYPE html>
<html lang="en">
@include('layouts.header')
<style>
.btn-primary {
    background-color:#000000;
    color: #ffffff;
}
.fa-eye-slash{
    cursor: pointer;
}
    </style>
<!-- <body> -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row align-items-center shadow-lg p-3 bg-white rounded">
        <!-- Left Side: Image (Hidden on Small Screens) -->
        <div class="col-md-6 d-none d-md-block">
            <img src="{{ asset('images/forget.png') }}" class="img-fluid" alt="Reset Password">
        </div>

        <!-- Right Side: Reset Password Form -->
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-title text-center mt-3">
                    <h3>Reset Password</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('reset.password') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="mb-3">
                            <label class="form-label" for="password">New Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password" class="form-control" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password', 'eye-icon1')">
                                    <i class="fa-solid fa-eye-slash" id="eye-icon1"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation', 'eye-icon2')">
                                    <i class="fa-solid fa-eye-slash" id="eye-icon2"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Continue</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('js/togglePassword.js') }}"></script>
@include('layouts.footer')
