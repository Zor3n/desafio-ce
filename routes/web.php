<?php

use App\Http\Controllers\CalendarController;
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
Route::post('search', [ReservationController::class, 'search']);


Route::get('/calendar', [CalendarController::class, 'get_data'])->name('calendar');