<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
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


Route::get('/api/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/api/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::post('/api/clients', [ClientController::class, 'store'])->name('clients.store');
Route::put('/api/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/api/clients/{id}', [ClientController::class, 'delete'])->name('clients.delete');


// Auth::routes();


// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');
