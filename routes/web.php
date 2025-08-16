<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::get('/', [ServiceController::class, 'landingPage'])->name('Home');
Route::get('/services', [ServiceController::class, 'ShowServices'])->name('Services');

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/Admin', function () {
    return view('Admin.Admin');
});

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
