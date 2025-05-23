<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.122.0">
  <title>About Us</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
  <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      overflow-x: hidden;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1450' height='570' preserveAspectRatio='none' viewBox='0 0 1450 570'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1040%26quot%3b)' fill='none'%3e%3cpath d='M95.054%2c197.558C134.26%2c199.222%2c174.397%2c186.133%2c195.457%2c153.022C217.982%2c117.607%2c218.015%2c72.507%2c198.084%2c35.569C177.082%2c-3.354%2c139.272%2c-32.177%2c95.054%2c-33.057C49.409%2c-33.965%2c4.637%2c-9.733%2c-15.333%2c31.322C-33.493%2c68.657%2c-14.561%2c110.495%2c8.405%2c145.081C28.425%2c175.23%2c58.896%2c196.023%2c95.054%2c197.558' fill='rgba(81, 46, 95, 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M120.058%2c263.567C168.533%2c263.145%2c204.794%2c224.955%2c229.361%2c183.164C254.359%2c140.64%2c272.159%2c89.2%2c247.765%2c46.327C223.18%2c3.118%2c169.765%2c-9.787%2c120.058%2c-8.94C72.089%2c-8.123%2c23.758%2c9.061%2c-0.33%2c50.552C-24.504%2c92.191%2c-16.281%2c143.18%2c7.409%2c185.097C31.542%2c227.797%2c71.012%2c263.994%2c120.058%2c263.567' fill='rgba(81, 46, 95, 0.4)' class='triangle-float2'%3e%3c/path%3e%3cpath d='M136.001%2c300.532C189.422%2c299.504%2c219.496%2c245.901%2c246.589%2c199.849C274.267%2c152.803%2c308.979%2c99.15%2c282.588%2c51.37C255.736%2c2.757%2c191.467%2c-3.145%2c136.001%2c-0.361C86.273%2c2.135%2c37.769%2c21.793%2c12.861%2c64.906C-12.058%2c108.039%2c-5.284%2c160.102%2c17.789%2c204.251C43.018%2c252.525%2c81.542%2c301.58%2c136.001%2c300.532' fill='rgba(81, 46, 95, 0.4)' class='triangle-float2'%3e%3c/path%3e%3cpath d='M1421.95%2c197.366C1461.991%2c196.848%2c1501.086%2c177.834%2c1519.588%2c142.321C1536.974%2c108.95%2c1525.83%2c69.334%2c1504.97%2c38.018C1486.518%2c10.317%2c1455.23%2c-4.783%2c1421.95%2c-4.257C1389.628%2c-3.746%2c1361.616%2c13.899%2c1343.355%2c40.573C1321.77%2c72.103%2c1302.714%2c110.746%2c1319.836%2c144.905C1338.215%2c181.571%2c1380.938%2c197.897%2c1421.95%2c197.366' fill='rgba(81, 46, 95, 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M1358.608%2c82.562C1379.858%2c82.933%2c1399.085%2c70.518%2c1409.716%2c52.115C1420.353%2c33.703%2c1421.485%2c10.858%2c1410.578%2c-7.396C1399.927%2c-25.22%2c1379.351%2c-34.343%2c1358.608%2c-33.415C1339.388%2c-32.555%2c1323.692%2c-19.766%2c1314.113%2c-3.081C1304.582%2c13.522%2c1301.675%2c33.395%2c1310.501%2c50.383C1320.034%2c68.732%2c1337.933%2c82.201%2c1358.608%2c82.562' fill='rgba(81, 46, 95, 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M1364.427%2c85.651C1384.736%2c85.16%2c1402.853%2c74.065%2c1413.352%2c56.674C1424.247%2c38.627%2c1427.47%2c16.361%2c1417.457%2c-2.19C1406.966%2c-21.629%2c1386.512%2c-34.409%2c1364.427%2c-33.976C1343.003%2c-33.556%2c1325.507%2c-18.786%2c1314.877%2c-0.181C1304.343%2c18.257%2c1300.606%2c40.754%2c1311.223%2c59.145C1321.84%2c77.536%2c1343.197%2c86.165%2c1364.427%2c85.651' fill='rgba(81, 46, 95, 0.4)' class='triangle-float3'%3e%3c/path%3e%3cpath d='M130.178%2c751.024C184.85%2c748.911%2c224.95%2c703.969%2c249.561%2c655.104C271.502%2c611.539%2c273.053%2c559.982%2c247.242%2c518.592C222.797%2c479.392%2c176.355%2c465.069%2c130.178%2c463.663C80.731%2c462.157%2c27.84%2c470.12%2c0.077%2c511.065C-30.812%2c556.621%2c-32.565%2c616.605%2c-6.331%2c664.992C21.146%2c715.671%2c72.573%2c753.25%2c130.178%2c751.024' fill='rgba(81, 46, 95, 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M127.715%2c733.537C181.449%2c732.65%2c231.804%2c705.865%2c258.501%2c659.224C285.031%2c612.875%2c284.129%2c555.037%2c255.798%2c509.766C229.029%2c466.992%2c178.175%2c450.178%2c127.715%2c450.239C77.38%2c450.299%2c27.561%2c467.848%2c0.163%2c510.073C-29.781%2c556.223%2c-38.04%2c615.89%2c-10.769%2c663.668C16.702%2c711.796%2c72.307%2c734.451%2c127.715%2c733.537' fill='rgba(81, 46, 95, 0.4)' class='triangle-float2'%3e%3c/path%3e%3cpath d='M134.937%2c752.687C189.411%2c752.371%2c231.535%2c709.572%2c257.134%2c661.487C281.032%2c616.597%2c284.41%2c563.359%2c259.261%2c519.158C233.839%2c474.477%2c186.317%2c445.059%2c134.937%2c446.714C86.019%2c448.29%2c48.201%2c484.345%2c23.751%2c526.744C-0.672%2c569.096%2c-11.326%2c619.054%2c10.26%2c662.919C34.494%2c712.166%2c80.051%2c753.005%2c134.937%2c752.687' fill='rgba(81, 46, 95, 0.4)' class='triangle-float2'%3e%3c/path%3e%3cpath d='M1376.122%2c552.979C1396.834%2c552.343%2c1416.346%2c543.26%2c1427.289%2c525.663C1438.896%2c506.999%2c1442.504%2c483.174%2c1431.288%2c464.272C1420.258%2c445.683%2c1397.723%2c438.66%2c1376.122%2c439.432C1355.955%2c440.152%2c1338.208%2c450.952%2c1327.384%2c467.983C1315.591%2c486.539%2c1308.273%2c509.906%2c1319.21%2c528.98C1330.187%2c548.123%2c1354.065%2c553.656%2c1376.122%2c552.979' fill='rgba(81, 46, 95, 0.4)' class='triangle-float3'%3e%3c/path%3e%3cpath d='M1360.155%2c535.584C1378.87%2c535.474%2c1393.23%2c520.858%2c1402.32%2c504.499C1411.106%2c488.688%2c1413.631%2c470.132%2c1405.506%2c453.972C1396.473%2c436.007%2c1380.244%2c419.773%2c1360.155%2c420.638C1340.96%2c421.465%2c1329.833%2c440.493%2c1321.102%2c457.608C1313.381%2c472.744%2c1309.511%2c489.809%2c1317.12%2c505.002C1325.567%2c521.867%2c1341.293%2c535.695%2c1360.155%2c535.584' fill='rgba(81, 46, 95, 0.4)' class='triangle-float1'%3e%3c/path%3e%3cpath d='M1403.606%2c612.622C1436.327%2c614.585%2c1468.513%2c598.928%2c1485.243%2c570.739C1502.299%2c542%2c1501.689%2c505.544%2c1483.973%2c477.207C1467.213%2c450.399%2c1435.219%2c440.616%2c1403.606%2c440.16C1370.984%2c439.69%2c1334.725%2c446.178%2c1319.124%2c474.831C1303.933%2c502.731%2c1320.736%2c534.781%2c1337.341%2c561.864C1352.928%2c587.287%2c1373.839%2c610.836%2c1403.606%2c612.622' fill='rgba(81, 46, 95, 0.4)' class='triangle-float1'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1040'%3e%3crect width='1450' height='570' fill='white'%3e%3c/rect%3e%3c/mask%3e%3cstyle%3e %40keyframes float1 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(-10px%2c 0)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float1 %7b animation: float1 5s infinite%3b %7d %40keyframes float2 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(-5px%2c -5px)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float2 %7b animation: float2 4s infinite%3b %7d %40keyframes float3 %7b 0%25%7btransform: translate(0%2c 0)%7d 50%25%7btransform: translate(0%2c -10px)%7d 100%25%7btransform: translate(0%2c 0)%7d %7d .triangle-float3 %7b animation: float3 6s infinite%3b %7d %3c/style%3e%3c/defs%3e%3c/svg%3e");
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: "Poppins", sans-serif;
      position: relative;
      color:rgb(255, 255, 255);
      perspective: 1000px; /* Enables 3D space */
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
      color: #512E5F;
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
      animation: cardPulse 4s ease-in-out infinite;
      position: relative;
      transform: translateZ(15px); /* 3D effect */
    }

    @keyframes cardPulse {
      0%, 100% { transform: translateY(0) translateZ(15px); opacity: 0.85; }
      50% { transform: translateY(-15px) translateZ(15px); opacity: 1; }
    }

    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
      filter: drop-shadow(0 0 15px rgba(81, 46, 95, 0.4));
      animation: floatImage 6s ease-in-out infinite;
    }

    @keyframes floatImage {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-25px); }
    }

    .card-body {
      padding: 2.5rem;
    }

    .card-text {
      color: #000000;
      font-size: 0.9rem;
      line-height: 1.6;
      animation: textFade 3s ease-in-out infinite;
    }

    @keyframes textFade {
      0%, 100% { opacity: 0.9; }
      50% { opacity: 1; }
    }

  /* Footer */
footer {
  background: #000000; /* Solid black background */
  color: #ffffff; /* Changed to white text */
  padding: 5rem 0;
  font-size: 0.8rem;
  text-align: center;
  animation: footerPulse 5s infinite ease-in-out;
}

@keyframes footerPulse {
  0%, 100% { box-shadow: 0 -10px 25px rgba(81, 46, 95, 0.3); }
  50% { box-shadow: 0 -15px 35px rgba(81, 46, 95, 0.5); }
}

footer a {
  background: #000000; /* Black background for button */
  color: #ffffff; /* White text for the button */
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
  <!-- Randomly positioned animated nodes -->
  <div class="node" style="top: 20%; left: 10%;"></div>
  <div class="node" style="top: 40%; left: 80%;"></div>
  <div class="node" style="top: 60%; left: 30%;"></div>
  <div class="node" style="top: 80%; left: 60%;"></div>

  <main>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand">Welcome!</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
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
  </main>

  <footer class="text-body-secondary py-5">
    <div class="container">
      <p class="float-end mb-1">
        <a href="#" class="back-to-top">Back to top <span class="arrow">↑</span></a>
      </p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Inventore, reprehenderit? Praesentium sit voluptatibus esse voluptates iure. Molestiae error sequi excepturi aliquam dolores, rationem maiores blanditiis minus. Delectus!</p>
    </div>
  </footer>
</body>

</html>