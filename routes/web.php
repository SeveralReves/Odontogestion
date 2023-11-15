<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\AppointmentStatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;
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

// Clientes
Route::get('/clients', [ClientController::class, 'showView'])->name('clients');
Route::get('/clients/create', [ClientController::class, 'showCreate'])->name('create-client');
Route::get('/clients/{id}/edit', [ClientController::class, 'showEdit'])->name('edit-client');

Route::get('/api/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/api/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::post('/api/clients', [ClientController::class, 'store'])->name('clients.store');
Route::put('/api/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/api/clients/{id}', [ClientController::class, 'delete'])->name('clients.delete');

Route::get('/appointment_types', [AppointmentTypeController::class, 'showView'])->name('appointment_type');
Route::get('/appointment_type/create', [AppointmentTypeController::class, 'showCreate'])->name('create-appointment_type');
Route::post('/appointment_type', [AppointmentTypeController::class, 'store'])->name('store-appointment_type');
Route::get('/appointment_type/{id}/edit', [AppointmentTypeController::class, 'showEdit'])->name('edit-appointment_type');

Route::get('/api/appointment_types', [AppointmentTypeController::class, 'index'])->name('appointment_type.index');
Route::get('/api/appointment_type/{id}', [AppointmentTypeController::class, 'show'])->name('appointment_type.show');
Route::post('/api/appointment_type', [AppointmentTypeController::class, 'store'])->name('appointment_type.store');
Route::put('/api/appointment_type/{id}', [AppointmentTypeController::class, 'update'])->name('appointment_type.update');
Route::delete('/api/appointment_type/{id}', [AppointmentTypeController::class, 'delete'])->name('appointment_type.delete');


Route::get('/appointment_statuses', [AppointmentStatusController::class, 'showView'])->name('appointment_status');
Route::get('/appointment_status/create', [AppointmentStatusController::class, 'showCreate'])->name('create-appointment_status');
Route::post('/appointment_status', [AppointmentStatusController::class, 'store'])->name('store-appointment_status');
Route::get('/appointment_status/{id}/edit', [AppointmentStatusController::class, 'showEdit'])->name('edit-appointment_status');

Route::get('/api/appointment_statuses', [AppointmentStatusController::class, 'index'])->name('appointment_status.index');
Route::get('/api/appointment_status/{id}', [AppointmentStatusController::class, 'show'])->name('appointment_status.show');
Route::post('/api/appointment_status', [AppointmentStatusController::class, 'store'])->name('appointment_status.store');
Route::put('/api/appointment_status/{id}', [AppointmentStatusController::class, 'update'])->name('appointment_status.update');
Route::delete('/api/appointment_status/{id}', [AppointmentStatusController::class, 'delete'])->name('appointment_status.delete');

Route::get('/users', [UserController::class, 'showView'])->name('users');
Route::get('/users/create', [UserController:: class, 'showCreate'])->name('create-users');
Route::post('/users', [UserController::class, 'store'])->name('store-users');
Route::get('users/{id}/edit', [UserController::class, 'showEdit'])->name('edit-users');

Route::get('/api/users', [UserController::class, 'index'])->name('users.index');
Route::get('/api/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::post('/api/users', [UserController::class, 'store'])->name('users.store');
Route::put('/api/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/api/users/{id}', [UserController::class, 'delete'])->name('users.delete');

// Appointments
Route::get('/appointments', [AppointmentController::class, 'showView'])->name('appointments');
Route::get('/appointments/create', [AppointmentController::class, 'showCreate'])->name('create-appointments');
Route::get('/appointments/{id}/edit', [AppointmentController::class, 'showEdit'])->name('edit-appointments');

Route::get('/api/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/api/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::post('/api/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::put('/api/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/api/appointments/{id}', [AppointmentController::class, 'delete'])->name('appointments.delete');
