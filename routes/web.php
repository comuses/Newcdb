<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Case1Controller;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\RetainController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AttorneyController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\PermissionController;

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

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('employees', EmployeeController::class);
        Route::resource('users', UserController::class);
        Route::resource('case1s', Case1Controller::class);
        Route::resource('parties', PartyController::class);
        Route::resource('courts', CourtController::class);
        Route::resource('documents', DocumentController::class);
        Route::resource('events', EventController::class);
        Route::resource('attorneys', AttorneyController::class);
        Route::resource('bars', BarController::class);
        Route::resource('specialities', SpecialityController::class);
        Route::resource('judges', JudgeController::class);
        Route::resource('retains', RetainController::class);
    });
