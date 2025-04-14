@php
$studentJson = json_encode($student);
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Update Student Data</title>
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <link rel="stylesheet" href="{{ asset('css/style1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- ---------------------------------------------------------------------------------------------------------- -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<!-- ---------------------------------------------------------------------------------------------------------- -->
 <!-- Form Container -->
 <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center">Student Registration Form</h1>
                        <p class="card-title text-center">Enter the details carefully.</p>
                           <!-- Alert Messages -->
                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(request()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ request()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(request()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ request()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif


                <!-- ---------------------------------------------------------------------------------------------------------- -->
                        <form action="{{ route('registration.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" value="{{ $student->fname ?? 'N/A' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" value="{{ $student->lname ?? 'N/A' }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Gender</label>
                                <select id="gender_id" name="gender_id" class="form-control" required></select>

                                    <option value="{{ old('gender_id') }}">"{{old('gender_name')}}"</option>

                                    </option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ $student->email ?? 'N/A' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Mobile Number</label>
                                    <input type="text" id="mobile" name="mobile" class="form-control" value="{{ $student->mobile ?? 'N/A' }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Student UID</label>
                                <input type="text" id="uid" name="uid" class="form-control" value="{{ $student->uid ?? 'N/A' }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Degree</label>
                                <select id="degree_id" id="degree_id" name="degree_id" class="form-control" required></select>
                            </div>

                            <div class="mb-3">
                                <label>Specialization</label>
                                <select id="specialization_id" name="specialization_id" class="form-control" required></select>
                            </div>

                            <div class="mb-3">
                                <label>University</label>
                                <select id="school_id" name="school_id" class="form-control" required></select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Date of Birth</label>
                                    <input type="date" name="dob" id="dob" class="form-control" value="{{ $student->dob ?? 'N/A' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Country</label>
                                    <select id="country_id" name="country_id" class="form-control" required></select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>State</label>
                                    <select id="state_id" name="state_id" class="form-control" required></select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>District</label>
                                    <select id="district_id" name="district_id" class="form-control" required></select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>PIN Code</label>
                                <input type="text" name="pin" id="pin" class="form-control" value="{{ $student->pin ?? 'N/A' }}" required>
                            </div>

                            <div class="mb-3">
                                <label>Photo</label>
                                <input type="file" id="photo" name="photo" class="form-control" placeholder="Upload your photo" >
                            </div>

                            <div class="mb-3">
                                <label>Signature</label>
                                <input type="file" name="signature" id="signature" class="form-control" placeholder="Upload your signature" >
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Confirm Password</label>
                                    <input type="text" id="password_confirmation" name="password_confirmation" class="form-control">
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary w-100" type="submit">Submit Form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <!-- ---------------------------------------------------------------------------------------------------------- -->

 @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(request()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ request()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(request()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach(request()->get('error') as $field => $messages)
        @foreach($messages as $message)
        <p>{{ $message }}</p>
        @endforeach
        @endforeach
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif















<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Admin Home</title>
  <!-- -------------------------------------------------------------------------------- -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- -------------------------------------------------------------------------------- -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/sweetAlert.js') }}"></script>
  <!-- -------------------------------------------------------------------------------- -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body>

  <main class="container-fluid p-4">


    <nav class="navbar navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand">TNU</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">TNU</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column p-3">
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="{{ route('admin.page') }}" class="nav-link active" aria-current="page">
              <i class="bi bi-house-door me-2"></i> Home
            </a>
          </li>
          <li><a href="{{ route('admin.page') }}" class="nav-link text-white"><i class="bi bi-grid me-2"></i> Profile</a></li>
          <li><a href="{{ route('admin.panel') }}" class="nav-link text-white"><i class="bi bi-table me-2"></i> Student Dashboard</a></li>
          <li><a href="{{ route('admin.page') }}" class="nav-link text-white"><i class="bi bi-map"></i> Browse Courses</a></li>
          <li><a href="{{ route('admin.page') }}" class="nav-link text-white"><i class="bi bi-arrow-up-right-circle"></i> Skill Assessment</a></li>
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            @if(!empty($admin->signature))
            <img src="{{ asset('storage/uploads/photos/thumb-' . $admin->photo) }}" alt="User Avatar" width="32" height="32" class="rounded-circle me-2">
            @else
            <span class="text-muted">No photo uploaded</span>
            @endif
            <strong>{{ $admin->fname ?? 'admin' }}</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="{{ route('admin.page') }}"><i class="bi bi-person-circle"></i> Profile</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <form action="{{ route('student.delete', $admin->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-action-delete btn-sm" onclick="return confirm('Are you sure you want to delete this account?');"><i class="bi bi-person-x"></i> Delete Account</button>
              </form>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="return confirm('Are you sure you want to Sign Out?');"><i class="bi bi-box-arrow-right"></i> Sign out</a></li>
          </ul>
        </div>
      </div>
    </div>




 <script>


$(document).ready(function () {

const student = JSON.parse('{!! addslashes(json_encode($student)) !!}');
// console.log("Student Data:", student);
async function loadBaseData(student) {
    try {
        await Promise.all([
            loadGenders(student),
            loadDegrees(student),
            loadSpecializations(student),
            loadSchools(student),
            loadCountries(student)
        ]);
    } catch (error) {
        console.error("Initial load failed:", error);
    }
}

function loadGenders(student) {
    return $.ajax({
        url: '/genders',
        type: 'GET',
        success: function (response) {
            $("#gender_id").html(response).val(student.gender);
        },
        error: function (xhr, status, error) {
            console.error("Error loading genders:", error);
        }
    });
}

function loadDegrees(student) {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    return $.ajax({
        url: '/degrees',
        type: 'GET',
        success: function (response) {
            $("#degree_id").html(response).val(student.degree);
        },
        error: function (xhr, status, error) {
            console.error("Error loading degrees:", error);
        }
    });
}

function loadSpecializations(student) {
    return $.ajax({
        url: '/specializations',
        type: 'GET',
        success: function (response) {
            $("#specialization_id").html(response).val(student.specialization);
        },
        error: function (xhr, status, error) {
            console.error("Error loading specializations:", error);
        }
    });
}

function loadSchools(student) {
    return $.ajax({
        url: '/schools',
        type: 'GET',
        success: function (response) {
            $("#school_id").html(response).val(student.school);
        },
        error: function (xhr, status, error) {
            console.error("Error loading schools:", error);
        }
    });
}

function loadCountries(student) {
    return $.ajax({
        url: '/countries',
        type: 'GET',
        success: function (response) {
            $("#country_id").html(response).val(student.country);
            loadStates(student, student.country);
        },
        error: function (xhr, status, error) {
            console.error("Error loading countries:", error);
        }
    });
}

function loadStates(student, countryId) {
    return $.ajax({
        url: `/states/${countryId}`,
        type: 'GET',
        success: function (response) {
            $("#state_id").html(response).val(student.state);
            loadDistricts(student, student.state);
        },
        error: function (xhr, status, error) {
            console.error("Error loading states:", error);
        }
    });
}

function loadDistricts(student, stateId) {
    return $.ajax({
        url: `/districts/${stateId}`,
        type: 'GET',
        success: function (response) {
            $("#district_id").html(response).val(student.district);
        },
        error: function (xhr, status, error) {
            console.error("Error loading districts:", error);
        }
    });
}

// Event handlers
$('#country_id').change(function () {
    loadStates(student, $(this).val());
});

$('#state_id').change(function () {
    loadDistricts(student, $(this).val());
});

// Initial data load
loadBaseData(student);
});


// Remove error query parameter from URL on page load
$(document).ready(function () {
    const url = new URL(window.location.href);
    if (url.searchParams.has("error")) {
        setTimeout(() => {
            url.searchParams.delete("error");
            window.history.replaceState({}, document.title, url.pathname + url.search);
        }, 1);
    }
});


document.addEventListener("DOMContentLoaded", function() {
        const url = new URL(window.location.href);
        if (url.searchParams.has("error")) {
            setTimeout(() => {
                url.searchParams.delete("error");
                window.history.replaceState({}, document.title, url.pathname + url.search);
            }, 1);
        }
    });
    

    </script>

    <!-- ---------------------------------------------------------------------------------------------------------- -->

<!-- ---------------------------------------------------------------------------------------------------------- -->

</body>

</html>