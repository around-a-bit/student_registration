<?php

namespace App\Http\Controllers;

use App\Models\Student_registration;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\PasswordResetMail;
use App\Mail\VerifyEmailMail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\RegistrationSuccessMail;
use App\Models\Gender;
use Illuminate\Support\Facades\Storage;
use App\Models\Fees;
use App\Models\Degree;
use App\Models\Semester;
use App\Models\FeesHead;
use App\Models\Academic;
use App\Models\FeesStructure;
use Illuminate\Console\View\Components\Alert;

class AppController extends Controller
{
    public function index()
    {
        $title = 'Home';
        return view('welcome', compact('title'));
    }
    // -----------------------------    opening the aboutus page    ---------------------------------------------------------------------------
    public function aboutUs()
    {
        $title = 'About US';
        return view('aboutUs', compact('title'));
    }
    // ---------------------------------------- opening the contact us page ----------------------------------------------------------------
    public function contactUs()
    {
        $title = 'Contact Us';
        return view('contactUs', compact('title'));
    }

    // ================================== Pre email verification ==============================================================

    public function emailVerificationPre(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|email|unique:students,email'
            ]);
            $email = $validatedData['email'];
            $otp = rand(1000, 9999);
            $token = bin2hex(random_bytes(32));

            DB::table('students')->updateOrInsert(
                ['email' => $email],
                [
                    'otp' => $otp,
                    'token' => $token,
                ]
            );
            Mail::to($email)->send(new VerifyEmailMail($otp));
            $success = 'OTP mail has been sent in you Email.';
            $title = 'DCG';

            return redirect()->route('email.verification.post', ['token' => $token, 'title' => $title, 'success' => $success, 'email' => $email]);
        } catch (ValidationException $e) {
            $error = $e->getMessage();
            $title = 'DCG';
            return (view('registration.emailVerification', compact('title', 'error', 'email', 'token')));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Log::error('Registration failed', ['error_message' => $e->getMessage()]);
            $title = 'DCG';
            return (view('registration.emailVerification', compact('title', 'error', 'email', 'token')));
        }
    }

    // ================================== Verifying the email using token and otp ==============================================================

    public function emailVerificationPost(Request $request)
    {
        try {
            $title = 'DCG';
            $error = 'Invalid OTP!';
            $email = $request->input('email');
            $token = $request->input('token');
            $validated = $request->validate([
                'otp' => 'required|max:4|min:4'
            ]);
            $record = DB::table('students')->where('email', $email)->where('token', $token)->where('otp', $validated['otp'])->first();
            if (!$record) {
                return redirect()->route('email.verification.post', ['error' => "Invalid OTP or expired token.", 'title' => 'DCG']);
            }

            return view('registration.loginDetails', compact('email', 'title'));
        } catch (ValidationException $e) {
            return view('registration.loginOTP', compact('email', 'error', 'title', 'token'));
        } catch (\Exception $e) {

            Log::error('Registration failed', ['error_message' => $e->getMessage()]);
            return view('registration.loginOTP', compact('email', 'error', 'title', 'token'));
        }
    }
    // ================================== Storing student's data during the first registration by the student ==============================================================
    public function loginStore(Request $request)
    {
        try {
            $title = 'DCG';
            $email = $request->input('email');
            $validatedData = $request->validate([
                'fname' => 'required|string|max:255',
                'lname' => 'required|string|max:255',
                'email' => 'required|email',
                'mobile' => 'required|digits:10',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $validatedData['password'] = hash('sha256', $validatedData['password']);

            $status = Student_registration::registerStudent($validatedData);
            if ($status) {

                Log::info('Validated Data:', (array) $validatedData);
                return redirect()->route("welcome", ['success' => 'Registration Successful!']);
            }
            $error = 'Data not inserted!';
            return view('registration.loginDetails', compact('email', 'title', 'error'));
        } catch (ValidationException $e) {
            $error = $e->validator->errors()->first();
            Log::error('Registration failed', ['error_message' => (array) $error]);
            return view('registration.loginDetails', compact('email', 'title', 'error'));
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error_message' => $e->getMessage()]);
            $error = $e->getMessage();
            return view('registration.loginDetails', compact('email', 'title', 'error'));
        }
    }

    // ================================== Updating Student Basic details by the student ==============================================================
    public function updateRegistrationDataBasic($email, Request $request)
    {

        try {
            $student = Student::where('email', $email)->firstOrFail();
            Log::info("in the updateRegistrationDataBasic function");
            $validatedData = $request->validate([
                'gender_id' => 'required|integer',
                'dob' => 'required|date'
            ]);
            $table = 'basic';

            Student::updateDetails($email, $validatedData, $table);
            $success = 'Basic Details Saved!';
            $title = 'Student Panel';
            return redirect()->route('edit-student', ['success' => $success, 'id' => $student->id, 'title' => $title]);
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


    // ================================== Updating Student Selected Previous Academic Details by the student ==============================================================
    public function updateRegistrationDataAcademic($email, Request $request)
    {
        try {
            Log::info("in the updateRegistrationDataAcademic function");
            $student = Student::where('email', $email)->firstOrFail();
            $validatedData = $request->validate([
                'uid' => 'required|array',
                'uid.*' => ['required', 'string', 'distinct'],
                'degree_id' => 'required|array',
                'degree_id.*' => 'required|integer',
                'specialization_id' => 'required|array',
                'specialization_id.*' => 'required|integer',
                'school_id' => 'required|array',
                'school_id.*' => 'required|integer'
            ]);
            $table = 'academic';

            Student::updateDetails($email, $validatedData, $table);
            $success = 'Academic Details Saved!';
            $title = 'Student Panel';
            return redirect()->route('edit-student', ['success' => $success, 'id' => $student->id, 'title' => $title]);
        } catch (ValidationException $e) {
            echo "ValidationException: " . $e->getMessage();
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        } catch (\Exception $e) {
            echo "\Exception: " . $e->getMessage();
            Log::error('Update failed', ['id' => $student->id, 'error_message' => $e->getMessage()]);
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        }
    }


    // ================================== Updating Student Selected Course(Specialization) by the student ==============================================================
    public function updateRegistrationDataCourse($email, Request $request)
    {
        try {
            Log::info("in the updateRegistrationDataCourse function");
            $student = Student::where('email', $email)->firstOrFail();
            $validatedData = $request->validate([
                'degree_id_opt' => 'required|integer',
                'specialization_id_opt' => 'required|integer'
            ]);
            $table = 'students_course';
            $id = Student::updateDetails($email, $validatedData, $table);
            if ($id) {
                $success = 'Academic Details Saved!';
                $title = 'Student Panel';
                return redirect()->route('edit-student', ['success' => $success, 'id' => $student->id, 'title' => $title]);
            }
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => 'Something wrong', 'title' => 'Update']);
        } catch (ValidationException $e) {
            echo "ValidationException: " . $e->getMessage();
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        } catch (\Exception $e) {
            echo "\Exception: " . $e->getMessage();
            Log::error('Update failed', ['id' => $student->id, 'error_message' => $e->getMessage()]);
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        }
    }

    // ================================== Updating Student Address by the student ==============================================================
    public function updateRegistrationDataAddress($email, Request $request)
    {
        try {
            $student = Student::where('email', $email)->firstOrFail();
            $validatedData = $request->validate([
                'country_id' => 'required|integer',
                'state_id' => 'required|integer',
                'district_id' => 'required|integer',
                'pin' => 'required|string|max:6',
                'street' => 'required|string'
            ]);
            $table = 'address';

            Student::updateDetails($email, $validatedData, $table);
            $success = 'Address Details Saved!';
            $title = 'Student Panel';
            return redirect()->route('edit-student', ['success' => $success, 'id' => $student->id,  'title' => $title]);
        } catch (ValidationException $e) {
            echo "ValidationException: " . $e->getMessage();
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        } catch (\Exception $e) {
            echo "\Exception: " . $e->getMessage();
            Log::error('Update failed', ['id' => $student->id, 'error_message' => $e->getMessage()]);
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        }
    }

    // ================================== Updating Student Document by the student ==============================================================
    public function updateRegistrationDataDocument($email, Request $request)
    {
        try {
            Log::info('In the updateRegistrationDataDocument function');
            $student = Student::where('email', $email)->first();
            $fname = $student->fname;

            $photoFile = $this->convertBase64ToFile($request->photo, 'photo.png');
            $signatureFile = $this->convertBase64ToFile($request->signature, 'signature.png');
            $request->merge([
                'photo' => $photoFile,
                'signature' => $signatureFile
            ]);
            // Validate the request data
            $validatedData = $request->validate([
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

                $validatedData['photo'] = $newPhotoName;
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

                $validatedData['signature'] = $newSignatureName;
            }
            $student->update([
                'photo' => $validatedData['photo'] ?? $photoName,
                'signature' => $validatedData['signature'] ?? $signatureName,
            ]);
            $table = 'document';
            $validatedData['registration_no'] = Student_registration::generateRegistrationNo();

            Student::updateDetails($email, $validatedData, $table);
            Mail::to($email)->send(new RegistrationSuccessMail($fname, $validatedData['registration_no']));
            $success = 'Registration Successful!';
            $title = 'Student Panel';
            return redirect()->route('student.page', ['success' => $success, 'id' => $student->id, 'title' => $title]);
        } catch (ValidationException $e) {
            echo "ValidationException: " . $e->getMessage();
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        } catch (\Exception $e) {
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

    // ================================== Updating Student Password by the admin ==============================================================
    public function updateRegistrationDataPassword($email, Request $request)
    {
        Log::info('In the updateRegistrationDataPassword controller function');
        $student = Student::where('email', $email)->firstOrFail();
        try {
            $validatedData = $request->validate([
                'password' => 'nullable|string|min:8|confirmed'
            ]);
            $table = 'password';

            if ($request->filled('password')) {
                $request_password = hash('sha256', $validatedData['password']);

                if ($request_password === $student->password) {
                    return redirect()->route("edit-student", [
                        'id' => $student->id,
                        'error' => 'New password cannot be the old password!'
                    ]);
                }
                $validatedData['password'] = $request_password;
            } else {
                $validated['password'] = $student->password;
            }

            $validatedData['registration_no'] = Student_registration::generateRegistrationNo();

            Student::updateDetails($email, $validatedData, $table);
            $success = 'Password Update Successful!';
            $title = 'Student Panel';
            $url = "http://127.0.0.1:8000/student-login";
            Mail::to($validatedData['email'])->send(new RegistrationSuccessMail($validatedData['fname'], $url, $validatedData['registration_no']));
            return redirect()->route('student.page', ['success' => $success, 'id' => $student->id, 'title' => $title]);
        } catch (ValidationException $e) {
            echo "ValidationException: " . $e->getMessage();
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        } catch (\Exception $e) {
            echo "\Exception: " . $e->getMessage();
            Log::error('Update failed', ['id' => $student->id, 'error_message' => $e->getMessage()]);
            return redirect()->route("edit-student", ['id' => $student->id, 'error' => $e->getMessage(), 'title' => 'Update']);
        }
    }

    // ---------------------------- opening the Admin Fees panel    ----------------------------------------------------------------------------
    public function adminPanel(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $students = Student::getStudentData(null, null)->paginate($perPage);
        $title = 'Admin Panel';
        return view("admin.adminPanel", compact('students', 'title'));
    }

    // ------------------------------ opening the Admin Fees panel -------------------------------------------------------------------------
    public function adminFeesPanel(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $title = 'Admin Fees Panel';
        $query = FeesStructure::with([
            'feesDetails.feesHead',
            'academicYear:id,name',
            'course:id,name',
            'semester:id,name',
        ])->orderBy('created_at', 'desc');

        if ($request->filled('specialization_id')) {
            Log::info("filled('specialization_id')");
            session()->flash('specialization_id', $request->specialization_id);
            $query->where('course_id', $request->specialization_id);
        }
        if ($request->filled('semester_id')) {
            Log::info("filled('semester_id')");
            session()->flash('semester_id', $request->semester_id);
            $query->where('semester_id', $request->semester_id);
        }
        if ($request->filled('academic_id')) {
            Log::info("filled('academic_id')");
            session()->flash('academic_id', $request->academic_id);
            $query->where('academic_id', $request->academic_id);
        }
        if ($request->filled('min_amount') || $request->filled('max_amount')) {
            session()->flash('min_amount', $request->min_amount);
            session()->flash('max_amount', $request->max_amount);
            $min_amount = $request->input('min_amount') ?? "10000";
            $max_amount = $request->input('max_amount') ?? "100000";
            Log::info('min_amount', (array) $min_amount);
            Log::info('max_amount', (array) $max_amount);

            $query->whereBetween('total_amount', [$min_amount, $max_amount]);
        }
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('course_id', function ($sub) use ($searchTerm) {
                    $sub->where('course_id', 'LIKE', '%' . $searchTerm . '%');
                })
                    ->orWhereHas('academic_id', function ($sub) use ($searchTerm) {
                        $sub->where('academic_id', 'LIKE', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('semester_id', function ($sub) use ($searchTerm) {
                        $sub->where('semester_id', 'LIKE', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('feesDetails.feesHead', function ($sub) use ($searchTerm) {
                        $sub->where('name', 'LIKE', '%' . $searchTerm . '%');
                    })
                    ->orWhereHas('feesDetails', function ($sub) use ($searchTerm) {
                        $sub->where('amount', 'LIKE', '%' . $searchTerm . '%');
                    })
                    ->orWhere('total_amount', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        $feesStructures = $query->paginate($perPage)->withQueryString();
        $courses = Degree::all();
        $semesters = Semester::all();
        $academicYears = Academic::all();
        $feesHeads = FeesHead::all();
        return view("admin.adminFeesPanel", compact('feesStructures', 'courses', 'semesters', 'academicYears', 'feesHeads', 'title'));
    }

    // ------------------------------ Opening Admin Browse Chart section -------------------------------------------------------------------------
    public function adminBrowse(Request $request)
    {

        $title = 'Browse';
        $maleCount = Gender::getGenderCount(1);
        $femaleCount = Gender::getGenderCount(2);
        $thirdCount = Gender::getGenderCount(3);
        return view("admin.adminBrowse", compact('title', 'maleCount', 'femaleCount', 'thirdCount'));
    }

    // ------------------------------ Opening Admin Fees Payments Page -------------------------------------------------------------------------
    public function openFeesPaymentsPanel(Request $request)
    {

        $title = "Fees Payments";
        $perPage = $request->input('perPage', 5);
        $query = DB::table('payment_table as pt')
            ->join('students as s', 'pt.student_id', '=', 's.id')
            ->join('fees_structure as fs', 'pt.fees_structure_id', '=', 'fs.id')
            ->join('degrees as d', 's.degree_id_opt', '=', 'd.id')
            ->join('specializations as sp', 's.specialization_id_opt', '=', 'sp.id')
            ->join('semesters as sm', 's.semester_id', '=', 'sm.id')
            ->join('academics as a', 's.academic_id', '=', 'a.id')
            ->select(
                's.id as student_id',
                's.fname as fname',
                's.lname as lname',
                's.registration_no as registration_no',
                'fs.id as fees_structure_id',
                'fs.structure_name as fees_structure_name',
                'pt.total_amount as total_amount',
                'pt.payment_date as payment_date',
                'pt.reciept_number as reciept_number'
            )
            ->orderBy('s.id');

        if ($request->filled('specialization_id')) {
            session()->flash('specialization_id', $request->specialization_id);
            $query->where('s.specialization_id_opt', $request->specialization_id);
        }

        if ($request->filled('semester_id')) {
            session()->flash('semester_id', $request->semester_id);
            $query->where('s.semester_id', $request->semester_id);
        }

        if ($request->filled('academic_id')) {
            session()->flash('academic_id', $request->academic_id);
            $query->where('s.academic_id', $request->academic_id);
        }

        if ($request->filled('degree_id')) {
            session()->flash('degree_id', $request->degree_id);
            $query->where('s.degree_id_opt', $request->degree_id);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {

            session()->flash('date_from', $request->date_from);
            session()->flash('date_to', $request->date_to);
            $query->whereBetween('pt.payment_date', [$request->date_from, $request->date_to]);
        }
        if ($request->filled('date_from')) {
            $currentDate = date('Y-m-d');
            session()->flash('date_from', $request->date_from);
            $query->whereBetween('pt.payment_date', [$request->date_from, $currentDate]);
        }

        if ($request->filled('date_to')) {
            $currentDate = date('Y-m-d');
            session()->flash('date_to', $request->date_to);
           $query->whereDate('pt.payment_date', '<=', $request->date_to);
        }
        if ($request->filled('search_term')) {
            $searchTerm = $request->search_term;
            session()->flash('search_term', $searchTerm);
            $query->where(function ($q) use ($searchTerm) {
                $q->where('s.degree_id_opt', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('s.specialization_id_opt', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('s.academic_id', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('s.semester_id', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('s.email', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('pt.total_amount', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        $fees = $query->paginate($perPage);
        // dd($fees);
        return view("admin.adminFeesPaymentPanel", compact('fees', 'title'));
    }
































    // ------------------------------ opening form for adding new Fees structure -------------------------------------------------------------------------
    public function adminFeesOpenNewForm(Request $request)
    {
        $title = 'New Fees';
        return view("admin.adminNewFees", compact('title'));
    }

    // ------------------------------ opening the Admin Payment schedule panel -------------------------------------------------------------------------
    public function showAdminHeadPanel(Request $request)
    {

        $title = "Fees Head";
        $perPage = $request->input('perPage', 5);
        $fees = Fees::getAllFeesHead()->paginate($perPage);

        foreach ($fees as $head) {
            $head->deletable = DB::table('fees_details')->where('fees_head_id', $head->id)->exists();
        }

        return view("admin.adminFeesHeadPanel", compact('title', 'fees'));
    }


    // ------------------------------ Addming new fees structure -------------------------------------------------------------------------

    public function adminFeesNewSubmit(Request $request)
    {

        try {
            Log::info('In the adminFeesNewSubmit controller function');
            $validatedData = $request->validate([
                'academic_id' => 'required|integer',
                'specialization_id' => 'required|integer',
                'semester_id' => 'required|integer',
                'fees_head_id' => 'required|array',
                'fees_head_id.*' => 'required|integer',
                'amount' => 'required|array',
                'amount.*' => 'required|numeric'
            ]);
            $ch = Fees::makeNewFeesStructure($validatedData);
            if (!$ch) {
                $error = "This fees Structure already exist!";
                $title = 'New Fees';
                return view("admin.adminNewFees", compact('title', 'error'));
            }
            $perPage = $request->input('perPage', 5);
            $fees = Fees::getAllFeesDetails()->paginate($perPage);

            return redirect()->route("admin.fees.panel", ['success' => 'Successfull']);
        } catch (ValidationException $e) {
            $error =  $e->getMessage();
            Log::error('Validation failed: ', ['error_message' => $error]);
            $title = 'New Fees';
            return view("admin.adminNewFees", compact('title', 'error'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Log::error('Exception: ', ['error_message' => $error]);
            $title = 'New Fees';
            return view("admin.adminNewFees", compact('title', 'error'));
        }
    }




    // ------------------------------ oUpdating the fees structure by the Admin in fees management -------------------------------------------------------------------------

    public function adminFeesEdit(Request $request, $id)
    {
        $data = Fees::adminFeesEdit($id);
        $fees_structure = $data['fees_structure'];
        $feesDetails = $data['fees_details'];
        $title = 'Fees SetUp';
        return view("admin.adminFeesEditForm", compact('title', 'feesDetails', 'fees_structure', 'id'));
    }


    // ------------------------------ opening the Admin Payment schedule panel --------------------------------------------------------------------------

    public function adminPaymentPaymentOpenPanel(Request $request)
    {
        $perPage = $request->input('perPage', 5);

        $query = DB::table('fees_payment_schedule as fp')
            ->leftJoin('fees_structure as fs', 'fs.id', '=', 'fp.fees_structure_id')
            ->leftJoin('academics as a', 'a.id', '=', 'fs.academic_id')
            ->leftJoin('semesters as sm', 'sm.id', '=', 'fs.semester_id')
            ->leftJoin('specializations as sp', 'sp.id', '=', 'fs.course_id')
            ->select(
                'fp.id as id',
                'fs.structure_name as structure_name',
                'fs.id as fees_structure_id',
                'fs.total_amount as amount',
                'fp.start_date as start_date',
                'fp.end_date as end_date',
                'fp.extended_date as extended_date',
                'fp.late_fine as late_fine'
            )->orderBy('fp.id');

        if ($request->filled('specialization_id')) {
            Log::info("filled('specialization')");
            session()->flash('specialization_id', $request->specialization_id);
            $query->where('fs.course_id', $request->specialization_id);
        }
        if ($request->filled('semester_id')) {
            Log::info("filled('semester_id')");
            session()->flash('semester_id', $request->semester_id);
            $query->where('fs.semester_id', $request->semester_id);
        }
        if ($request->filled('academic_id')) {
            Log::info("filled('academic_id')");
            session()->flash('academic_id', $request->academic_id);
            $query->where('fs.academic_id', $request->academic_id);
        }

        if ($request->filled('search_term')) {
            $searchTerm = $request->search_term;
            Log::info("In the search");

            $query->where(function ($q) use ($searchTerm) {
                $q->where('sp.name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('sm.name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('a.name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('fp.start_date', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('fp.end_date', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('fp.late_fine', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $feesPayment = $query->paginate($perPage);
        $title = "Payment Schedule";
        // dd($feesPayment);
        return view('admin.adminPaymentPanel', compact('title', 'feesPayment'));
    }





    // ================================== Opening schedule form page for Admin ==============================================================
    public function adminPaymentScheduleOpenForm()
    {
        $title = "Payment Schedule Panel";
        return view('admin.adminPaymentSchedule', compact('title'));
    }

    public function adminPaymentSchedulefirstSubmitForm(Request $request)
    {
        try {
            Log::info('In the adminPaymentSchedulefirstSubmitForm controller function');
            $title = "Payment Schedule";
            $validatedData = $request->validate([

                'fees_structure_id' => 'required|integer|exists:fees_structure,id',
                'amount' => 'required|numeric',
            ]);
            $fees_structure_id = $validatedData['fees_structure_id'];
            $total_amount = $validatedData['amount'];

            $updated = DB::table('fees_payment_schedule')->where('fees_structure_id', $validatedData['fees_structure_id'])->exists();
            if ($updated) {
                return redirect()->route("admin.payment.schedule", ['error' => "Already Scheduled!"]);
            }


            $title = 'Payment Schedule';
            return view('admin.adminPaymentScheduleForm', compact('fees_structure_id', 'total_amount'));
        } catch (ValidationException $e) {
            $error =  $e->getMessage();
            Log::error('Validation failed: ', ['error_message' => $error]);

            return redirect()->route("admin.payment.schedule", ['error' => $error]);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Log::error('Exception: ', ['error_message' => $error]);

            return redirect()->route("admin.payment.schedule", ['error' => $error]);
        }
    }
    // ================================== Opening schedule update form page for Admin ==============================================================
    public function adminPaymentScheduleOpenUpdateForm($fees_structure_id)
    {
        $fees = Fees::getPaymentSchedule($fees_structure_id);
        $title = "Payment Schedule";
        return view('admin.adminPaymentScheduleFormUpdate', compact('fees', 'title'));
    }

    // ================================== Updating the schedule form by the Admin ==============================================================

    public function adminPaymentScheduleUpdateForm(Request $request)
    {
        try {
            Log::info('In the adminPaymentScheduleUpdateForm controller function');
            $title = "Payment Schedule";
            $validatedData = $request->validate([
                'fees_structure_id' => 'required|integer|exists:fees_structure,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'extended_date' => 'nullable|date|after_or_equal:end_date',
                'late_fine' => 'nullable|numeric|min:0',
                'description' => 'nullable|string|max:255',
            ]);

            $update = Fees::schedulePayment($validatedData);
            if (!$update) {
                Log::info('Not updated: ', (array) $update);
                return redirect()->route("admin.payment.panel", ['error' => "Nothing changed!"]);
            }
            $title = 'Payment Schedule';
            return redirect()->route("admin.payment.panel", ['success' => "Successfull!", 'title' => $title]);
        } catch (ValidationException $e) {
            $error =  $e->getMessage();
            Log::error('Validation failed: ', ['error_message' => $error]);

            return redirect()->route("admin.payment.panel", ['error' => $error]);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Log::error('Exception: ', ['error_message' => $error]);

            return redirect()->route("admin.payment.panel", ['error' => $error]);
        }
    }
    // ================================== Submitting the final schedule form by the Admin ==============================================================
    public function adminPaymentSchedulefinalSubmitForm(Request $request)
    {
        try {
            Log::info('In the adminPaymentSchedulefinalSubmitForm controller function');
            $title = "Payment Schedule";
            $validatedData = $request->validate([
                'fees_structure_id' => 'required|integer|exists:fees_structure,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'extended_date' => 'nullable|date|after_or_equal:end_date',
                'late_fine' => 'nullable|numeric|min:0',
                'description' => 'nullable|string|max:255',
            ]);

            $update = Fees::schedulePayment($validatedData);
            if (!$update) {
                return redirect()->route("admin.payment.schedule", ['error' => "Something went wrong!"]);
            }
            $title = 'Payment Schedule';
            return redirect()->route("admin.payment.panel", ['success' => "Successfull!", 'title' => $title]);
        } catch (ValidationException $e) {
            $error =  $e->getMessage();
            Log::error('Validation failed: ', ['error_message' => $error]);

            return redirect()->route("admin.payment.schedule", ['error' => $error]);
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Log::error('Exception: ', ['error_message' => $error]);

            return redirect()->route("admin.payment.schedule", ['error' => $error]);
        }
    }

    // ================================== Making fees structure by Admin ==============================================================

    public function adminAddFees(Request $request, $id)
    {

        try {
            Log::info('In the adminAddFees controller class');
            $validatedData = $request->validate([
                'academic_id' => 'required|integer',
                'specialization_id' => 'required|integer',
                'semester_id' => 'required|integer',
                'fees_head_id' => 'required|array',
                'fees_head_id.*' => 'required|integer',
                'amount' => 'required|array',
                'amount.*' => 'required|numeric'
            ]);
            $ch = Fees::makeFeesStructure($validatedData);
            if (!$ch) {
                $error = "Nothing Changed!";
                $data = Fees::adminFeesEdit($id);
                $fees_structure = $data['fees_structure'];
                $feesDetails = $data['fees_details'];
                $title = 'Fees SetUp';
                return view("admin.adminFeesEditForm", compact('title', 'feesDetails', 'fees_structure', 'id', 'error'));
            }
            $perPage = $request->input('perPage', 5);
            $fees = Fees::getAllFeesDetails()->paginate($perPage);
            $title = 'Admin Fees Panel';


            return redirect()->route("admin.fees.panel", ['success' => 'Successfull']);
        } catch (ValidationException $e) {
            $error =  $e->getMessage();
            Log::error('Validation failed: ', ['error_message' => $error]);
            $data = Fees::adminFeesEdit($id);
            $fees_structure = $data['fees_structure'];
            $feesDetails = $data['fees_details'];
            $title = 'Fees SetUp';
            return view("admin.adminFeesEditForm", compact('title', 'feesDetails', 'fees_structure', 'id', 'error'));
        } catch (\Exception $e) {
            $error = $e->getMessage();
            Log::error('Exception: ', ['error_message' => $error]);
            $data = Fees::adminFeesEdit($id);
            $fees_structure = $data['fees_structure'];
            $feesDetails = $data['fees_details'];
            $title = 'Fees SetUp';
            return view("admin.adminFeesEditForm", compact('title', 'feesDetails', 'fees_structure', 'id', 'error'));
        }
    }


    // ---------------------------------    Opening the Admin Panel by the Admin -----------------------------------------------------------------------
    public function adminPage()
    {
        $title = 'Admin Home';
        return view("admin.admin", compact('title'));
    }
    // -------------------------------------    Opening the Student panel by the student    -------------------------------------------------------------------
    public function studentPage(Request $request)
    {
        $title = 'Student Home';
        $id = $request->input('id');
        $student = Student::getStudentData("id", $id);
        session(['student_id' => $id]);
        return view("student.studentPanel", compact('student', 'title'));
    }
    // -------------------------------------    Opening the Student Fees Payment Page by the student    -------------------------------------------------------------------

    public function studentFeesPaymentPageOpen(Request $request)
    {
        $student_id = $request->input('id');
        Log::info("Student_id from the studentFeesPaymentPageOpen: ", (array) $student_id);
        $fees_schedule = Fees::getStudentPaymentDetails($student_id);
        $title = "Fees Payment";
        return view("student.feesPaymentPanel", compact('title', 'fees_schedule', 'student_id'));
    }
    // -------------------------------------    Submitting the Student Fees payment details by the student    -------------------------------------------------------------------

    public function studentPayFeesSubmit(Request $request)
    {
        try {
            Log::info("In the studentPayFeesSubmit controller form");
            $validatedData = $request->validate([
                'fees_structure_id' => 'required|integer',
                'student_id' => 'required|integer',
                'total_amount' => 'required|numeric',
                'late_fine' => 'nullable'
            ]);
            $validatedData['payment_date'] = now()->format('Y-m-d');
            $validatedData['reciept_number'] = Fees::generatePaymentRecieptnNo();

            Log::info("studentPayFeesSubmit Data: ", (array) $validatedData);
            $status = Fees::studentPayFeesSubmit($validatedData);
            if ($status) {

                return redirect()->route("student.fees.payment.open.page", ['success' => "Payment Successfull!", 'id' => $validatedData['student_id']]);
            }
            Log::info("In the studentPayFeesSubmit controller form: something went wrong");
            return redirect()->route("student.fees.payment.open.page", ['error' => "Something Went Wrong!", 'id' => $validatedData['student_id']]);
        } catch (ValidationException $e) {
            Log::info("In the studentPayFeesSubmit controller form: ValidationException");
            return redirect()->route("student.fees.payment.open.page", ['error' => $e->getMessage(), 'id' => $validatedData['student_id']]);
        } catch (\Exception $e) {
            Log::info("In the studentPayFeesSubmit controller form: Exception");
            Log::error('studentPayFeesSubmit failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("student.fees.payment.open.page", ['error' => $e->getMessage(), 'id' => $validatedData['student_id']]);
        }
    }
    // -------------------------------------    Downloading fees reciept by the student    -------------------------------------------------------------------

    public function downloadFeesReciept(Request $request)
    {

        try {
            // dd($request->all());
            $student_id = (int) session('student_id');
            Log::info("In the downloadFeesRecieptt controller form");
            Log::info("In the downloadFeesRecieptt controller form student_id:", (array) $student_id);
            $validatedData = $request->validate([
                'fees_structure_id' => 'required|exists:payment_table,fees_structure_id',
                'student_id' => 'required|exists:payment_table,student_id'
            ]);

            Log::info("Validated data from the controller: ", (array) $validatedData);
            $data = Fees::downloadFeesReciept($validatedData);
            // dd($data);
            $fee = $data['fee'];
            $heads = $data['heads'];
            if ($fee && $heads) {
                $title = "Download reciept";
                return view('fees.fees_reciept', compact('title', 'fee', 'heads'));
            }
            Log::info("In the downloadFeesRecieptt controller form: something went wrong");
            return redirect()->route("student.fees.payment.open.page", ['error' => "Something Went Wrong!", 'id' => $student_id]);
        } catch (ValidationException $e) {
            Log::info("In the downloadFeesRecieptt controller ValidationException ");
            return redirect()->route("student.fees.payment.open.page", ['error' => $e->getMessage(), 'id' => $student_id]);
        } catch (\Exception $e) {
            Log::info("In the downloadFeesRecieptt controller Exception ");
            Log::error('Feed Head Add failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("student.fees.payment.open.page", ['error' => $e->getMessage(), 'id' => $student_id]);
        }
    }

    // -------------------------------------    Downloading fees reciept by the student    -------------------------------------------------------------------

    public function downloadFeesRecieptByAdmin(Request $request, $student_id, $fees_structure_id)
    {

        try {

            $validatedData['fees_structure_id'] = $fees_structure_id;
            $validatedData['student_id'] = $student_id;

            Log::info("Validated data from the controller downloadFeesRecieptByAdmin: ", (array) $validatedData);
            $data = Fees::downloadFeesReciept($validatedData);
            // dd($data);
            $fee = $data['fee'];
            $heads = $data['heads'];
            if ($fee && $heads) {
                $title = "Download reciept";
                return view('fees.fees_reciept', compact('title', 'fee', 'heads'));
            }
            Log::info("In the downloadFeesRecieptByAdmin controller form: something went wrong");
            return redirect()->route("admin.fees.payments", ['error' => "Something Went Wrong!"]);
        } catch (ValidationException $e) {
            Log::info("In the downloadFeesRecieptByAdmin controller ValidationException ");
            Log::error('Fees Print failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("admin.fees.paymentse", ['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            Log::info("In the downloadFeesRecieptByAdmin controller Exception ");
            Log::error('Fees Print failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("admin.fees.payments", ['error' => $e->getMessage()]);
        }
    }


    // ------------------------------------------ Opening the registration form by the student --------------------------------------------------------------
    public function registration_form()
    {
        $title = 'Student Registration';
        return view("registration.registration", compact('title'));
    }
    // ------------------------------------ Opening the admin login page by for the admin   --------------------------------------------------------------------
    public function admin_login_form()
    {
        $title = 'Admin Login';
        return view("admin.login", compact('title'));
    }
    // ----------------------------------   Opening the student login page by for the student   ---------------------------------------------------------------------- 
    public function student_login_form()
    {
        $title = 'Student Login';
        return view("student.studentLogin", compact('title'));
    }
    // ----------------------------------   opening page for downloding the student application details by both student and admin   ----------------------------------------------------------------------

    public function downloadPDF($id)
    {
        $student = Student::getStudentAllData('id', $id);
        return view('student.student', compact('student'));
    }
    //==================================    opening the downloding page for fees structure by the admin =================================================================================
    public function downloadFeesPDF($id)
    {
        $data = Fees::getAllFeesDetailsPdf($id);
        $fees_structure = $data['fees_structure'];
        $fees_heads = $data['fees_heads'];
        $fees_head_structure = $data['fees_head_structure'];

        return view('fees.fees', compact('fees_structure', 'fees_heads', 'fees_head_structure'));
    }

    // ------------------------------------     searching the student data from the student panel by the admin  --------------------------------------------------------------------
    public function search(Request $request)
    {
        // Log::info('search_term: ',(array) $request->get('search_term') );
        $students = [];
        $validated = [
            'fname' => $request->input('fname'),
            'gender_id' => $request->input('gender_id'),
            'search_term' => $request->input('search_term'),
            'school_id' => $request->input('school_id'),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'country_id' => $request->input('country_id'),
            'state_id' => $request->input('state_id'),
            'district_id' => $request->input('district_id'),
        ];

        Log::info('search_term:', ['value' => $validated['search_term'] ?? null]);

        $date_from = $validated['date_from'] ?? null;
        $date_to = $validated['date_to'] ?? null;
        $fname = $validated['fname'] ?? null;
        $gender_id = $validated['gender_id'] ?? null;
        $search_term = $validated['search_term'] ?? null;
        $school_id = $validated['school_id'] ?? null;
        $country_id = $validated['country_id'] ?? null;
        $state_id = $validated['state_id'] ?? null;
        $district_id = $validated['district_id'] ?? null;

        session()->flash('fname', $fname);
        session()->flash('gender_id', $gender_id);
        session()->flash('search_term', $search_term);
        session()->flash('school_id', $school_id);
        session()->flash('date_from', $date_from);
        session()->flash('date_to', $date_to);
        session()->flash('country_id', $country_id);
        session()->flash('state_id', $state_id);
        session()->flash('district_id', $district_id);


        $perPage = $request->input('perPage', 5);

        $students = Student::getStudent($validated)->paginate($perPage);
        $title = 'Admin Panel';
        if ($students->isEmpty()) {
            $error = 'No Data Found';
            Log::info($error);
            return view("admin.adminPanel", compact('students', 'error', 'fname', 'title'));
        }


        $title = 'Admin Panel';

        return view("admin.adminPanel", compact('students', 'title'));
    }

    // ---------------------------  searching the fees heads details by the admin   -----------------------------------------------------------------------------
    public function searchFeesHead(Request $request)
    {
        $validated = [
            'search_term' => $request->input('search_term')
        ];
        $search_term = $validated['search_term'] ?? null;
        session()->flash('search_term', $search_term);
        $perPage = $request->input('perPage', 5);
        $fees = Fees::searchFeesHead($search_term)->paginate($perPage);
        $title = 'Fees Head';
        if ($fees->isEmpty()) {
            $error = 'No Data Found';
            Log::info($error);
            return view("admin.adminFeesHeadPanel", compact('fees', 'error', 'title'));
        }
        return view("admin.adminFeesHeadPanel", compact('fees', 'title'));
    }
    //==============================    adding a new fees head type by the Admin    =====================================================================================
    public function addFeesHead(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|unique:fees_heads,name,' . $request->id,
                'description' => 'nullable|string',
            ]);
            Log::info("description: ", (array) $validated);
            $result = Fees::addNewFeesHead($validated);
            Log::info("result:", (array) $result);
            if ($result) {
                return redirect()->route("admin.head.panel",  ['success' => 'Added!']);
            }
            return redirect()->route("admin.head.panel", ['error' => "Something wrong!"]);
        } catch (ValidationException $e) {
            return redirect()->route("admin.head.panel", ['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            Log::error('Feed Head Add failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("admin.head.panel", ['error' => $e->getMessage()]);
        }
    }
    //===================================   Deleting a fees head type by the Admin  ================================================================================
    public function adminFeesHeadDelete(Request $request, $id)
    {
        try {
            Log::info("delete id: ", (array) $id);
            $result = Fees::deleteFeesHead($id);
            if ($result) {
                return redirect()->route("admin.head.panel",  ['success' => 'Deleted!']);
            }
            return redirect()->route("admin.head.panel", ['error' => "Something Wrong"]);
        } catch (ValidationException $e) {
            return redirect()->route("admin.head.panel", ['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            Log::error('Feed Head Add failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("admin.head.panel", ['error' => $e->getMessage()]);
        }
    }
    //===================================== Updating a fees head type by the Admin  ==============================================================================
    public function adminFeesHeadUpdate(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|unique:fees_heads,name,' . $request->id,
                'description' => 'nullable|string',
            ]);
            Log::info("description: ", (array) $validated);
            $result = Fees::updateFeesHead($id, $validated);
            if ($result) {
                return redirect()->route("admin.head.panel",  ['success' => 'Update Successfull!']);
            }
            return redirect()->route("admin.head.panel", ['error' => "Nothing Changed"]);
        } catch (ValidationException $e) {
            return redirect()->route("admin.head.panel", ['error' => $e->getMessage()]);
        } catch (\Exception $e) {
            Log::error('Feed Head Add failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("admin.head.panel", ['error' => $e->getMessage()]);
        }
    }
    // ------------------------------- Validating the student login and redirect to the student dashboard   -------------------------------------------------------------------------

    public function studentLoginValidation(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
            $validated['password'] = hash('sha256', $validated['password']);
            $role = 'student';
            $student = Student::checkDataForLoginValidation($validated, $role);
            if (!$student) {
                return redirect()->route("student.login", ['error' => 'Account does not exist']);
            }
            if ($student->password != $validated['password']) {
                return redirect()->route("student.login", ['error' => 'Incorrect password']);
            }
            Session::put('user', 'student');
            return redirect()->route("student.page",  ['success' => 'Login Successful!', 'id' => $student->id]);
        } catch (ValidationException $e) {
            return redirect()->route("student.login", ['error' => 'Account does not exist'])->withInput();
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("student.login", ['error' => 'Account does not exist'])->withInput();
        }
    }
    // -------------------------------------    validating the admin loging credentials and redirecting to the admin dashboard  -------------------------------------------------------------------
    public function adminloginValidation(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
            $validated['password'] = hash('sha256', $validated['password']);
            $role = 'admin';
            $student = Student::checkDataForLoginValidation($validated, $role);
            if (!$student) {
                Log::error('Account does not exist');
                return redirect()->route("admin.login", ['error' => 'Account does not exist']);
            }
            echo $student->password;
            if ($student->password != $validated['password']) {
                Log::error('Registration failed Incorrect password');
                return redirect()->route("admin.login", ['error' => 'Incorrect password']);
            }
            Session::put('id', $student->id);
            Session::put('email', $student->email);
            Session::put('user', 'admin');
            return redirect()->route("admin.page", ['success' => 'Login Successful!']);
        } catch (ValidationException $e) {
            return redirect()->route("admin.login", ['error' => 'Account does not exist'])->withInput();
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("admin.login", ['error' => 'Account does not exist'])->withInput();
        }
    }

    // ------------------------------------------ Logout --------------------------------------------------------------
    public function logout()
    {
        Session::flush();
        return redirect('/')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }


    // ===================================== Show Forget Password Form ===========================================

    public function showForgetPasswordForm()
    {
        $title = 'Forget-password';
        Log::info('showForgetPasswordForm');
        return view('password.forget-password', compact('title'));
    }
    // ===================================== Handle Forget Password Form Submission and then to choose varification method ===========================================
    public function submitForgetPasswordForm(Request $request)
    {
        Log::info('submitForgetPasswordForm');
        $title = 'Forget-password';
        $error = 'User does not exist!';
        try {
            $validated = $request->validate(['email' => 'required|email|exists:students,email']);
            $email = $validated['email'];
            $otp = rand(1000, 9999);
            $token = bin2hex(random_bytes(32));


            DB::table('students')
                ->where('email', $email)
                ->update([
                    'otp' => $otp,
                    'token' => $token,
                    'updated_at' => now()
                ]);


            $email = Crypt::encrypt($validated['email']);
            $resetUrl = url('/showOtpVerificationForm' . '/' . $token . '?email=' . $email);
            Mail::to($validated['email'])->send(new PasswordResetMail($otp, $resetUrl));


            $success = 'OTP and Password reset link sent to your email!';

            return redirect()->route('showOtpVerification.Form', ['token' => $token, 'title' => $title, 'success' => $success, 'email' => $email]);
        } catch (ValidationException $e) {
            Log::error('submitForgetPasswordForm', ['error_message' => $e->getMessage()]);
            return redirect()->route('forget.password', ['title' => $title, 'error' => $error]);
        } catch (\Exception $e) {
            Log::error('submitForgetPasswordForm', ['error_message' => $e->getMessage()]);
            $error = $e->getMessage();
            return redirect()->route('forget.password', ['title' => $title, 'error' => $error]);
        }
    }

    // ======================================== Show OTP Verification Page Via Email  ========================================
    public function showOtpVerificationForm(Request $request, $token)
    {
        Log::info('showOtpVerificationForm');
        $title = 'Forget password';
        $email = Crypt::decrypt($request->input('email'));

        try {
            $record = DB::table('students')->where('email', $email)->where('token', $token)->first();
            if (!$record) {
                return redirect()->route('forget.password', ['error' => "Invalid OTP or expired token.", 'title' => 'Forget password']);
            }

            $email = Crypt::encrypt($email);

            return view('password.otp-verification', compact('email', 'title'));
        } catch (\Exception $e) {
            Log::error('Error in OTP verification', ['error' => $e->getMessage()]);

            return redirect()->route('forget.password', ['error' => $e->getMessage(), 'title' => 'Forget password']);
        }
    }

    // ================================= validate the OTP ===============================================


    public function validateOTP(Request $request)
    {
        $title = 'Forget Password';
        $error = 'Invalid OTP!';
        Log::info('validateOTP');
        $email = $request->input('email');
        try {
            $validated = $request->validate([
                'otp' => 'required|max:4|min:4'
            ]);
            Log::info('Email: ' . $email);
            if ($validated) {
                Log::info('OTP validated!'); //reset.password
                return redirect()->route("show.reset.password", ['email' => $email, 'title' => $title]);
            }
        } catch (ValidationException $e) {
            return view('password.otp-verification', compact('email', 'error', 'title'));
        } catch (\Exception $e) {

            Log::error('Registration failed', ['error_message' => $e->getMessage()]);
            return view('password.otp-verification', compact('email', 'error', 'title'));
        }
    }
    // ================================= Show Password Reset Page ===============================================
    public function showResetPasswordForm(Request $request)
    {

        $email = $request->email;
        return view('password.reset-password', compact('email'));
    }

    public function validateResetPasswordForm(Request $request)
    {
        $title = 'Forget-password';
        $email = Crypt::decrypt($request->input('email'));  // to remove the error just pass it through url.means use redirect()
        try {

            $validated = $request->validate([
                'password' => 'required|string|min:8|confirmed'
            ]);
            $password = hash('sha256', $request->input('password'));
            $updateStatus = Student::forget_updatePassword($email, $password);


            if ($updateStatus) {
                $success = "Password changed successfully!";
                return view('welcome', compact('success', 'title'));
            } else {

                $error = 'New password cannot be the old password.';
                Log::info($error);
                $email = Crypt::encrypt($email);
                return view('password.reset-password', compact('email', 'password', 'error', 'title'));
            }
        } catch (\Exception $e) {
            Log::error('Error in OTP verification', ['error' => $e->getMessage()]);
            $error = $e->getMessage();
            $email = Crypt::encrypt($email);
            return view('password.reset-password', compact('email', 'error', 'title'));
        }
    }
}

// ================================================================================
