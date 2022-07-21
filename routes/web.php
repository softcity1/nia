<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/verify/otp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'verifyOpt'])->name('verify.otp');
Route::get('/reset/password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm']);
Route::post('/reset/user/password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('reset.user.password');

Route::get('/grant/access/{requestedId?}/{granterId?}', [App\Http\Controllers\UserController::class, 'grantPermission']);
Route::post('/grant/user/access/', [App\Http\Controllers\UserController::class, 'grantPermission']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    Route::post('/import/excel', [App\Http\Controllers\DashboardController::class, 'import']);
    Route::get('get/files', [App\Http\Controllers\DashboardController::class, 'getFiles']);


    Route::get('/report', [App\Http\Controllers\ReportController::class, 'index']);
    Route::get('/uploads', [App\Http\Controllers\UploadController::class, 'index']);
    Route::get('/audit/trail', [App\Http\Controllers\AuditTrailController::class, 'index']);
    Route::get('get/audit-trail', [App\Http\Controllers\AuditTrailController::class, 'getAuditTrail']);
    Route::get('/files', [App\Http\Controllers\FileController::class, 'index']);

    // Profile routes
    Route::get('/settings', [App\Http\Controllers\UserController::class, 'settings']);
    Route::post('/update/profile', [App\Http\Controllers\UserController::class, 'settings']);
    Route::post('/access/permission', [App\Http\Controllers\UserController::class, 'getPermission']);

    // User management routes
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create']);
    Route::POST('user/store', [App\Http\Controllers\UserController::class, 'store']);
    Route::get('user/show', [App\Http\Controllers\UserController::class, 'getUsers']);
    Route::get('user/{id?}/edit', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('delete/{user?}', [App\Http\Controllers\UserController::class, 'destroy']);
});