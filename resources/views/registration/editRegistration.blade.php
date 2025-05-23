<!DOCTYPE html>
<html lang="en">

@include('layouts.updateHeader')

@php
$studentJson = json_encode($student);
@endphp

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
<!-- =================================== /TAB HEADERS =================================== -->
<script>
    const student = JSON.parse('{!! addslashes(json_encode($student)) !!}');
</script>


<script src="{{ asset('js/scriptUpdateRegistration.js') }}"></script>

<script>
    loadBaseData(student);
</script>

<!-- =================================== FORM START =================================== -->

<!-- --------------- BASIC DETAILS TAB --------------- -->
<div id="basic-details" class="tabcontent" style="display: block;">
    <form action="{{ route('update-student-basic', $student->email) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!-- <div id="basic-details"> -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>First Name<span style="color: red;">*</span></label>
                <input type="text" value="{{ $student->fname ?? 'N/A' }}" class="form-control" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label>Last Name<span style="color: red;">*</span></label>
                <input type="text" value="{{ $student->lname ?? 'N/A' }}" class="form-control" readonly>
            </div>
        </div>
        <div class="mb-3">
            <label>Gender<span style="color: red;">*</span></label>
            <select id="gender_id" name="gender_id" class="form-control" required></select>


        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Email<span style="color: red;">*</span></label>
                <input type="text" value="{{ $student->email ?? 'N/A' }}" class="form-control" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label>Mobile Number<span style="color: red;">*</span></label>
                <input type="text" min="10" max="10" value="{{ $student->mobile ?? 'N/A' }}" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label>Date of Birth<span style="color: red;">*</span></label>
            <input type="date" name="dob" id="dob" class="form-control" value="{{ $student->dob ?? 'N/A' }}" required>

        </div>
        <div class=" text-center">
            <!-- <button type="button" class="btn btn-secondary prev-tab">Previous</button> -->
            <button type="submit" class="btn btn-primary ">Save</button>
        </div>
        <!-- </div> -->
    </form>
    <div class="container mb-0 mt-5">
        <div class="col col-md-6 mt-2 mb-3">
            <span class="nav-link " onclick="openTab(event, 'course-selection')">
                <i class="bi bi-arrow-right"></i> Next
            </span>
        </div>
    </div>
</div>
</div>
<!-- --------------- /BASIC DETAILS TAB --------------- -->
<!-- --------------- COURSE SELECTION TAB --------------- -->
<div id="course-selection" class="tabcontent">
    <form action="{{ route('update-student-academic', $student->email) }}" method="post" enctype="multipart/form-data">
        <hr>
        @method('PUT')
        @csrf

        @php
        $uids = explode(',', $student->uids);
        $degrees = explode(',', $student->degrees);
        $degree_ids = explode(',', $student->degree_ids);
        $specializations = explode(',', $student->specializations);
        $specialization_ids = explode(',', $student->specialization_ids);
        $schools = explode(',', $student->schools);
        $school_ids = explode(',', $student->school_ids);
        @endphp


        <div id="degree-container">
            @for ($i = 0; $i < count($uids); $i++)
                <div class="row mb-3 degree-row">
                <div class="col">
                    <label for="school_id_{{ $i }}" class="form-label small text-muted">University <span class="text-danger">*</span></label>
                    <select name="school_id[]" id="school_id" class="form-control" data-selected="{{ $school_ids[$i] ?? '' }}">
                    </select>
                </div>
                <div class="col">
                    <label for="degree_id_{{ $i }}" class="form-label small text-muted">Degree <span class="text-danger">*</span></label>
                    <select name="degree_id[]" id="degree_id_{{ $i }}" class="form-control" data-selected="{{ $degree_ids[$i] ?? '' }}"></select>
                </div>
                <div class="col">
                    <label for="specialization_id_{{ $i }}" class="form-label small text-muted">Specialization <span class="text-danger">*</span></label>
                    <select name="specialization_id[]" id="specialization_id_{{ $i }}" class="form-control" data-selected="{{ $specialization_ids[$i] ?? '' }}"></select>
                </div>
                <div class="col">
                    <label for="uid_{{ $i }}" class="form-label small text-muted">Student UID <span class="text-danger">*</span></label>
                    <input type="text" name="uid[]" id="uid" class="form-control" value="{{ $uids[$i] ?? '' }}" minlength="16" maxlength="16">
                </div>
        </div>
        @endfor
</div>

<hr>

<!-- Add More Button -->
<div class="d-flex justify-content-between">
    <button type="button" class="btn btn-success" onclick="addDegreeRow()">Add More</button>
</div>

<br>

<div class="text-center">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
<div class="container mb-0 mt-5">
    <div class="row text-center">
        <div class="col-md-6 mt-2 mb-3">
            <span class="nav-link active" onclick="openTab(event, 'basic-details')">
                <i class="bi bi-arrow-left"></i> Previous
            </span>
        </div>
        <div class="col-md-6 mt-2 mb-3">
            <span class="nav-link active" onclick="openTab(event, 'new-course-selection')">
                <i class="bi bi-arrow-right"></i> Next
            </span>
        </div>
    </div>
</div>
</div>


<!-- --------------- /COURSE SELECTION TAB --------------- -->

<!-- --------------- NEW COURSE SELECTION TAB --------------- -->

<div id="new-course-selection" class="tabcontent">
    <form action="{{ route('update-student-course', $student->email) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div id="new-course-container">
            <div class="row mb-3 degree-row">
                <div class="col">
                    <label for="degree_id" class="form-label small text-muted">Degree <span class="text-danger">*</span></label>
                    <select name="degree_id_opt" id="degree_id_opt" class="form-control" data-selected="{{ $degree_id_opt ?? '' }}"></select>
                </div>
                <div class="col">
                    <label for="specialization_id" class="form-label small text-muted">Specialization <span class="text-danger">*</span></label>
                    <select name="specialization_id_opt" id="specialization_id_opt" class="form-control" data-selected="{{ $specialization_id_opt ?? '' }}"></select>
                </div>
            </div>
        </div>
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <div class="container mb-0 mt-5">
        <div class="row text-center">
            <div class="col col-md-6 mt-2 mb-3">
                <span class="nav-link active" onclick="openTab(event, 'course-selection')">
                    <i class="bi bi-arrow-left"></i> Previous
                </span>
            </div>

            <div class="col col-md-6 mt-2 mb-3">
                <span class="nav-link" onclick="openTab(event, 'address')">
                    <i class="bi bi-arrow-right"></i> Next
                </span>
            </div>
        </div>
    </div>
</div>
<br>

<!-- --------------- /NEW COURSE SELECTION TAB --------------- -->


<!-- --------------- ADDRESS TAB --------------- -->
<div id="address" class="tabcontent">
    <form action="{{ route('update-student-address', $student->email) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div id="address">
            <div class="mb-3">
                <label>Street/Lane<span style="color: red;">*</span></label>
                <input type="text" id="street" name="street" value="{{ $student->street ?? '' }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Country<span style="color: red;">*</span></label>
                <select id="country_id" name="country_id" class="form-control" required></select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>State<span style="color: red;">*</span></label>
                    <select id="state_id" name="state_id" class="form-control" required></select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>District<span style="color: red;">*</span></label>
                    <select id="district_id" name="district_id" class="form-control" required></select>
                </div>
            </div>
            <div class="mb-3">
                <label>PIN Code<span style="color: red;">*</span></label>
                <input type="text" name="pin" id="pin" class="form-control" value="{{ $student->pin ?? '' }}" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary ">Save</button>
            </div>
        </div>
    </form>
    <div class="container mb-0 mt-5">
        <div class="row text-center">
            <div class="col col-md-6 mt-2 mb-3">
                <span class="nav-link active" onclick="openTab(event, 'course-selection')">
                    <i class="bi bi-arrow-left"></i> Previous
                </span>
            </div>

            <div class="col col-md-6 mt-2 mb-3">
                <span class="nav-link" onclick="openTab(event, 'upload-document')">
                    <i class="bi bi-arrow-right"></i> Next
                </span>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<!-- --------------- /ADDRESS TAB --------------- -->
<!-- --------------- UPLOAD DOCUMENT TAB --------------- -->
<div id="upload-document" class="tabcontent">
    <div class="loader-container" id="loading-screen">
        <div class="loader"></div>
    </div>
    <form action="{{ route('update-student-document', $student->email) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="loader-container" id="loading-screen">
            <div class="loader"></div>
        </div>


        <div id="upload-document">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Photo</label>
                    <input type="file" id="photo_input" value="{{ $student->photo ?? '' }}" class="form-control" required>
                    <input type="hidden" name="photo" id="photo" required>

                </div>
                <div class="col-md-6 mb-3">
                    <img id="photo_preview"
                        src="{{ asset('storage/uploads/photos/thumb-' . $student->photo) }}"
                        alt="Photo Preview"
                        class="img-thumbnail" width="150">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Signature</label>
                    <input type="file" id="signature_input" value="{{ $student->signature ?? '' }}" class="form-control" required>
                    <input type="hidden" name="signature" id="signature" required>

                </div>
                <div class="col-md-6 mb-3">
                    <img id="signature_preview"
                        src="{{ asset('storage/uploads/signatures/thumb-' . $student->signature) }}"
                        alt="Signature Preview"
                        class="img-thumbnail" width="150">
                </div>
            </div>
            <!-- Modal for Image Cropping -->
            <div id="cropModal" style="display: none;">
                <div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.8); display: flex; justify-content: center; align-items: center;">
                    <div style="background: white; padding: 20px; border-radius: 10px; width: 80%; max-width: 900px; text-align: center;">
                        <h3>Crop Image</h3>
                        <img id="cropperImage" style="max-width: 100%;">
                        <br><br>
                        <button type="button" id="cropImage" class="btn btn-success">Crop & Save</button>
                        <button type="button" id="closeCropper" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary ">Submit Application</button>
            </div>
        </div>
    </form>
    <div class="container mb-0 mt-5">
        <div class="row text-center">
            <div class="col col-md-6 mt-2 mb-3">
                <span class="nav-link " onclick="openTab(event, 'address')">
                    <i class="bi bi-arrow-left"></i> Previous
                </span>
            </div>
        </div>
    </div>
</div>
<!-- --------------- /UPLOAD DOCUMENT TAB --------------- -->

</div>
</div>
</div>
</div>
</div>




<!-- ---------------------------------------------------------------------------------------------------------- -->

<script src="{{ asset('js/togglePassword.js') }}"></script>
<script src="{{ asset('js/imageCrop.js') }}"></script>
<script src="{{ asset('js/viewFullimage.js') }}"></script>
<!-- -------------------------------------------------------------------------------------------------- -->
<script>
    let photoInput = document.getElementById("photo_input");
    if (photoInput) {
        photoInput.addEventListener("change", function() {
            previewImage(this, "photo_preview", "{{ asset('storage/uploads/photos/thumb-' . $student->photo) }}");
        });
    }
    let signatureInput = document.getElementById("signature_input");
    if (signatureInput) {
        signatureInput.addEventListener("change", function() {
            previewImage(this, "signature_preview", "{{ asset('storage/uploads/signatures/thumb-' . $student->signature) }}");
        });
    }
</script>
<script>

$(document).ready(function () {
loadDegrees(student);
loadSpecializations(student);
console.log("reached");
    function loadDegrees(student) {
        console.log("inside the function");
        return $.ajax({
            url: '/degrees',
            type: 'GET',
            success: function (response) {
                $("#degree_id").html(response);
                $("#degree_id_opt").html(response);
                if (student.degree_id) {
                    $("#degree_id").val(student.degree_id).change();
                    $("#degree_id_opt").val(student.degree_id_opt).change();
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading genders:", error);
            }
        });
    }
    function loadSpecializations(student) {
        console.log("inside the function");
        return $.ajax({
            url: '/specializations',
            type: 'GET',
            success: function (response) {
                $("#specialization_id").html(response);
                $("#specialization_id_opt").html(response);
                if (student.specialization_id) {
                    $("#specialization_id").val(student.specialization_id).change();
                    $("#specialization_id_opt").val(student.specialization_id_opt).change();
                }
            },
            error: function (xhr, status, error) {
                console.error("Error loading genders:", error);
            }
        });
    }
});


    function showLoader() {
        document.getElementById("loading-screen").style.visibility = "visible";
    }

    function hideLoader() {
        document.getElementById("loading-screen").style.visibility = "hidden";
    }

    window.onload = hideLoader; // Hide loader after page loads

    document.querySelector("form")?.addEventListener("submit", function() {
        showLoader(); // Show loader on form submit
    });
</script>
<!-- ---------------------------------------------------------------------------------------------------------- -->
@include('layouts.footer')