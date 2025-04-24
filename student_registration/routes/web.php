<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\TestMail;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function(){
    return view('registration.loginDetails');
});


// ---------------------------------------------------- Email Verification --------------------------------------------------
Route::get('/showRegistrationForm',function(){ $title = 'DCG'; return (view('registration.emailVerification',compact('title'))); })->name('show.registraion.form'); // OK
//                                                  |
//                                                  ∀
Route::post('/registrationFormPre', [AppController::class, 'emailVerificationPre'])->name('email.verification.pre'); 
//                                                  |
//                                                  ∀
Route::get('/registrationFormPost', function(Request $request){ $title = 'DCG'; $email = $request->input('email'); $token = $request->input('token'); return (view('registration.loginOTP',compact('title'))); })->name('email.verification.post');
//                                                  |
//                                                  ∀
Route::post('/loginOtpValidate', [AppController::class, 'emailVerificationPost'])->name('validate.otp.details'); 
//                                                  |
//                                                  ∀
Route::post('/loginInformationStore', [AppController::class, 'loginStore'])->name('store.login.details');






// ------------------------------------------------------------------------------------------------------




Route::get('/send-test-email', function () {
    Mail::to('academicmentorship738@gmail.com')->send(new TestMail());
    return "Test email sent!";
});

// ------------------------------------------------------------------------------------------------------
// Home route
Route::get('/', "App\Http\Controllers\AppController@index")->name('index');
Route::get('/aboutUs', [AppController::class, 'aboutUs'])->name('about.us');
Route::get('/contactUs', [AppController::class, 'contactUs'])->name('contact.us');

// ------------------------------------------------------------------------------------------------------
// Registration form routes
Route::get('/registration', [AppController::class, 'registration_form'])->name('registration.form');
Route::post('/registration', [AppController::class, 'registration_store'])->name('registration.store');

// ------------------------------------------------------------------------------------------------------
// Ajax routes for country, state, district, etc.

Route::get('/countries', [AjaxController::class, 'getCountries']);
Route::get('/states/{country_id}', [AjaxController::class, 'getStates']);
Route::get('/districts/{state_id}', [AjaxController::class, 'getDistricts']);
Route::get('/genders', [AjaxController::class, 'getGenders']);
Route::get('/degrees', [AjaxController::class, 'getDegrees']);
Route::get('/specializations', [AjaxController::class, 'getSpecializations']);
Route::get('/schools', [AjaxController::class, 'getSchools']);

Route::get('/get-students', [AjaxController::class, 'getStudents']);




// ---------------------------------------------- Update Registration Details -------------------------------------------

Route::match(['get', 'put'], '/edit-student/{id}', [AjaxController::class, 'editRegistrationFormShowStudent'])->name('edit-student');
Route::put('/updateBasic/{email}', [AppController::class, 'updateRegistrationDataBasic'])->name('update-student-basic');
Route::put('/updateAcademic/{email}', [AppController::class, 'updateRegistrationDataAcademic'])->name('update-student-academic');
Route::put('/updateAddress/{email}', [AppController::class, 'updateRegistrationDataAddress'])->name('update-student-address');
Route::put('/updateDocument/{email}', [AppController::class, 'updateRegistrationDataDocument'])->name('update-student-document');
Route::put('/updatePassword/{email}', [AppController::class, 'updateRegistrationDataPassword'])->name('update-student-password');

// -----------------------------------------------------------------------------------------------------------------------




// --------------------------------------------------------------------------------------------------------------
Route::match(['get', 'put'], '/show-update-by-admin/{id}', [AjaxController::class,'editRegistrationFormShowAdmin'])->name('update-student-admin');
Route::put('/update-admin/{email}', [AjaxController::class, 'updateStudent'])->name('update-student-store-admin');

// --------------------------------------------------------------------------------------------------------------

// Route::delete('/students-admin/{email}', [AjaxController::class, 'deleteAccount'])->name('student.delete-admin');

Route::delete('/students/{email}', [AjaxController::class, 'deleteAccount'])->where('email', '.*')->name('student.delete');




Route::delete('/photoUpload/{id}', [AppController::class, 'photoUpload'])->name('student.upload');



// ------------------------------------------------------------------------------------------------------
// Regular login routes
Route::get('/login', [AppController::class, 'admin_login_form'])->name('admin.login');
Route::post('/login_user', [AppController::class, 'adminloginValidation'])->name('admin.login.validate');


Route::get('/student-login', [AppController::class, 'student_login_form'])->name('student.login');
Route::post('/student-login', [AppController::class, 'studentLoginValidation'])->name('student.login.validate');

// ------------------------------------------------------------------------------------------------------
// Admin dashboard route
Route::get('/adminlogin', [AppController::class, 'adminPage'])->name('admin.page');

Route::get('/admin', [AppController::class, 'adminPanel'])->name('admin.panel');
Route::get('/adminBrowse', [AppController::class, 'adminBrowse'])->name('admin.browse');

Route::get('/studentlogin', [AppController::class, 'studentPage'])->name('student.page');
// ------------------------------------------------------------------------------------------------------
Route::get('/welcome', [AppController::class, 'index'])->name('welcome');
// Home route after authentication
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// ------------------------------------------------------------------------------------------------------

Route::get('/search', [AppController::class, 'search'])->name('search.all');


// ------------------------------------------------------------------------------------------------------
Route::get('/student/pdf/{id}', [AppController::class, 'downloadPDF'])->name('student.pdf');



// ------------------------------------------------------------------------------------------------------
Route::post('/search-byFname', [AjaxController::class, 'FnameData'])->name('fname.data');
// ------------------------------------------------------------------------------------------------------
Route::get('/logout', function () {
    Session::flush();
    return redirect()->route('index');
})->name('logout');
// ------------------------------------------------------------------------------------------------------


Route::get('/session-user', function () {
    return response()->json(['user' => session('user')]);
});



// --------------------------------------------- Forget Password ---------------------------------------------------->




Route::get('/forget-password', [AppController::class, 'showForgetPasswordForm'])->name('forget.password'); //redirecting from the hyper link
//                                                  |
//                                                  ∀
Route::post('/forget-password_', [AppController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); //after submitting the mail
//                                                  |
//                                                  ∀
Route::GET('/showOtpVerificationForm/{token}', [AppController::class, 'showOtpVerificationForm'])->name('showOtpVerification.Form');
//                                                  |
//                                                  ∀
Route::POST('/validate-otp', [AppController::class, 'validateOTP'])->name('validate.otp');
//                                                  |
//                                                  ∀
Route::get('/reset-password_', [AppController::class, 'showResetPasswordForm'])->name('show.reset.password');
//                                                  |
//                                                  ∀
Route::post('/reset-password', [AppController::class, 'validateResetPasswordForm'])->name('reset.password');























Route::match(['get', 'post'], '/validated-reset-password', [AppController::class, 'showOtpVerificationForm'])->name('reset.password.valid');




//showOtpVerificationForm


