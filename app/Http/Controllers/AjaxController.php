<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Specialization;
use App\Models\Degree;
use App\Models\State;
use App\Models\Gender;
use App\Models\School;
use App\Models\District;
use App\Models\Student;
use App\Models\Academic;
use App\Models\Fees;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class AjaxController extends Controller
{


    // --------------------------------------------------------------------------------------------------------

    public function feesStructure()
    {
        $results = Fees::feesStructure();
        $options = "<option value=''>Select Fees Type</option>";

        foreach ($results as $result) {
            $options .= "<option value='{$result->id}'>{$result->structure_name}</option>";
        }

        return $options;
    }

    public function feesStructureAmount(Request $request){
        // Log::info("In the feesStructureAmount ajaxcontroller function");
        $fees_structure_id = $request->input('fees_structure_id');
        $amount = Fees::getAmount($fees_structure_id);
        return $amount;
    }

    public function forSchedule(Request $request)
    {
        $academic_id = $request->input('academic_id');
        $semester_id = $request->input('semester_id');
        $specialization_id = $request->input('specialization_id');
        $check = Fees::forSchedule($academic_id, $semester_id, $specialization_id);
        // Log::info("check in controller: ", (array) $check);
        if ($check) {
            return $check;
        }
        return false;
    }

    public function FnameData(Request $request)
    {
        $search_item = $request->input('query');
        $students = Student::getFname($search_item);
        return response()->json($students);
    }

    public function getGenders()
    {
        $genders = Gender::getAllGenders();
        $genderId = session('gender_id');
        $options = "<option value=''>Select Gender</option>";

        foreach ($genders as $gender) {
            $selected = ($genderId == $gender->id) ? " selected" : "";
            $options .= "<option value='{$gender->id}'{$selected}>{$gender->name}</option>";
        }

        return $options;
    }

    // --------------------------------------------------------------------------------------------------------
    // public function getAcademicYear()
    // {
    //     $academics = Academic::getAllAcademicYear();
    //     $academicId = session('academic_id');
    //     $options = "<option value=''>Select Academic Year</option>";

    //     foreach ($academics as $academic) {
    //         $selected = ($academicId == $academic->id) ? " selected" : "";
    //         $options .= "<option value='{$academic->id}'{$selected}>{$academic->name}</option>";
    //     }

    //     return $options;
    // }
    public function getAcademicYear()
    {
        $academics = Academic::getAllAcademicYear();
        $academicId = session('academic_id'); // Or you can customize this

        $options = "<option value=''>Select Academic Year</option>";

        foreach ($academics as $academic) {
            $selected = ($academic->id == $academicId) ? "selected" : "";
            $options .= "<option value='{$academic->id}' {$selected}>{$academic->name}</option>";
        }

        return response($options);
    }

    // --------------------------------------------------------------------------------------------------------
    public function getFeesType()
    {
        $feess = Fees::getAllFeesType();
        $feesId = session('fees_head_id');
        $options = "<option value=''>Select Fees Type</option>";

        foreach ($feess as $fees) {
            $selected = ($feesId == $fees->id) ? " selected" : "";
            $options .= "<option value='{$fees->id}'{$selected}>{$fees->name}</option>";
        }

        return $options;
    }

    // --------------------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------------------
    public function getFeesDetails(Request $request)
    {
        $academic_id = $request->academic_id;
        $specialization_id = $request->specialization_id;

        $result  = Fees::getAllFeesDetails($academic_id, $specialization_id);
        return $result;
    }

    // --------------------------------------------------------------------------------------------------------

    public function getDegrees()
    {
        $degrees = Degree::getAllDegrees();
        $options = "<option value=''>Select</option>";

        foreach ($degrees as $degree) {
            $options .= "<option value='{$degree->id}'>{$degree->name}</option>";
        }
        return $options;
    }
    // --------------------------------------------------------------------------------------------------------

    public function getSpecializations()
    {
        $specializations = Specialization::getAllSpecializations();
        $options = "<option value=''>Select</option>";
        $specializationId = session('specialization_id');

        foreach ($specializations as $specialization) {
            $selected = ($specializationId == $specialization->id) ? " selected" : "";
            $options .= "<option value='{$specialization->id}'{$selected}>{$specialization->name}</option>";
        }
        return $options;
    }
    // --------------------------------------------------------------------------------------------------------

    public function getSemesters()
    {
        $semesters = Fees::getAllSemesters();
        $semesterId = session('semester_id');
        $options = "<option value=''>Select Semester</option>";

        foreach ($semesters as $semester) {
            $selected = ($semesterId == $semester->id) ? " selected" : "";
            $options .= "<option value='{$semester->id}'{$selected}>{$semester->name}</option>";
        }
        return $options;
    }
    // --------------------------------------------------------------------------------------------------------

    public function getSchools()
    {
        $schools = School::getAllSchools();
        $selectedSchoolId = session('school_id');

        $options = "<option value=''>Select collage/University</option>";

        foreach ($schools as $school) {
            $selected = ($selectedSchoolId == $school->id) ? "selected" : "";
            $options .= "<option value='{$school->id}' {$selected}>{$school->name}</option>";
        }

        return $options;
    }
    // --------------------------------------------------------------------------------------------------------
    // Fetch countries for the first dropdown
    public function getCountries()
    {
        $countries = Country::getAllCountries();
        $countryId = session('country_id');
        $options = "<option value=''>Select</option>";

        foreach ($countries as $country) {
            $selected = ($countryId == $country->id) ? " selected" : "";
            $options .= "<option value='{$country->id}' {$selected}>{$country->name}</option>";
        }

        return $options;

        // return response()->json($options);
    }

    // Fetching states based on selected country_id
    public function getStates($country_id)
    {
        $options = "<option value=''>Select State</option>";
        if ($country_id) {
            $states = State::getAllStates($country_id);
            $stateId = session('state_id');

            foreach ($states as $state) {
                $selected = ($stateId == $state->id) ? " selected" : "";
                $options .= "<option value='{$state->id}'{$selected}>{$state->name}</option>";
            }
        }
        return $options;
    }


    // Fetching districts based on selected state_id
    public function getDistricts($state_id)
    {
        $options = "<option value=''>Select district</option>";
        if ($state_id) {
            $districts = District::getAllDistricts($state_id);
            $districtId = session('district_id');

            foreach ($districts as $district) {
                $selected = ($districtId == $district->id) ? " selected" : "";
                $options .= "<option value='{$district->id}'{$selected}>{$district->name}</option>";
            }
        }
        return $options;
    }

    // --------------------------------------------------------------------------------------------------------

    public function editRegistrationFormShowStudent($id)
    {
        $student = Student::getStudentAllData("id", $id);
        // dd($student);
        $title = 'DCG Registration';
        return view('registration.editRegistration', compact('student', 'title'));
    }

    public function editRegistrationFormShowAdmin($id)
    {
        $student = Student::getStudentAllData("id", $id);
        // dd($student);
        $title = 'Update by Admin';
        return view('registration.editRegistrationAdmin', compact('student', 'title'));
    }

    // --------------------------------------------------------------------------------------------------------

    public function updateStudent($email, Request $request)
    {


        $student = Student::where('email', $email)->firstOrFail();

        try {
            // Validate the request data

            $validateBasicDetails = $request->validate([

                'degree_id_opt' => 'nullable|integer',
                'specialization_id_opt' => 'nullable|integer'
            ]);
            $table = 'students_course';
            Student::updateDetailsbyAdmin($email, $validateBasicDetails, $table);



            $validateBasicDetails = $request->validate([

                'gender_id' => 'nullable|integer',
                'dob' => 'nullable|date'
            ]);
            $table = 'basic';
            Student::updateDetailsbyAdmin($email, $validateBasicDetails, $table);

            $validateAcademicDetails = $request->validate([

                'uid' => 'nullable|array',
                'uid.*' => ['nullable', 'string', 'distinct'],
                'degree_id' => 'nullable|array',
                'degree_id.*' => 'nullable|integer',
                'degree_id_opt' => 'nullable|integer',
                'specialization_id' => 'nullable|array',
                'specialization_id.*' => 'nullable|integer',
                'specialization_id_opt' => 'nullable|integer',
                'school_id' => 'nullable|array',
                'school_id.*' => 'nullable|integer'
            ]);

            $table = 'academic';
            Student::updateDetailsbyAdmin($email, $validateAcademicDetails, $table);

            $validateAddressDetails = $request->validate([

                'country_id' => 'nullable|integer',
                'state_id' => 'nullable|integer',
                'district_id' => 'nullable|integer',
                'pin' => 'nullable|string|max:6',
                'street' => 'nullable|string'
            ]);
            $table = 'address';
            Student::updateDetailsbyAdmin($email, $validateAddressDetails, $table);




            $photoFile = $this->convertBase64ToFile($request->photo, 'photo.png');
            $signatureFile = $this->convertBase64ToFile($request->signature, 'signature.png');
            $request->merge([
                'photo' => $photoFile,
                'signature' => $signatureFile
            ]);

            $validatedDocumentData = $request->validate([

                'photo' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
                'signature' => 'nullable|file|mimes:jpeg,png,jpg|max:10240'
            ]);
            $validatedDocumentData = $request->validate([
                'photo' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
                'signature' => 'nullable|file|mimes:jpeg,png,jpg|max:10240'
            ]);
            $timestamp = now()->timestamp;

            $pictures = Student::getPhotoSignatureName($email);
            $uidValue = Student::getuid($student->id);

            $photoName = $pictures->photo ?? null;
            $signatureName = $pictures->signature ?? null;

            if ($photoFile) {
                if ($photoName) {
                    $oldPhotoPath = "uploads/photos/{$photoName}";
                    $oldThumbnailPath = "uploads/photos/thumb-{$photoName}";
                    if (Storage::disk('public')->exists($oldPhotoPath)) {
                        Storage::disk('public')->delete($oldPhotoPath);
                    }
                    if (Storage::disk('public')->exists($oldThumbnailPath)) {
                        Storage::disk('public')->delete($oldThumbnailPath);
                    }
                }

                $photoExt = $photoFile->getClientOriginalExtension();
                $newPhotoName = "{$uidValue->uid}-{$timestamp}.{$photoExt}";

                $photoPath = $photoFile->storeAs('uploads/photos', $newPhotoName, 'public');
                $photoThumbnailName = "thumb-{$newPhotoName}";
                $photoThumbnailPath = public_path("storage/uploads/photos/{$photoThumbnailName}");

                File::ensureDirectoryExists(dirname($photoThumbnailPath), 0755, true);

                Image::make(public_path("storage/{$photoPath}"))
                    ->resize(200, 200)
                    ->save($photoThumbnailPath);

                $validatedDocumentData['photo'] = $newPhotoName;
            }

            if ($signatureFile) {
                if ($signatureName) {
                    $oldSignaturePath = "uploads/signatures/{$signatureName}";
                    $oldSignatureThumbnailPath = "uploads/signatures/thumb-{$signatureName}";
                    if (Storage::disk('public')->exists($oldSignaturePath)) {
                        Storage::disk('public')->delete($oldSignaturePath);
                    }
                    if (Storage::disk('public')->exists($oldSignatureThumbnailPath)) {
                        Storage::disk('public')->delete($oldSignatureThumbnailPath);
                    }
                }

                $signatureExt = $signatureFile->getClientOriginalExtension();
                $newSignatureName = "{$uidValue->uid}-{$timestamp}.{$signatureExt}";

                $signaturePath = $signatureFile->storeAs('uploads/signatures', $newSignatureName, 'public');
                $signatureThumbnailName = "thumb-{$newSignatureName}";
                $signatureThumbnailPath = public_path("storage/uploads/signatures/{$signatureThumbnailName}");

                File::ensureDirectoryExists(dirname($signatureThumbnailPath), 0755, true);

                Image::make(public_path("storage/{$signaturePath}"))
                    ->resize(300, 100)
                    ->save($signatureThumbnailPath);

                $validatedDocumentData['signature'] = $newSignatureName;
            }
            $student->update([
                'photo' => $validatedDocumentData['photo'] ?? $photoName,
                'signature' => $validatedDocumentData['signature'] ?? $signatureName,
            ]);

            $table = 'document';
            Student::updateDetailsbyAdmin($email, $validatedDocumentData, $table);


            $success = 'Update Successful!';
            $title = 'Admin Panel';
            return redirect()->route('admin.panel', ['success' => $success, 'title' => $title]);
        } catch (ValidationException $e) {
            Log::info('ValidationException');
            echo "ValidationException: " . $e->getMessage();
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        } catch (\Exception $e) {
            Log::info('\Exception');
            echo "\Exception: " . $e->getMessage();
            Log::error('Update failed', ['id' => $student->id, 'error_message' => $e->getMessage()]);
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        }
    }

    private function convertBase64ToFile($base64String, $fileName)
    {
        if (strpos($base64String, 'data:image') === false) {
            return null;
        }

        $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64String));
        $tempPath = tempnam(sys_get_temp_dir(), 'img');
        file_put_contents($tempPath, $fileData);

        return new \Illuminate\Http\UploadedFile($tempPath, $fileName, 'image/png', null, true);
    }

    // --------------------------------------------------------------------------------------------------------
    public function deleteAccount($email)
    {
        DB::beginTransaction();

        try {
            $student = Student::where('email', $email)->firstOrFail();


            if ($student->photo) {
                Log::info('Deleting student photo');
                Storage::disk('public')->delete([
                    "uploads/photos/{$student->photo}",
                    "uploads/photos/thumb-{$student->photo}"
                ]);
            }


            if ($student->signature) {
                Log::info('Deleting student signature');
                Storage::disk('public')->delete([
                    "uploads/signatures/{$student->signature}",
                    "uploads/signatures/thumb-{$student->signature}"
                ]);
            }

            DB::table('student_basic_details')->where('id', $student->student_basic_details_id)->delete();
            DB::table('student_address_details')->where('id', $student->student_address_details_id)->delete();
            DB::table('student_education_details')->where('id', $student->student_education_details_id)->delete();

            $student->delete();
            Log::info('Student record deleted', ['email' => $email]);

            DB::commit();

            // Logout student and redirect accordingly
            if (Session::get('user') == 'student') {
                Session::flush();
                return redirect()->route('welcome')->with(['delete_message' => 'Account deleted successfully!', 'title' => 'Welcome']);
            } else {
                return redirect()->route('admin.panel')->with(['delete_message' => 'Student data deleted successfully!', 'title' => 'Admin Panel']);
            }
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback in case of failure
            Log::error('Account deletion failed', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => 'Failed to delete account.']);
        }
    }

    // --------------------------------------------------------------------------------------------------------
}

// --------------------------------------------------------------------------------------------------------
