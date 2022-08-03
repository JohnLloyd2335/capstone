<?php

use App\Http\Controllers\AdultController;
use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfantImmunizationController;
use App\Http\Controllers\PregnantController;
use App\Http\Controllers\RestoreImmunizationController;
use App\Http\Controllers\SchoolAgedChildrenController;
use App\Http\Controllers\SeniorCitizenController;
use App\Http\Controllers\VaccineController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
Route::resource('vaccines', VaccineController::class);
Route::resource('infant_immunizations', InfantImmunizationController::class);
Route::resource('school_aged_immunizations', SchoolAgedChildrenController::class);
Route::resource('pregnant_immunizations', PregnantController::class);
Route::resource('adult_immunizations',AdultController::class);
Route::resource('senior_citizen_immunizations', SeniorCitizenController::class);
Route::resource('/restore_immunization',RestoreImmunizationController::class)->name('restore_immunization','destroy');
Route::resource('archives',ArchiveController::class);
