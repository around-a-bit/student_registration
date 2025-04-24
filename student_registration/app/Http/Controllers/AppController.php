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
use Illuminate\Support\Facades\Validator;





class AppController extends Controller
{
    public function index()
    {
        $title = 'Home';
        return view('welcome', compact('title'));
    }
    // --------------------------------------------------------------------------------------------------------
    public function aboutUs()
    {
        $title = 'About US';
        return view('aboutUs', compact('title'));
    }
    // --------------------------------------------------------------------------------------------------------
    public function contactUs()
    {
        $title = 'Contact Us';
        return view('contactUs', compact('title'));
    }
    // --------------------------------------------------------------------------------------------------------

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


    public function emailVerificationPost(Request $request)
    {

        $title = 'DCG';
        $error = 'Invalid OTP!';
        try {
            $email = $request->input('email');
            $token = $request->input('token');

            $validated = $request->validate([
                'otp' => 'required|max:4|min:4'
            ]);
            $record = DB::table('students')->where('email', $email)->where('token', $token)->where('otp', $validated['otp'])->first();
            Log::info('token', (array) $token);
            Log::info('email', (array) $email);
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
            // $error = $e->getMessage();
            $error = $e->validator->errors()->first();
            Log::error('Registration failed', ['error_message' => (array) $error]);

            return view('registration.loginDetails', compact('email', 'title', 'error'));
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error_message' => $e->getMessage()]);

            $error = $e->getMessage();
            return view('registration.loginDetails', compact('email', 'title', 'error'));
        }
    }
    // --------------------------------------------------------------------------------------------------------

    public function updateRegistrationDataBasic($email, Request $request)
    {


        $student = Student::where('email', $email)->firstOrFail();

        try {
            // Validate the request data
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

    public function updateRegistrationDataAcademic($email, Request $request)
    {

        try {
            $student = Student::where('email', $email)->firstOrFail();
            // Validate the request data
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

    public function updateRegistrationDataDocument($email, Request $request)
    {

        try {
            Log::info('In the updateRegistrationDataDocument function');
            $student = Student::where('email', $email)->first();
            Log::info('Got the student data');
            $fname = $student->fname;
            Log::info('Got the student fname');

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
            Log::info('Mail unsuccessfull');
            Mail::to($email)->send(new RegistrationSuccessMail($fname, $validatedData['registration_no']));
            Log::info('Mail successfull');
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


    public function updateRegistrationDataPassword($email, Request $request)
    {

        Log::info('Checking for data');
        $student = Student::where('email', $email)->firstOrFail();
        Log::info('data found');
        try {
            // Validate the request data
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

    // --------------------------------------------------------------------------------------------------------
    public function adminPanel(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $students = Student::getStudentData(null, null)->paginate($perPage);
        // dd($students);
        $title = 'Admin Panel';

        return view("admin.adminPanel", compact('students', 'title'));
    }
    
    public function adminBrowse(Request $request)
    {

        $title = 'Browse';
        $maleCount = Gender::getGenderCount(1);
        $femaleCount = Gender::getGenderCount(2);
        $thirdCount = Gender::getGenderCount(3);
        // dd($maleCount,$femaleCount,$thirdCount);

        return view("admin.adminBrowse", compact('title','maleCount','femaleCount','thirdCount'));
    }


    // --------------------------------------------------------------------------------------------------------
    public function adminPage()
    {
        $title = 'Admin Home';
        return view("admin.admin", compact('title'));
    }
    // --------------------------------------------------------------------------------------------------------
    public function studentPage(Request $request)
    {
        $title = 'Student Home';
        $id = $request->input('id');
        Log::info('$d: ', ['id' => $id]);
        $student = Student::getStudentData("id", $id);
        return view("student.studentPanel", compact('student', 'title'));
    }



    // --------------------------------------------------------------------------------------------------------
    public function registration_form()
    {
        $title = 'Student Registration';
        return view("registration.registration", compact('title'));
    }
    // --------------------------------------------------------------------------------------------------------
    public function admin_login_form()
    {
        $title = 'Admin Login';
        return view("admin.login", compact('title'));
    }
    // -------------------------------------------------------------------------------------------------------- 
    public function student_login_form()
    {
        $title = 'Student Login';
        return view("student.studentLogin", compact('title'));
    }
    // --------------------------------------------------------------------------------------------------------



    public function downloadPDF($id)
    {
        $student = Student::getStudentAllData('id', $id);
        // dd($student);

        return view('student.student', compact('student'));
    }

    // --------------------------------------------------------------------------------------------------------
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


    // --------------------------------------------------------------------------------------------------------

    // --------------------------------------------------------------------------------------------------------

    public function studentLoginValidation(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $validated['password'] = hash('sha256', $validated['password']);
            Log::error('password: ' . $validated['password']);

            $role = 'student';

            $student = Student::checkDataForLoginValidation($validated, $role);
            if (!$student) {
                return redirect()->route("student.login", ['error' => 'Account does not exist']);
            }

            if ($student->password != $validated['password']) {
                Log::error('Registration failed Incorrect password');
                return redirect()->route("student.login", ['error' => 'Incorrect password']);
            }
            Log::info('Validated Data:', (array) $validated);
            Session::put('user', 'student');

            return redirect()->route("student.page",  ['success' => 'Login Successful!', 'id' => $student->id]);
        } catch (ValidationException $e) {
            return redirect()->route("student.login", ['error' => 'Account does not exist'])->withInput();
        } catch (\Exception $e) {
            Log::error('Registration failed', ['error_message' => $e->getMessage()]);
            return redirect()->route("student.login", ['error' => 'Account does not exist'])->withInput();
        }
    }
    // --------------------------------------------------------------------------------------------------------
    public function adminloginValidation(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $validated['password'] = hash('sha256', $validated['password']);
            Log::error('password: ' . $validated['password']);

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
            Log::info('Validated Data:', (array) $validated);
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
    // --------------------------------------------------------------------------------------------------------


    public function logout()
    {
        // Clear all session data
        Session::flush();

        // Prevent back button from accessing cached pages
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
