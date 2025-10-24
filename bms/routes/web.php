<?php

use App\Http\Controllers\E_Services;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CedulaController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BusinessController;

use App\Http\Controllers\EmployeeManagement;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidentInformation;
use App\Http\Controllers\BarangayIDController;
use App\Http\Controllers\SocialAuthController;
use Google\Service\MyBusinessLodging\Business;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GeneralFormController;
use App\Http\Controllers\AnnouncementController;

Route::get('/', [ServiceController::class, 'landingPage'])->name('Home');
Route::get('/services', [ServiceController::class, 'ShowServices'])->name('Services');

// Route::get('/login', function () {
//     return view('auth.login');
// });

Route::middleware(['CheckUser'])->group(function () { //added middle for unauthorized user

    Route::get('/service/{service_slug}', [ServiceController::class, 'showForm'])->name('service.form');


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

//E-services
Route::get('/login', [AuthController::class, "ShowLogin"])->name('loginPage');
Route::get('/register', [AuthController::class, 'ShowRegister'])->name('RegisterPage');

Route::post('/RegisterAccount', [AuthController::class, 'RegisterAcc'])->name('RegisterAcc');
Route::post('/login', [AuthController::class, 'loginAcc'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/checkuser', function () {
    dd(Auth::user()->name ?? 'No Account LogIn');
});
Route::get('/verify-email', [AuthController::class, 'showVerifyEmailPage'])->name('verify.email.page');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');
Route::post('/re-verified', [AuthController::class, 'reverified'])->name('NotVerified');
//applications 
Route::middleware('CheckUser')->group(function () {
    // Route for viewing applications
    Route::get('/applications', [ApplicationController::class, 'showApplications'])->name('applications');
});






//Google
Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('auth.google.callback');


Route::get('/announcements/{id}', [AnnouncementController::class, 'Readmore'])->name('ShowAnnounce');




//adminSide
//login for admin side
Route::get('/admin', function () {
    return view('AdminSide.auth.login');
})->name('LoginAdmin')->middleware('admin');
Route::post('/admin/login', [AdminController::class, 'Adminlogin'])->name('admin.login');
Route::post('/Admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');
Route::get('/admin/2fa', function () {
    return view('AdminSide.auth.2fa');
})->name('admin.2fa.form');

Route::post('/admin/2fa', [AdminController::class, 'verify2fa'])->name('admin.2fa.verify');


Route::middleware(['admin', 'preventBackHistory'])->group(function () {

    // Dashboard
    // Route::get('/dashboard', function () {
    //     return view('AdminSide.Admin');
    // })->name('dash');
    Route::get('/dashboard', [DashboardController::class, 'ShowDashboard'])->name('dash');
    // Logout
    Route::get('/admin/profile', [AdminController::class, 'ShowAdminProfile'])->name('admin.profile');

    Route::put('/profile/personal', [AdminController::class, 'updatePersonal'])->name('profile.update.personal');
    Route::put('/profile/account', [AdminController::class, 'updateAccount'])->name('profile.update.account');






    // Employee Management
    Route::post('/addEmployee', [EmployeeManagement::class, 'AddEmp'])->name('AddEmployee');
    Route::get('/employee', [EmployeeManagement::class, 'ShowEmp'])->name('ShowEmployee');
    Route::delete('/employee/{id}/delete', [EmployeeManagement::class, 'DestroyEmployee'])->name('DeleteEmployee');
    Route::put('/Edit/Employee', [EmployeeManagement::class, 'editemployee'])->name('EditEmployee');

    // Resident Information
    Route::get('/resident', [ResidentInformation::class, 'ShowResident'])->name('ShowRes');
    Route::post('/add-resident', [ResidentInformation::class, 'StoreResident'])->name('addResident');
    Route::get('/residents/{id}/edit', [ResidentInformation::class, 'edit'])->name('residents.edit');
    Route::put('/residents/{id}', [ResidentInformation::class, 'update'])->name('residents.update');
    Route::delete('/resident/{id}/delete', [ResidentInformation::class, 'DestroyResident'])->name('DeleteResident');

    // Clearance & Certificate
    Route::get('/request', [ApplicationController::class, 'ShowAllReq'])->name('ShowReq');
    Route::post('/submit-application', [ApplicationController::class, 'submitForm'])->name('submit.application');
    Route::post('/approve-document/{id}', [ApplicationController::class, 'approve'])->name('approve.document');
    Route::post('/schedule-release/{id}', [ApplicationController::class, 'scheduleRelease'])->name('schedule.release');

    // Announcement
    Route::get('/announcement', [AnnouncementController::class, 'showAnnounce'])->name('Announce');
    Route::post('/upload/announcement', [AnnouncementController::class, 'AddAnnounce'])->name('announce.store');
    Route::put('/announcements/{id}', [AnnouncementController::class, 'update'])->name('announce.update');
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'DeleteAnnounce'])->name('DeleteAnnounce');

    // E-Services
    Route::prefix('services')->group(function () {
        Route::get('/general-form', [E_Services::class, 'generalForm'])->name('general.form');
        Route::get('/business-permit', [E_Services::class, 'businessPermit'])->name('business.permit');
        Route::get('/barangay-id', [E_Services::class, 'barangayID'])->name('barangay.id');
        Route::get('/cedula', [E_Services::class, 'cedula'])->name('cedula');
    });

    // Barangay ID
    Route::post('/barangay-id/{id}/approveID', [BarangayIDController::class, 'approveID'])->name('approve.formID');
    Route::post('/barangay-id/{id}', [BarangayIDController::class, 'scheduleReleaseID'])->name('schedule.releaseID');
    Route::get('/barangay-id/{id}', [BarangayIDController::class, 'ShowBarangayID'])->name('barangayID.show');
    Route::post('/update/barangay-id', [BarangayIDController::class, 'UpdateBrgyID'])->name('UpdateBrgyID');
    Route::delete('/barangay-id/{id}/delete', [BarangayIDController::class, 'DeleteBrgyID'])->name('DeleteBrgyID');



    // General Form
    Route::post('/general-form/{id}/approveID', [GeneralFormController::class, 'approveGeneral'])->name('general.formID');
    Route::post('/general-form/{id}', [GeneralFormController::class, 'GeneralReleaseID'])->name('general.release');
    Route::get('/general-form/{id}', [GeneralFormController::class, 'show'])->name('generalID.show');
    Route::post('/update/general-form', [GeneralFormController::class, 'UpdateData'])->name('UpdateGeneralForm');
    Route::delete('/general-form/{id}/delete', [GeneralFormController::class, 'DeleteGeneralREcord'])->name('DeleteGeneralForm');

    // Cedula
    Route::post('/cedula/{id}/approveID', [CedulaController::class, 'approveCedula'])->name('approve.cedula');
    Route::post('/cedula/{id}', [CedulaController::class, 'CedulaRelease'])->name('cedula.release');
    Route::get('/cedula/{id}', [CedulaController::class, 'CedulaShow'])->name('cedula.show');
    Route::post('/update/cedula', [CedulaController::class, 'UpdateCedula'])->name('UpdateCedulaForm');
    Route::delete('/cedula/{id}/delete', [CedulaController::class, 'DeleteCedulaForm'])->name('DeleteCedulaForm');

    // Business Permit
    Route::post('/business-permit/{id}/approveID', [BusinessController::class, 'approveBusinessPermit'])->name('approve.business-permit');
    Route::post('/business-permit/{id}', [BusinessController::class, 'CedulaBusinessPermit'])->name('businessPermit.release');
    Route::get('/business-permit/{id}', [BusinessController::class, 'showbusinesspermit'])->name('Business.show');
    Route::post('/update/business-permit', [BusinessController::class, 'UpdateBusinessPermit'])->name('UpdateBusiness');
    Route::delete('/business-permit/{id}/delete', [BusinessController::class, 'DeleteBusinessPermit'])->name('DeleteBusinessRecord');

    //User Management

    Route::get('/Users', [UserManagement::class, 'ShowUsers'])->name('UserManage');
    Route::Post('/create/account', [UserManagement::class, 'AddAcc'])->name('AddUserAcc');
    Route::Post('/update/account', [UserManagement::class, 'UpdateAcc'])->name('UpdateUserAcc');
    Route::delete('/delete/account/{id}', [UserManagement::class, 'DeleteAcc'])->name('DeleteUserAccount');
});
