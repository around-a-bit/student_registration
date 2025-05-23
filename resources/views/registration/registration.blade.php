<!DOCTYPE html>
<html lang="en">
@include('layouts.updateHeader')
<script src="{{ asset('js/script.js') }}"></script>


<button class="tablink" onclick="openPage('Home', this, 'red')">Home</button>
<button class="tablink" onclick="openPage('News', this, 'green')" id="defaultOpen">News</button>


<!-- =================================== FORM START =================================== -->
<form action="{{ route('registration.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- --------------- COURSE SELECTION TAB --------------- -->
    <div id="course-selection" class="tab-content active">
    <div id="educationFields">
        <div class="mb-3">
            <label>Student UID<span style="color: red;">*</span></label>
            <input type="text" name="uid[]" value="{{ old('uid.0') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Degree<span style="color: red;">*</span></label>
            <select id="degree_id" name="degree_id[]" class="form-control" required></select>
        </div>
        <div class="mb-3">
            <label>Specialization<span style="color: red;">*</span></label>
            <select id="specialization_id" name="specialization_id[]" class="form-control" required></select>
        </div>
        <div class="mb-3">
            <label>University<span style="color: red;">*</span></label>
            <select id="school_id" name="school_id[]" class="form-control" required></select>
        </div>
        </div>
       
        <div class="col-md-6 mb-3">
        <button type="button" class="btn btn-secondary" onclick="addMore()">Add More</button>
        </div>
        
        
        <div class="tab-navigation">
            <button type="button" class="btn btn-primary next-tab">Next</button>
        </div>

    </div>
    <!-- ====================================================================== -->
    <script>
function addMore() {
    let index = document.querySelectorAll('.edu-group').length;
    let div = document.createElement("div");
    div.classList.add("edu-group", "mb-3");
    div.innerHTML = `
    <hr>
        <div class="mb-3">
            <label>Student UID<span style="color: red;">*</span></label>
            <input type="text" name="uid[]" value="{{ old('uid.${index}') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Degree<span style="color: red;">*</span></label>
            <select id="degree_id" name="degree_id[]" class="form-control" required></select>
        </div>
        <div class="mb-3">
            <label>Specialization<span style="color: red;">*</span></label>
            <select id="specialization_id" name="specialization_id[]" class="form-control" required></select>
        </div>
        <div class="mb-3">
            <label>University<span style="color: red;">*</span></label>
            <select id="school_id" name="school_id[]" class="form-control" required></select>
        </div>
        


    
          
        <button type="button" class="btn btn-danger btn-sm remove-group" onclick="removeGroup(this)">Remove</button>
           
       



    `;
    document.getElementById("educationFields").appendChild(div);
    loadNewDropdowns(div);

}
function removeGroup(button) {
    button.parentElement.remove(); 
}
</script>



    <!-- --------------- /COURSE SELECTION TAB --------------- -->
    <!-- --------------- BASIC DETAILS TAB --------------- -->
    <div id="basic-details" class="tab-content">
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
        <div class="mb-3">
            <label>Gender<span style="color: red;">*</span></label>
            <select id="gender_id" name="gender_id" class="form-control" required>
                <option value="{{ old('gender_id') }}">"{{old('gender_name')}}"</option>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Email<span style="color: red;">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Mobile Number<span style="color: red;">*</span></label>
                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" required>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label>Date of Birth<span style="color: red;">*</span></label>
            <input type="date" name="dob" value="{{ old('dob') }}" class="form-control" required>
        </div>
        <div class="tab-navigation">
            <button type="button" class="btn btn-secondary prev-tab">Previous</button>
            <button type="button" class="btn btn-primary next-tab">Next</button>
        </div>
    </div>

    
    <!-- --------------- /BASIC DETAILS TAB --------------- -->
    <!-- --------------- ADDRESS TAB --------------- -->
    <div id="address" class="tab-content">
    <div class="mb-3">
            <label>Street/Lane<span style="color: red;">*</span></label>
            <input type="text" id="street" name="street" value="{{ old('street') }}" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Country<span style="color: red;">*</span></label>
            <select id="country_id" name="country_id" class="form-control"></select>
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
            <input type="text" name="pin" value="{{ old('pin') }}" class="form-control" required>
        </div>
        <div class="tab-navigation">
            <button type="button" class="btn btn-secondary prev-tab">Previous</button>
            <button type="button" class="btn btn-primary next-tab">Next</button>
        </div>
    </div>
    <!-- --------------- /ADDRESS TAB --------------- -->
    <!-- --------------- UPLOAD DOCUMENT TAB --------------- -->
    <div id="upload-document" class="tab-content">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Photo<span style="color: red;">*</span></label>
                <input type="file" id="photo_input" class="form-control" required>
                <input type="hidden" name="photo" id="photo">
            </div>
            <div class="col-md-6 mb-3">
                <img id="photo_preview" src="#" alt="Photo Preview" class="img-thumbnail d-none" width="150">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Signature<span style="color: red;">*</span></label>
                <input type="file" id="signature_input" class="form-control" required>
                <input type="hidden" name="signature" id="signature">
            </div>
            <div class="col-md-6 mb-3">
                <img id="signature_preview" src="#" alt="Signature Preview" class="img-thumbnail d-none" width="150">
            </div>
        </div>
        <!-- Modal for Image Cropping -->
        <div id="cropModal" style="display: none;">
            <div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.8); display: flex; justify-content: center; align-items: center;">
                <div style="background: white; padding: 20px; border-radius: 10px; width: 80%; max-width: 500px; text-align: center;">
                    <h3>Crop Image</h3>
                    <img id="cropperImage" style="max-width: 100%;">
                    <br><br>
                    <button type="button" id="cropImage" class="btn btn-success">Crop & Save</button>
                    <button type="button" id="closeCropper" class="btn btn-danger">Cancel</button>
                </div>
            </div>
        </div>
        <div class="tab-navigation">
            <button type="button" class="btn btn-secondary prev-tab">Previous</button>
            <button type="button" class="btn btn-primary next-tab">Next</button>
        </div>
    </div>
    <!-- --------------- /UPLOAD DOCUMENT TAB --------------- -->
    <!-- --------------- SET PASSWORD TAB --------------- -->
    <div id="set-password" class="tab-content">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Password<span style="color: red;">*</span></label>
                <input type="password" id="password" name="password" class="form-control" required>
                <i class="fa-solid fa-eye-slash" onclick="togglePassword('password', 'eye-icon1')" id="eye-icon1"></i>
            </div>
            <div class="col-md-6 mb-3">
                <label>Confirm Password<span style="color: red;">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                <i class="fa-solid fa-eye-slash" onclick="togglePassword('password_confirmation', 'eye-icon2')" id="eye-icon2"></i>
            </div>
        </div>
        <div class="tab-navigation">
            <div class="tab-navigation">
                <button type="button" class="btn btn-secondary prev-tab">Previous</button>
            </div>
        </div>
        <div class="text-center">
            <button class="btn btn-primary w-50 " type="submit">Submit Form</button>
        </div>
    </div>
    <!-- --------------- /SET PASSWORD TAB --------------- -->
</form>
<!-- =================================== /FORM END =================================== -->
</div>
</div>
</div>
</div>
</div>
<script src="{{ asset('js/togglePassword.js') }}"></script>
<script src="{{ asset('js/imageCrop.js') }}"></script>
<script src="{{ asset('js/viewFullimage.js') }}"></script>


<!-- ---------------------------------------------------------------------------------------------------------- -->

<!-------------------------------------------- -->
<script>
    document.getElementById("photo_input").addEventListener("change", function() {
        previewImage(this, "photo_preview");
    });
    document.getElementById("signature_input").addEventListener("change", function() {
        previewImage(this, "signature_preview");
    });
</script>
<!-- ---------------------------------------------------------------------------------------------------------- -->
@include('layouts.footer')