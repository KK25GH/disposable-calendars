<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');

Route::resource('calendar', CalendarController::class, ['only' => ['index','create','store']]);

Route::get('calendar/edit', 'App\Http\Controllers\CalendarController@edit')->name('calendar.edit');

Route::post('calendar/update', 'App\Http\Controllers\CalendarController@update')->name('calendar.update');

//Route::get('/', 'App\Http\Controllers\CalendarController@index')->name('calendar');

