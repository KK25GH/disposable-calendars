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

Route::get('calendar/delete_request', 'App\Http\Controllers\CalendarController@delete_request')->name('calendar.delete_request');

Route::post('calendar/delete_confirm', 'App\Http\Controllers\CalendarController@delete_confirm')->name('calendar.delete_confirm');


// Ajaxで実行するメソッドのルーティング
Route::post('memo/upsert_memo', 'App\Http\Controllers\MemoController@upsert_memo')->name('memo.upsert_memo');

