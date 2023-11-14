<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\AppointmentStatusController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/clients', [ClientController::class, 'showView'])->name('clients');
Route::get('/clients/create', [ClientController::class, 'showCreate'])->name('create-client');
Route::get('/clients/{id}/edit', [ClientController::class, 'showEdit'])->name('edit-client');

Route::get('/appointment_types', [AppointmentTypeController::class, 'showView'])->name('appointment_type');
Route::get('/appointment_type/create', [AppointmentTypeController::class, 'showCreate'])->name('create-appointment_type');
Route::post('/appointment_type', [AppointmentTypeController::class, 'store'])->name('store-appointment_type');
Route::get('/appointment_type/{id}/edit', [AppointmentTypeController::class, 'showEdit'])->name('edit-appointment_type');

Route::get('/appointment_statuses', [AppointmentStatusController::class, 'showView'])->name('appointment_status');
Route::get('/appointment_status/create', [AppointmentStatusController::class, 'showCreate'])->name('create-appointment_status');
Route::post('/appointment_status', [AppointmentStatusController::class, 'store'])->name('store-appointment_status');
Route::get('/appointment_status/{id}/edit', [AppointmentStatusController::class, 'showEdit'])->name('edit-appointment_status');

Route::get('/users', [UserController::class, 'showView'])->name('users');
Route::get('/users/create', [UserController:: class, 'showCreate'])->name('create-users');
Route::post('/users', [UserController::class, 'store'])->name('store-users');
Route::get('users/{id}/edit', [UserController::class, 'showEdit'])->name('edit-users');


// Auth::routes();

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');
