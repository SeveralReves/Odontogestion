<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
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

// Appointments
Route::get('/appointments', [AppointmentController::class, 'showView'])->name('appointments');
Route::get('/appointments/create', [AppointmentController::class, 'showCreate'])->name('create-appointments');
Route::get('/appointments/{id}/edit', [AppointmentController::class, 'showEdit'])->name('edit-appointments');

Route::get('/api/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/api/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::post('/api/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::put('/api/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/api/appointments/{id}', [AppointmentController::class, 'delete'])->name('appointments.delete');
