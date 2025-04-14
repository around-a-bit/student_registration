<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="{{ asset('css/googleapisFont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetAlert.js') }}"></script>

</head>

<body>
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Student Details</h1>
                        <p class="card-title text-center">Enter the details carefully.</p>
                        <!-- Alert Messages -->
                        <script src="{{ asset('js/sweetAlert.js') }}"></script>
                        <script>
    let ch1 = "{{isset($error)}}";
    console.log(ch1);
let errorMessage = "{{ request('error') ?? '' }}";
if(ch1){
     errorMessage = "{{ isset($error) ? $error : null }}";  
}
console.log(errorMessage);

let ch2 = "{{isset($success)}}";

let successMessage = "{{ request('success') ?? '' }}";
if(ch2){
     successMessage = "{{ isset($success) ? $success : null }}";  
}
console.log(successMessage);

let ch3 = "{{isset($delete_message)}}";

let deleteMessage = "{{ request('delete_message') ?? null }}";
if(ch3){
     successMessage = "{{ isset($delete_message) ? $success : null }}";  
}
console.log(deleteMessage);
</script>
                        <!-- <script src="{{ asset('js/alertMessages.js') }}"></script> -->
                        <!-- =================================== FORM START =================================== -->
                        <form action="{{ route('store.login.details') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- --------------- BASIC DETAILS TAB --------------- -->
                            <!-- <div id="basic-details" class="tab-content"> -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>First Name<span style="color: red;">*</span></label>
                                    <input type="text" name="fname" value="{{ old('fname') }}" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Last Name<span style="color: red;">*</span></label>
                                    <input type="text" name="lname" value="{{ old('lname') }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Email<span style="color: red;">*</span></label>
                                    <input type="hidden" name="email" value="{{ $email }}" class="form-control">
                                    <input type="text" value="{{ $email }}" class="form-control" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mobile Number<span style="color: red;">*</span></label>
                                    <input type="text" name="mobile" value="{{ old('mobile') }}" pattern="[0-9]{10}" minlength="10" maxlength="10" class="form-control" required>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Password<span style="color: red;">*</span></label>
                                    <input type="password" id="password" name="password" class="form-control" minlength="6" required>
                                    <i class="fa-solid fa-eye-slash" onclick="togglePassword('password', 'eye-icon1')" id="eye-icon1"></i>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Confirm Password<span style="color: red;">*</span></label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="6" required>
                                    <i class="fa-solid fa-eye-slash" onclick="togglePassword('password_confirmation', 'eye-icon2')" id="eye-icon2"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary w-50 " type="submit">Register</button>
                            </div>
                            <!-- </div> -->
                            <!-- --------------- /BASIC DETAILS TAB --------------- -->
                        </form>
                        <!-- =================================== /FORM END =================================== -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/togglePassword.js') }}"></script>

    <!-- ---------------------------------------------------------------------------------------------------------- -->
    @include('layouts.footer')