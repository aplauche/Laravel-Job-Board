<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobApplicationController;
use App\Http\Controllers\MyJobController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('', fn () => to_route('jobs.index'));

// JOBS
Route::resource('jobs', JobController::class)->only(['index', 'show']);

// AUTH
Route::get('login', fn () => to_route('auth.create'))->name('login');
Route::resource('auth', AuthController::class)->only(['create', 'store']);
// using a get verb would be easy since you could use an <a> tag, but using delete verb is more semantically correct
// delete protects agains CSRF by preventing links that hijack functionality of logout - instead we use form w csrf token
Route::delete('logout', fn () => to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])->name('auth.destroy');


// Job Applications
// calling group means middlware will apply to all routes within the callback
Route::middleware('auth')->group(function () {
  Route::resource('job.application', JobApplicationController::class)
    ->only(['create', 'store']);

  Route::resource('my-job-applications', MyJobApplicationController::class)->only(['index', 'destroy']);

  Route::resource('employer', EmployerController::class)->only(['create', 'store']);
});

// custom middleware for checking if user has created an employer associated with thier account
Route::middleware('employer')->group(function () {
  Route::resource('my-jobs', MyJobController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
