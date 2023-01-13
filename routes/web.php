<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

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
    return view('content.welcome');
});

Route::resource('reservation', ReservationController::class);

Route::get('/search', function () {
    return view('content.search');
})->name('search');

Route::get('/calendar', function () {
    return view('content.calendar');
})->name('calendar');