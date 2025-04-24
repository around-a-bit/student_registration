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
  <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/googleapisFont.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    body {
      opacity: 0;
      animation: fadeIn 0.5s ease-in-out forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }



    /* Make input and select boxes fully responsive */
    @media (max-width: 768px) {
      table {
        width: 100%;
        display: block;
        overflow-x: auto;
        overflow: auto;
        white-space: nowrap;
        flex-direction: row;
      }

      tr {
        display: flex;
        width: 100%;
        flex-direction: row;
      }

      td {
        display: flex;
        flex-direction: row;
        width: 100%;
        margin-bottom: 10px;
      }

      .form-control,
      .form-select-3 {
        width: 100% !important;
        min-width: 0;
        flex: 1;
      }
    }

    tr,
    td {
      flex-direction: row;
    }
  </style>

  <!-- Scripts -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/sweetAlert.js') }}"></script>
  <script>
    loadBaseData(student);
  </script>

  @foreach ($errors as $error)
  <p>{{ $error }}</p>
  @endforeach
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
<style>
  .btn-primary {
    width: auto;
  }

  .card.mb-4 {
    box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.5);
  }
</style>

<body>

  @php
  $photoUrl = asset('storage/uploads/photos/' . $student->photo);
  $signatureUrl = asset('storage/uploads/signatures/' . $student->signature);
  @endphp

  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
      <a class="navbar-brand"><img id="logo" src="{{ asset('images/datacore-logo.png') }}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Data-Core</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column p-3">
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="{{ route('student.page') }}" class="nav-link active" aria-current="page">
              <i class="bi bi-house-door me-2"></i> Home
            </a>
          </li>
          <li><a href="{{ route('student.page') }}" class="nav-link text-white"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
          <li><a href="{{ route('student.page') }}" class="nav-link text-white"><i class="bi bi-table me-2"></i> Class Routine</a></li>
          <li><a href="{{ route('student.page') }}" class="nav-link text-white"><i class="bi bi-grid me-2"></i> Borrowed Books</a></li>
          <li><a href="{{ route('student.page') }}" class="nav-link text-white"><i class="bi bi-person-circle me-2"></i> Library Access</a></li>
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            @if(!empty($student->signature))
            <img src="{{ asset('storage/uploads/photos/thumb-' . $student->photo) }}" alt="User Avatar" width="32" height="32" class="rounded-circle me-2">
            @else
            <span class="text-muted">No photo uploaded</span>
            @endif
            <strong>{{ $student->fname ?? 'Student' }}</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="{{ route('student.page') }}"><i class="bi bi-person-circle"></i> Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{ route('student.delete', $student->email) }}" id="delete-student-{{ $student->email }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-action-delete btn-sm" onclick="alertMessage(event,'delete','{{ $student->email }}')"><i class="bi bi-person-x"></i> Delete Account</button>
              </form>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{ route('logout')     }}" id="signOut" method="GET" style="display:inline;">

                <button type="button" class="nav-link text-white" onclick="alertMessage(event,'signOut',null)"><i class="bi bi-box-arrow-right"></i> Sign out</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- -------------------------------------------------------------------------------- -->

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
      <!-- Modal for Full Image -->
      <div id="imageModal" class="modal" onclick="closeFullImage()">
        <span class="close" onclick="closeFullImage()">&times;</span>
        <img class="modal-content" id="fullImage">
      </div>
      <!-- -------------------------------------------------------------------------------- -->
      <h1 class="mb-4">Welcome, {{ $student->fname ?? 'Student' }}!</h1>

      <!-- Student Info Card -->
      <div class="card mb-4">
        <div class="card-header">
          <h2 class="h5 mb-0">Your Profile Overview</h2>
        </div>
        <div class="card-body">
          <div class="row">

            <!-- Photo & Update Button -->
            <div class="col-md-4 text-center">
              @if(!empty($student->signature))
              <img src=" {{ asset('storage/uploads/photos/thumb-' . $student->photo) }} " alt="User Avatar" class="rounded-circle me-2" onclick="viewFullImage('{{ $photoUrl }}')">
              @else
              <span class="text-muted">No photo uploaded</span>
              @endif
              <hr>
         <!-- if student_registration -->
          @if(!empty($student->registration_no))
              <a href="{{ route('student.pdf', $student->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> view Application
              </a>
              @else
              <a href="{{ route('edit-student', $student->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square"></i> Complete Your Registration
              </a>
              @endif
            </div>

            <div class="col-md-8">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th>Full Name</th>
                    <td>{{ $student->fname }} {{ $student->lname }}</td>
                  </tr>
                  <tr>
                    <th>Email ID</th>
                    <td>{{ $student->email }}</td>
                  </tr>
                  <tr>
                    <th>Mobile Number</th>
                    <td>{{ $student->mobile }}</td>
                  </tr>
                  <tr>
                    <th>Signature</th>
                    <td>
                      @if(!empty($student->signature))
                      <img
                        src=" {{ asset('storage/uploads/signatures/thumb-' . $student->signature) }} " alt="User Signature" onclick="viewFullImage('{{ $signatureUrl }}')">
                      @else
                      <span class="text-muted">No signature uploaded</span>
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div> <!-- end col-md-8 -->
          </div> <!-- end row -->
        </div> <!-- end card-body -->
      </div> <!-- end card -->

    </div> <!-- end flex-grow-1 p-3 -->
  </div> <!-- end d-flex -->


  <script src="{{ asset('js/viewFullimage.js') }}"></script>

  <!-- --------------------------------------------------------- -->

  @include('layouts.footer')
</body>

</html>