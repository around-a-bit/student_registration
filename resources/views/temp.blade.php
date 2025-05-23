@include('layouts.adminHeader')
<!-- -------------------------------------------------------------------------------- -->


<style>
    main {
        display: block;
    }

    .card-body {
        padding: 0.5rem;
    }
</style>

<main class="container-fluid p-4">
    <!-- Modal for Full Image -->
    <div id="imageModal" class="modal" onclick="closeFullImage()">
        <span class="close" onclick="closeFullImage()">&times;</span>
        <img class="modal-content" id="fullImage">
    </div>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <h2 class="mb-4 neon-heading fs-md-3 fs-sm-5"><i class="bi bi-funnel"></i>Filter</h2>
    <div class="container-fluid">
        <div class="table-responsive">
            <!-- <div class="container"> -->
            <div class="card-body">
                <form action="{{ route('search.all') }}" method="GET" id="search" class="d-flex flex-column">
                   
                <div class="searchAll">
                        <div class="row">
                        <div class="col">
    <label for="search_term" class="form-label">search_term:</label>
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-search"></i>
        </span>
        <input value="{{ old('search_term', session('search_term')) }}" class="form-control form-control-sm" name="search_term" id="search_term" type="search" placeholder="Search by search_term" aria-label="Search by search_term">
    </div>
</div>
                        </div>
                        <a type="button" class="btn btn-primary btn-sm accordion ">Advanced Search</a>
                        <div class="panel">


                            <div class="row">
                                <div class="col">
                                    <label for="gender_id" class="form-label">Gender:</label>
                                    <select class="form-select form-select-sm" id="gender_id" name="gender_id" placeholder="Search by gender" aria-label="Search by gender"></select>
                                </div>
                                <div class="col">
                                    <label for="school_id" class="form-label">University/Collage:</label>
                                    <select class="form-select form-select-sm" id="school_id" name="school_id" placeholder="Search by school" aria-label="Search by school">
                                        <option value></option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="fname" class="form-label">First Name:</label>
                                    <select id="fname" class="form-control form-control-sm select2" name="fname"></select>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="country_id" class="form-label">Country:</label>
                                    <select id="country_id" name="country_id" class="form-select form-select-sm"></select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="state_id" class="form-label">State:</label>
                                    <select id="state_id" name="state_id" class="form-select form-select-sm"></select>
                                </div>
                                <div class="col-lg-4">
                                    <label for="district_id" class="form-label">District:</label>
                                    <select id="district_id" name="district_id" class="form-select form-select-sm"></select>
                                </div>
                            </div>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <label for="date_from" class="form-label">From:</label>
                                    <input value="{{ old('date_from', session('date_from')) }}" class="form-control form-control-sm" name="date_from" id="date_from" type="date">
                                </div>
                                <div class="col-md-5">
                                    <label for="date_to" class="form-label">To:</label>
                                    <input value="{{ old('date_to', session('date_to')) }}" class="form-control form-control-sm" name="date_to" id="date_to" type="date">
                                </div>
                            </div>


                        </div>
                    </div>




                    <div class="row">

                        <div class="row align-items-center">
                            <div class="col-md-5 d-flex">

                            </div>
                            <div class="col-md-2 mt-3 d-flex">
                                <button class="btn btn-outline-dark btn-sm w-100" id="button" type="button" onclick="validateForm()"><i class="bi bi-search"></i>Search</button>
                            </div>

                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-5 d-flex">

                            </div>
                            <div class="col-md-2 mt-3 d-flex align-items-center justify-content-center">
                                <label for="perPage" class="me-2 fw-bold text-dark mb-0">Show</label>

                                <select name="perPage" id="perPage" class="form-select form-select-sm w-auto me-2">
                                    <!-- <option value="1" {{ request('perPage') == 1 ? 'selected' : '' }}>1</option> -->
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="30" {{ request('perPage') == 30 ? 'selected' : '' }}>30</option>
                                    <option value="40" {{ request('perPage') == 40 ? 'selected' : '' }}>40</option>
                                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="60" {{ request('perPage') == 60 ? 'selected' : '' }}>60</option>
                                    <option value="70" {{ request('perPage') == 70 ? 'selected' : '' }}>70</option>
                                    <option value="80" {{ request('perPage') == 80 ? 'selected' : '' }}>80</option>
                                    <option value="90" {{ request('perPage') == 90 ? 'selected' : '' }}>90</option>
                                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                                </select>

                                <label for="perPage" class="fw-bold text-dark mb-0">entries</label>
                            </div>


                        </div>
                    </div>
                </form>
                <form action="{{ route('admin.panel') }}" method="get" class="mt-3 text-center">
                    @csrf
                    <button class="btn btn-outline-dark btn-sm w-25" type="submit">Reset All</button>
                </form>

            </div>
            <!-- </div> -->
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
    <h2 class="mb-4 neon-heading fs-md-3 fs-sm-5">User Records <i class="bi bi-collection"></i></h2>

    <div id="table-responsive">
        <!-- <div class="table-responsive"> -->
        <table class="table table-modern">
            <thead>
                <tr class="fs-md-3 fs-sm-5">
                    <th class="fixed-column">ID</th>
                    <th>Registration Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Photo</th>
                    <th>Signature</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $count = count($students);
                @endphp
                @if ($count === 0)
                <tr>
                    <td colspan="18" style="display: flex;" class="text-center">No data found</td>
                </tr>
                @else
                @foreach($students as $student)
                @php
                $photoUrl = asset('storage/uploads/photos/' . $student->photo);
                $signatureUrl = asset('storage/uploads/signatures/' . $student->signature);
                @endphp
                <tr class="fs-md-3 fs-sm-5">
                    <td class="fixed-column">{{ $student->id ?? 'No Data' }}</td>
                    <td>{{ $student->registration_no ?? 'No Data' }}</td>
                    <td>{{ $student->fname ?? 'No Data' }} {{$student->lname ?? 'N/A'}}</td>
                    <td>{{ $student->email ?? 'No Data' }}</td>
                    <td>{{ $student->mobile ?? 'No Data' }}</td>

                    <td>
                        @if(!empty($student->photo))
                        <img src="{{ asset('storage/uploads/photos/thumb-' . $student->photo) }}"
                            alt="User Photo Thumbnail" class="thumbnail" width="100px" height="100px"
                            onclick="viewFullImage('{{ $photoUrl }}')">
                        @else
                        <span class="text-muted">No photo uploaded</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($student->signature))
                        <img src="{{ asset('storage/uploads/signatures/thumb-' . $student->signature) }}"
                            alt="User Signature" width="150px" height="50px"
                            onclick="viewFullImage('{{ $signatureUrl }}')" onclick="viewFullImage('{{ $photoUrl }}')">
                        @else
                        <span class="text-muted">No signature uploaded</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('update-student-admin', $student->id) }}" class="btn btn-info btn-sm"> <i class="bi bi-pencil-square"></i>Edit </a>
                        <form action="{{ route('student.pdf', $student->id) }}" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-warning btn-sm"><i class="bi bi-printer-fill"></i>Print</button>
                        </form>
                        <form action="{{ route('student.delete', $student->email) }}" id="delete-student-{{ $student->email }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" onclick="alertMessage(event,'delete','{{ $student->email }}')"><i class="bi bi-trash3"></i>Delete</button>
                        </form>

                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>

        </table>
        <div class="d-flex justify-content-center">
            {!! $students->appends(['perPage' => request('perPage')])->links('pagination::bootstrap-5') !!}

        </div>
    </div>

</main>
<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
<script>
    var fnameRoute = "{{ route('fname.data') }}";
    var csrfToken = "{{ csrf_token() }}";
    var oldFname = "{{ old('fname') }}";
</script>
<!-- ---------------------------------------------------------------------------------------------------------- -->
<script>
    var selectedSchoolId = "{{ session('school_id', old('school_id')) }}";
</script>
<!-- ---------------------------------------------------------------------------------------------------------- -->
<script>
    var selectedCountry = "{{ session('country_id', '') }}";
    var selectedState = "{{ session('state_id', '') }}";
    var selectedDistrict = "{{ session('district_id', '') }}";
</script>
<script src="{{ asset('js/url.js') }}"></script>
<script src="{{ asset('js/adminPanel.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/viewFullimage.js') }}"></script>
<script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
<!-- ---------------------------------------------------------------------------------------------------------- -->
@include('layouts.footer')