<?php

use App\Http\Controllers\E_Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CedulaController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\EmployeeManagement;

use App\Http\Controllers\ResidentInformation;
use App\Http\Controllers\BarangayIDController;
use App\Http\Controllers\SocialAuthController;
use Google\Service\MyBusinessLodging\Business;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GeneralFormController;

Route::get('/', [ServiceController::class, 'landingPage'])->name('Home');
Route::get('/services', [ServiceController::class, 'ShowServices'])->name('Services');

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::middleware(['CheckUser'])->group(function () { //added middle for unauthorized user
    // Route for displaying service form
    Route::get('/service/{service_slug}', [ServiceController::class, 'showForm'])->name('service.form');

    // Route for handling form submission
    Route::post('/service/{service_slug}/submit', [ServiceController::class, 'submitGeneralForm'])->name('submit.general_form');
    Route::post('/service/{service_slug}/form_id', [ServiceController::class, 'submitFormID'])->name('submit.form_id');
    Route::post('/service/{service_slug}/cedula', [ServiceController::class, 'submitCedula'])->name('submit.cedula');
    Route::post('/service/{service_slug}/permit', [ServiceController::class, 'submitPermit'])->name('submit.permit');
});

Route::get('/about', function () {
    return view('website.About');
})->name('About');

Route::get('/contact', function () {
    return view('website.Contact');
})->name('Contact');


Route::get('/login', [AuthController::class, "ShowLogin"])->name('loginPage');
Route::get('/register', [AuthController::class, 'ShowRegister'])->name('RegisterPage');

Route::post('/RegisterAccount', [AuthController::class, 'RegisterAcc'])->name('RegisterAcc');
Route::post('/login', [AuthController::class, 'loginAcc'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/checkuser', function () {
    dd(Auth::user()->name ?? 'No Account LogIn');
});

//applications 
Route::middleware('CheckUser')->group(function () {
    // Route for viewing applications
    Route::get('/applications', [ApplicationController::class, 'showApplications'])->name('applications');
});






//Google
Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('auth.google.callback');







//adminSide



//dashboard
Route::get('/admin', function () {
    return view('AdminSide.Admin');
})->name('dash');



//employee management
Route::post('/addEmployee', [EmployeeManagement::class, 'AddEmp'])->name('AddEmployee');
Route::get('/employee', [EmployeeManagement::class, 'ShowEmp'])->name('ShowEmployee');

//resident information
Route::get('/resident', [ResidentInformation::class, 'ShowResident'])->name('ShowRes');
Route::post('/add-resident', [ResidentInformation::class, 'StoreResident'])->name('addResident');
// Show the form for editing a resident
Route::get('/residents/{id}/edit', [ResidentInformation::class, 'edit'])->name('residents.edit');
Route::put('/residents/{id}', [ResidentInformation::class, 'update'])->name('residents.update');


//clearance and certificate
Route::get('/request', [ApplicationController::class, 'ShowAllReq'])->name('ShowReq');
Route::post('/submit-application', [ApplicationController::class, 'submitForm'])->name('submit.application');
Route::post('/approve-document/{id}', [ApplicationController::class, 'approve'])->name('approve.document');
Route::post('/schedule-release/{id}', [ApplicationController::class, 'scheduleRelease'])->name('schedule.release');



//Attendance management
Route::get('/Attendance', function () {
    return view('AdminSide.Attendance');
})->name('attendManage');






Route::prefix('services')->group(function () {
    Route::get('/general-form', [E_Services::class, 'generalForm'])->name('general.form');
    Route::get('/business-permit', [E_Services::class, 'businessPermit'])->name('business.permit');
    Route::get('/barangay-id', [E_Services::class, 'barangayID'])->name('barangay.id');
    Route::get('/cedula', [E_Services::class, 'cedula'])->name('cedula');
});



//barnagay id
Route::post('/barangay-id/{id}/approveID', [BarangayIDController::class, 'approveID'])->name('approve.formID');
Route::post('/barangay-id/{id}', [BarangayIDController::class, 'scheduleReleaseID'])->name('schedule.releaseID');


//general fform
Route::post('/general-form/{id}/approveID', [GeneralFormController::class, 'approveGeneral'])->name('general.formID');
Route::post('/general-form/{id}', [GeneralFormController::class, 'GeneralReleaseID'])->name('general.release');


//cedula
Route::post('/cedula/{id}/approveID', [CedulaController::class, 'approveCedula'])->name('approve.cedula');
Route::post('/cedula/{id}', [CedulaController::class, 'CedulaRelease'])->name('cedula.release');


//BUSINEESS PERMIT
Route::post('/business-permit/{id}/approveID', [BusinessController::class, 'approveBusinessPermit'])->name('approve.business-permit');
Route::post('/business-permit/{id}', [BusinessController::class, 'CedulaBusinessPermit'])->name('businessPermit.release');
