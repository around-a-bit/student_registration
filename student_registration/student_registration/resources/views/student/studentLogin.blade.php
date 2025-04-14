<!DOCTYPE html>
<html lang="en">

@include('layouts.loginHeader')

<body>


    <!-- --------------------------------------------------------------------------------------------------------- -->
    <!-- Message Alert Section -->


    <!-- --------------------------------------------------------------------------------------------------------- -->
    <div class="landing-page">
        <header>
            <div class="container">
                <div class="text-center">
                    <h5 id="hoverName" class="navbar-brand text-center">Data-Core</h5>
                </div>
                <ul class="links">
                    <li><a href="{{route('about.us')}}">About Us</a></li>
                    <li><a href="{{route('contact.us')}}">Contact Us</a></li>
                    <li><a href="{{route('show.registraion.form')}}">Student Registration</a></li>
                </ul>
            </div>
        </header>
        <div class="content">
            <div class="container">
                <div class="info">

                    @if(request()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ request()->get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('student.login.validate') }}" id="loginId" method="post" novalidate>
                        <h1>Login</h1>
                        @csrf
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email"
                                aria-describedby="emailHelp" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <i class="fa-solid fa-eye-slash" onclick="togglePassword('password', 'eye-icon1')" id="eye-icon1"></i>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                        <div class="form-group" id="forgetPassword">
                            <a class=" btn-primary" href="{{ route('forget.password') }}">Forget password?</a>
                        </div>
                    </form>
                </div>
                <div class="image">
                    <img src="{{ asset('images/login.webp') }}" alt="Image">
                </div>
            </div>
        </div>
    </div>

    <!-- --------------------------------------------------------------------------------------------------------- -->



    <!-- --------------------------------------------------------------------------------------------------------- -->
    @include('layouts.footer')