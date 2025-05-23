<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{$title}}</title>
  <link rel="stylesheet" href="{{ asset('css/welcome_style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/googleapisFont.css') }}">
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/sweetAlert.js') }}"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>

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

let deleteMessage = "{{ request('delete_message') ?? '' }}";
if(ch3){
     successMessage = "{{ isset($delete_message) ? $success : null }}";  
}
console.log(deleteMessage);
</script>

</head>

<body>
  <!-- Randomly positioned animated nodes -->
  <div class="node" style="top: 20%; left: 10%;"></div>
  <div class="node" style="top: 40%; left: 80%;"></div>
  <div class="node" style="top: 60%; left: 30%;"></div>
  <div class="node" style="top: 80%; left: 60%;"></div>

  <div class="landing-page">
    <header>
      <div class="container">
        <div class="text-center">
          <h5 id="hoverName" class="navbar-brand text-center">Data-Core</h5>
        </div>
        <ul class="links">
          <li><a href="#about-us">About Us</a></li>
          <li><a href="{{route('contact.us')}}">Contact Us</a></li>
          <li><a href="{{route('student.login')}}">Student Login</a></li>
          <li><a href="{{route('admin.login')}}">Admin Login</a></li>
        </ul>
      </div>
    </header>
    <div class="content">
      <div class="container">
        <div class="info">
          <h1 class="typing">Looking For Inspiration</h1>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus odit nihil ullam nesciunt quidem iste, Repellendus odit nihil</p>
          <button><a href="{{route('show.registraion.form')}}">Student Registration</a></button>
        </div>
        <div class="image">
          <img src="{{ asset('images/Welcome.png') }}" alt="Image">
        </div>
      </div>
    </div>

    <!-- About Us Section -->
    <section id="about-us" class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light">Empowering Education</h1>
          <p class="lead text-body-secondary">Discover how our platform streamlines academic administration, connecting students, faculty, and management for a seamless learning experience. Our mission is to simplify processes, enhance collaboration, and support educational excellence.</p>
        </div>
      </div>
    </section>

    <div class="album py-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <div class="col">
            <div class="card shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
              </svg>
              <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum, ipsa dignissimos? Nesciunt possimus doloribus maxime?</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
              </svg>
              <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum, ipsa dignissimos? Nesciunt possimus doloribus maxime?</p>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
              </svg>
              <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsum, ipsa dignissimos? Nesciunt possimus doloribus maxime?</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('js/alertMessages.js') }}"></script>

    @include('layouts.footer')
  </div>
</body>

</html>