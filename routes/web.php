<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentTypeController;
use App\Http\Controllers\AppointmentStatusController;
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

Route::get('/appointment_types', [AppointmentTypeController::class, 'showView'])->name('appointment_type');
Route::get('/appointment_type/create', [AppointmentTypeController::class, 'showCreate'])->name('create-appointment_type');
Route::post('/appointment_type', [AppointmentTypeController::class, 'store'])->name('store-appointment_type');

Route::get('/appointment_statuses', [AppointmentStatusController::class, 'showView'])->name('appointment_status');
Route::get('/appointment_status/create', [AppointmentStatusController::class, 'showCreate'])->name('create-appointment_status');

// Auth::routes();

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');
