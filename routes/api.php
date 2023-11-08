<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\AppointmentStatusController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/clients/{id}', [ClientController::class, 'delete'])->name('clients.delete');

Route::get('/appointmentType', [AppointmentTypeController::class, 'index']);
Route::get('/appointmentType/{id}', [AppointmentTypeController::class, 'show']);
Route::post('/appointmentType', [AppointmentTypeController::class, 'store']);
Route::put('/appointmentType/{id}', [AppointmentTypeController::class, 'update']);
Route::delete('/appointmentType/{id}', [AppointmentTypeController::class, 'delete']);

Route::get('/appointmentStatus', [AppointmentStatusController::class, 'index']);
Route::get('/appointmentStatus/{id}', [AppointmentStatusController::class, 'show']);
Route::post('/appointmentStatus', [AppointmentStatusController::class, 'store']);
Route::put('/appointmentStatus/{id}', [AppointmentStatusController::class, 'update']);
Route::delete('/appointmentStatus/{id}', [AppointmentStatusController::class, 'delete']);

