<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeManagement;
use App\Http\Controllers\ResidentInformation;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\ApplicationController;


Route::get('/', [ServiceController::class, 'landingPage'])->name('Home');
Route::get('/services', [ServiceController::class, 'ShowServices'])->name('Services');

// Route::get('/login', function () {
//     return view('auth.login');
// });


// Route for displaying service form
Route::get('/service/{service_slug}', [ServiceController::class, 'showForm'])->name('service.form');

// Route for handling form submission
Route::post('/service/{service_slug}/submit', [ServiceController::class, 'submitForm'])->name('service.submit');


Route::get('/about', function () {
    return view('website.About');
})->name('About');

Route::get('/contact', function () {
    return view('website.Contact');
})->name('Contact');


Route::get('/login', [AuthController::class, "ShowLogin"])->name('loginPage');
Route::get('/register', [AuthController::class, 'ShowRegister'])->name('RegisterPage');

Route::get('/checkuser', function () {
    dd(Auth::user()->name ?? 'No Account LogIn');
});


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Google
Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'callback'])->name('auth.google.callback');







//adminSid

//employee management
Route::post('/addEmployee', [EmployeeManagement::class, 'AddEmp'])->name('AddEmployee');
Route::get('/employee', [EmployeeManagement::class, 'ShowEmp'])->name('ShowEmployee');

//resident information
Route::get('/resident', [ResidentInformation::class, 'ShowResident'])->name('ShowRes');

Route::post('/add-resident', [ResidentInformation::class, 'StoreResident'])->name('addResident');
// Show the form for editing a resident
Route::get('/residents/{id}/edit', [ResidentInformation::class, 'edit'])->name('residents.edit');

// Update resident's details
Route::put('/residents/{id}', [ResidentInformation::class, 'update'])->name('residents.update');
Route::post('/submit-application', [ApplicationController::class, 'submitForm'])->name('submit.application');


//dashboard
Route::get('/admin', function () {
    return view('AdminSide.Admin');
})->name('dash');
