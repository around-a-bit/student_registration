@include('layouts.adminHeader')
<!-- -------------------------------------------------------------------------------- -->


<style>
    main {
        display: block;
    }

    .card-body {
        padding: 0.5rem;
    }
    body{
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1073%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(173%2c 149%2c 183%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c532.274C97.839%2c535.924%2c169.328%2c442.51%2c242.785%2c377.781C306.599%2c321.549%2c367.597%2c261.184%2c397.853%2c181.693C426.99%2c105.143%2c406.093%2c23.059%2c408.956%2c-58.799C412.553%2c-161.653%2c471.013%2c-273.688%2c416.84%2c-361.194C362.845%2c-448.412%2c243.27%2c-465.07%2c143.276%2c-487.955C48.091%2c-509.739%2c-49.657%2c-515.671%2c-143.726%2c-489.484C-238.683%2c-463.05%2c-327.755%2c-414.415%2c-391.368%2c-339.122C-454.546%2c-264.344%2c-491.507%2c-169.19%2c-496.918%2c-71.446C-502.078%2c21.763%2c-469.696%2c112.654%2c-420.778%2c192.163C-375.656%2c265.503%2c-298.384%2c305.961%2c-231.416%2c360.091C-155.094%2c421.781%2c-98.068%2c528.616%2c0%2c532.274' fill='%23745781'%3e%3c/path%3e%3cpath d='M1440 1237.298C1565.665 1215.362 1600.7069999999999 1045.723 1704.46 971.5070000000001 1800.329 902.931 1965.261 929.3820000000001 2017.9 823.918 2070.2039999999997 719.124 1982.708 598.501 1946.173 487.223 1915.747 394.552 1882.836 305.204 1822.4470000000001 228.608 1759.761 149.098 1691.194 63.57400000000001 1592.9279999999999 39.176000000000045 1495.738 15.044999999999959 1403.818 84.09300000000002 1304.969 100.12700000000001 1187.533 119.17599999999999 1053.38 71.31700000000001 957.825 142.19299999999998 859.517 215.111 822.419 347.575 807.561 469.069 792.885 589.079 821.412 709.655 875.186 817.942 927.795 923.8820000000001 1013.74 1004.988 1108.709 1075.499 1209.422 1150.275 1316.431 1258.868 1440 1237.298' fill='%23e3dae6'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1073'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
    }
</style>

<main class="container-fluid p-4">
    <!-- Modal for Full Image -->
    <div id="imageModal" class="modal" onclick="closeFullImage()">
        <span class="close" onclick="closeFullImage()">&times;</span>
        <img class="modal-content" id="fullImage">
    </div>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <h2 class="mb-4 neon-heading fs-md-3 fs-sm-5"><i class="bi bi-funnel"></i> Filter</h2>
<div class="container-fluid">
    <div class="table-responsive">
        <div class="card-body">
            <form action="{{ route('search.all') }}" method="GET" id="search" class="d-flex flex-column">
                <div class="searchAll">
                    <div class="row align-items-center mb-3">
                        <div class="col-12 col-md-6 d-flex align-items-center">
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
                        <div class="col-12 col-md-6 text-end ">
                            <label for="search_term" class="form-label "><i class="bi bi-search"></i>Search Student by any details</label>
                            <input  value="{{ old('search_term', session('search_term')) }}" class="form-control form-control-sm me-2" name="search_term" id="search_term" type="search" placeholder="Search..." aria-label="Search...">
                        </div>
                    </div>

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                    Advanced Search
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">

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
                        </div>

                        <div class="row mt-4">
    <div class="col-12 text-center">
    <button class="btn btn-outline-dark btn-sm" id="button" type="button" onclick="validateForm()"><i class="bi bi-search"></i>Search</button>
        <a href="{{ route('admin.panel') }}" class="btn btn-outline-dark btn-sm">Reset All</a>
    </div>
</div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
    <h2 class="mb-4 neon-heading fs-md-3 fs-sm-5">Student Records <i class="bi bi-collection"></i></h2>

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

<!-- ---------------------------------------------------------------------------------------------------------- -->
@include('layouts.footer')