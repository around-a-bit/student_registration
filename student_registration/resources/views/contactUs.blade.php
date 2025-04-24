<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>About Us</title>

  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.js') }}"></script>
  <script src="{{ asset('js/jquery.js') }}"></script>


  <style>
    body {
      min-height: 100vh;
      overflow-x: hidden;
      background: #ffffff;
      font-family: "Poppins", sans-serif;
      position: relative;
      color: #000000;
      perspective: 1000px; /* Enables 3D space */
    }

    /* Solar System Background */
    .solar-system {
      position: fixed;
      top: 50%;
      left: 50%;
      width: 100%;
      height: 100%;
      transform: translate(-50%, -50%) translateZ(-100px);
      z-index: -2;
      pointer-events: none;
    }

    .sun {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 80px;
      height: 80px;
      background: radial-gradient(circle, #512E5F 20%, #000000 80%);
      border-radius: 50%;
      box-shadow: 0 0 30px rgba(81, 46, 95, 0.5);
      transform: translate(-50%, -50%);
      animation: glowSun 5s infinite ease-in-out;
    }

    @keyframes glowSun {
      0%, 100% { box-shadow: 0 0 30px rgba(81, 46, 95, 0.5); }
      50% { box-shadow: 0 0 50px rgba(81, 46, 95, 0.8); }
    }

    .planet {
      position: absolute;
      border-radius: 50%;
      background: #512E5F;
      box-shadow: 0 0 10px rgba(81, 46, 95, 0.5);
      transform-origin: center center;
      pointer-events: auto;
    }

    .planet.mercury { width: 20px; height: 20px; animation: orbit 10s infinite linear; }
    .planet.venus { width: 30px; height: 30px; animation: orbit 15s infinite linear; }
    .planet.earth { width: 35px; height: 35px; animation: orbit 20s infinite linear; }
    .planet.mars { width: 25px; height: 25px; animation: orbit 25s infinite linear; }

    @keyframes orbit {
      0% { transform: rotate(0deg) translateX(150px) rotate(0deg); }
      100% { transform: rotate(360deg) translateX(150px) rotate(-360deg); }
    }

    .planet.venus { transform: rotate(0deg) translateX(200px); }
    .planet.earth { transform: rotate(0deg) translateX(250px); }
    .planet.mars { transform: rotate(0deg) translateX(300px); }

    /* Draggable Planets */
    .planet.draggable {
      cursor: grab;
    }

    .planet.draggable:active {
      cursor: grabbing;
    }

    /* Dynamic Background with Radial Pattern */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(circle, #512E5F 1px, transparent 1px);
      background-size: 20px 20px;
      z-index: -1;
      animation: floatBackground 15s infinite ease-in-out;
      opacity: 0.3;
    }

    @keyframes floatBackground {
      0%, 100% { transform: translate(0, 0) scale(1); }
      50% { transform: translate(-30px, -30px) scale(1.03); }
    }

    /* Animated Nodes */
    .node {
      position: absolute;
      width: 10px;
      height: 10px;
      background: #512E5F;
      border-radius: 50%;
      animation: pulseNode 3s infinite ease-in-out;
    }

    @keyframes pulseNode {
      0% { transform: scale(1); opacity: 0.5; }
      50% { transform: scale(1.5); opacity: 1; }
      100% { transform: scale(1); opacity: 0.5; }
    }

    /* Navbar */
    .navbar {
      background: rgba(0, 0, 0, 0.9) !important;
      backdrop-filter: blur(15px);
      box-shadow: 0 0 20px rgba(81, 46, 95, 0.3);
      padding: 1.5rem 3rem;
      animation: navbarPulse 4s infinite ease-in-out;
    }

    @keyframes navbarPulse {
      0%, 100% { box-shadow: 0 0 20px rgba(81, 46, 95, 0.3); }
      50% { box-shadow: 0 0 30px rgba(81, 46, 95, 0.5); }
    }

    .navbar-brand, .nav-link {
      color: #ffffff !important;
      font-weight: 700;
      letter-spacing: 2px;
      position: relative;
      transition: all 0.3s ease;
      font-size: 0.9rem;
      text-shadow: 0 0 5px rgba(81, 46, 95, 0.5);
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: #512E5F;
      transition: width 0.3s ease;
    }

    .nav-link:hover::after {
      width: 100%;
    }

    .nav-link:hover {
      color: #512E5F !important;
      text-shadow: 0 0 10px rgba(81, 46, 95, 0.8);
    }

    .navbar-toggler {
      border: none;
      transition: transform 0.3s ease;
    }

    .navbar-toggler:hover {
      transform: rotate(90deg);
    }

    /* Section */
    section.py-5 {
      padding: 10rem 0;
      animation: fadeIn 2s ease-in-out;
      position: relative;
      overflow: hidden;
      transform-style: preserve-3d;
    }

    section.py-5::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(81, 46, 95, 0.05), transparent);
      animation: wave 10s infinite ease-in-out;
      z-index: -1;
    }

    @keyframes wave {
      0%, 100% { transform: translateX(-10%); opacity: 0.5; }
      50% { transform: translateX(10%); opacity: 0.8; }
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(50px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    h1.fw-light {
      font-size: 3rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 4px;
      color: #512E5F; /* Set to deep purple */
      animation: glowText 3s infinite ease-in-out, glitch 6s infinite alternate;
      text-shadow: 0 0 15px rgba(81, 46, 95, 0.5);
      transform: translateZ(20px); /* 3D effect */
    }

    @keyframes glowText {
      0%, 100% { text-shadow: 0 0 15px rgba(81, 46, 95, 0.5); }
      50% { text-shadow: 0 0 30px rgba(81, 46, 95, 0.8); }
    }

    @keyframes glitch {
      0% { transform: translate(0); }
      20% { transform: translate(-3px, 3px); }
      40% { transform: translate(3px, -3px); }
      60% { transform: translate(-2px, 2px); }
      80% { transform: translate(2px, -2px); }
      100% { transform: translate(0); }
    }

    .lead {
      color: #000000;
      font-size: 1.2rem;
      line-height: 1.7;
      max-width: 900px;
      margin: 3rem auto;
      background: rgba(81, 46, 95, 0.05);
      padding: 1rem 2rem;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(81, 46, 95, 0.2);
      animation: floatText 5s ease-in-out infinite, textGlow 3s infinite alternate;
      transform: translateZ(10px); /* 3D effect */
    }

    @keyframes floatText {
      0%, 100% { transform: translateY(0) translateZ(10px); }
      50% { transform: translateY(-20px) translateZ(10px); }
    }

    @keyframes textGlow {
      0% { text-shadow: 0 0 5px rgba(81, 46, 95, 0.3); }
      100% { text-shadow: 0 0 10px rgba(81, 46, 95, 0.5); }
    }

    /* Cards */
    .album {
      padding: 6rem 0;
      background: none;
      position: relative;
      transform-style: preserve-3d;
    }

    .album::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, rgba(81, 46, 95, 0.05), transparent);
      animation: wave 10s infinite ease-in-out;
      z-index: -1;
    }

    .card {
      background: rgba(81, 46, 95, 0.1);
      background-image: linear-gradient(90deg, rgba(81, 46, 95, 0.1) 1px, transparent 1px), linear-gradient(rgba(81, 46, 95, 0.1) 1px, transparent 1px);
      background-size: 20px 20px;
      border: 1px solid rgba(81, 46, 95, 0.3);
      border-radius: 25px;
      overflow: hidden;
      position: relative;
      transform: translateZ(15px); /* 3D effect */
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
      filter: drop-shadow(0 0 15px rgba(81, 46, 95, 0.4));
    }

    .card-body {
      padding: 2.5rem;
    }

    .card-text {
      color: #000000;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    /* Footer */
    footer {
      background: #000000; /* Solid black background */
      color: #cccccc; /* Light gray text */
      padding: 5rem 0;
      font-size: 0.8rem;
      text-align: center;
    }

    footer a {
      background: #000000; /* Black background for button */
      color: #ffffff;
      padding: 0.5rem 1rem;
      border: 1px solid #512E5F; /* Purple border */
      border-radius: 5px;
      text-decoration: none;
    }

    footer p {
      margin: 1rem 0;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Back to top link */
    .back-to-top {
      position: relative;
      padding-right: 1.5rem;
    }

    .back-to-top .arrow {
      margin-left: 0.5rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      h1.fw-light { font-size: 2.5rem; }
      .lead { font-size: 1rem; }
      .card-text { font-size: 0.8rem; }
      .navbar-brand, .nav-link { font-size: 0.8rem; }
      footer p { font-size: 0.7rem; }
      section.py-5 { padding: 6rem 0; }
    }
  </style>
</head>

<body>
  <!-- Solar System -->
  <div class="solar-system">
    <div class="sun"></div>
    <div class="planet mercury draggable"></div>
    <div class="planet venus draggable"></div>
    <div class="planet earth draggable"></div>
    <div class="planet mars draggable"></div>
  </div>

  <!-- Randomly positioned animated nodes -->
  <div class="node" style="top: 20%; left: 10%;"></div>
  <div class="node" style="top: 40%; left: 80%;"></div>
  <div class="node" style="top: 60%; left: 30%;"></div>
  <div class="node" style="top: 80%; left: 60%;"></div>

  <main>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Welcome!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('contact.us')}}">Contact Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('about.us')}}">About Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="py-5 text-center container">
      <div class="row py-lg-5">
        <div class="col-lg-8 col-md-10 mx-auto">
          <h1 class="fw-light">Empowering Education</h1>
          <p class="lead">Discover how our platform streamlines academic administration, connecting students, faculty, and management for a seamless learning experience. Our mission is to simplify processes, enhance collaboration, and support educational excellence.</p>
        </div>
      </div>
    </section>

    <div class="album py-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
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
  </main>

  <footer class="text-body-secondary py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#" class="back-to-top">Back to top <span class="arrow">↑</span></a>
      </p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Inventore, reprehenderit? Praesentium sit voluptatibus esse voluptates iure. Molestiae error sequi excepturi aliquam dolores, rationem maiores blanditiis minus. Delectus!</p>
    </div>
  </footer>

  <script>
    $(window).on('scroll', function() {
      const scrollPosition = $(this).scrollTop();
      const windowHeight = $(window).height();
      if (scrollPosition > windowHeight / 2) {
        $('body').removeClass('scroll-0').addClass('scroll-1');
      } else {
        $('body').removeClass('scroll-1').addClass('scroll-0');
      }
    });

    // Draggable Planets
    $(document).ready(function() {
      $('.draggable').each(function() {
        $(this).draggable({
          containment: 'window',
          start: function() {
            $(this).css('animation', 'none'); // Stop orbit animation when dragging
          },
          stop: function() {
            // Optionally, you can restart the animation or leave it static
          }
        });
      });
    });
  </script>

</body>

</html>