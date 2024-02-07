<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BarController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\Case1Controller;
use App\Http\Controllers\Api\PartyController;
use App\Http\Controllers\Api\CourtController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\JudgeController;
use App\Http\Controllers\Api\RetainController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\AttorneyController;
use App\Http\Controllers\Api\SpecialityController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\Case1CourtsController;
use App\Http\Controllers\Api\Case1EventsController;
use App\Http\Controllers\Api\CourtJudgesController;
use App\Http\Controllers\Api\Case1PartiesController;
use App\Http\Controllers\Api\Case1RetainsController;
use App\Http\Controllers\Api\AttorneyBarsController;
use App\Http\Controllers\Api\UserEmployeesController;
use App\Http\Controllers\Api\Case1DocumentsController;
use App\Http\Controllers\Api\Case1AttorneysController;
use App\Http\Controllers\Api\Case1EmployeesController;
use App\Http\Controllers\Api\EmployeeRetainsController;
use App\Http\Controllers\Api\AttorneyRetainsController;
use App\Http\Controllers\Api\AttorneySpecialitiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('employees', EmployeeController::class);

        // Employee Retains
        Route::get('/employees/{employee}/retains', [
            EmployeeRetainsController::class,
            'index',
        ])->name('employees.retains.index');
        Route::post('/employees/{employee}/retains', [
            EmployeeRetainsController::class,
            'store',
        ])->name('employees.retains.store');

        Route::apiResource('users', UserController::class);

        // User Employees
        Route::get('/users/{user}/employees', [
            UserEmployeesController::class,
            'index',
        ])->name('users.employees.index');
        Route::post('/users/{user}/employees', [
            UserEmployeesController::class,
            'store',
        ])->name('users.employees.store');

        Route::apiResource('case1s', Case1Controller::class);

        // Case1 Parties
        Route::get('/case1s/{case1}/parties', [
            Case1PartiesController::class,
            'index',
        ])->name('case1s.parties.index');
        Route::post('/case1s/{case1}/parties', [
            Case1PartiesController::class,
            'store',
        ])->name('case1s.parties.store');

        // Case1 Courts
        Route::get('/case1s/{case1}/courts', [
            Case1CourtsController::class,
            'index',
        ])->name('case1s.courts.index');
        Route::post('/case1s/{case1}/courts', [
            Case1CourtsController::class,
            'store',
        ])->name('case1s.courts.store');

        // Case1 Documents
        Route::get('/case1s/{case1}/documents', [
            Case1DocumentsController::class,
            'index',
        ])->name('case1s.documents.index');
        Route::post('/case1s/{case1}/documents', [
            Case1DocumentsController::class,
            'store',
        ])->name('case1s.documents.store');

        // Case1 Events
        Route::get('/case1s/{case1}/events', [
            Case1EventsController::class,
            'index',
        ])->name('case1s.events.index');
        Route::post('/case1s/{case1}/events', [
            Case1EventsController::class,
            'store',
        ])->name('case1s.events.store');

        // Case1 Attorneys
        Route::get('/case1s/{case1}/attorneys', [
            Case1AttorneysController::class,
            'index',
        ])->name('case1s.attorneys.index');
        Route::post('/case1s/{case1}/attorneys', [
            Case1AttorneysController::class,
            'store',
        ])->name('case1s.attorneys.store');

        // Case1 Employees
        Route::get('/case1s/{case1}/employees', [
            Case1EmployeesController::class,
            'index',
        ])->name('case1s.employees.index');
        Route::post('/case1s/{case1}/employees', [
            Case1EmployeesController::class,
            'store',
        ])->name('case1s.employees.store');

        // Case1 Retains
        Route::get('/case1s/{case1}/retains', [
            Case1RetainsController::class,
            'index',
        ])->name('case1s.retains.index');
        Route::post('/case1s/{case1}/retains', [
            Case1RetainsController::class,
            'store',
        ])->name('case1s.retains.store');

        Route::apiResource('parties', PartyController::class);

        Route::apiResource('courts', CourtController::class);

        // Court Judges
        Route::get('/courts/{court}/judges', [
            CourtJudgesController::class,
            'index',
        ])->name('courts.judges.index');
        Route::post('/courts/{court}/judges', [
            CourtJudgesController::class,
            'store',
        ])->name('courts.judges.store');

        Route::apiResource('documents', DocumentController::class);

        Route::apiResource('events', EventController::class);

        Route::apiResource('attorneys', AttorneyController::class);

        // Attorney Specialities
        Route::get('/attorneys/{attorney}/specialities', [
            AttorneySpecialitiesController::class,
            'index',
        ])->name('attorneys.specialities.index');
        Route::post('/attorneys/{attorney}/specialities', [
            AttorneySpecialitiesController::class,
            'store',
        ])->name('attorneys.specialities.store');

        // Attorney Bars
        Route::get('/attorneys/{attorney}/bars', [
            AttorneyBarsController::class,
            'index',
        ])->name('attorneys.bars.index');
        Route::post('/attorneys/{attorney}/bars', [
            AttorneyBarsController::class,
            'store',
        ])->name('attorneys.bars.store');

        // Attorney Retains
        Route::get('/attorneys/{attorney}/retains', [
            AttorneyRetainsController::class,
            'index',
        ])->name('attorneys.retains.index');
        Route::post('/attorneys/{attorney}/retains', [
            AttorneyRetainsController::class,
            'store',
        ])->name('attorneys.retains.store');

        Route::apiResource('bars', BarController::class);

        Route::apiResource('specialities', SpecialityController::class);

        Route::apiResource('judges', JudgeController::class);

        Route::apiResource('retains', RetainController::class);
    });
