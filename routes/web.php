<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('tickets', 'TicketsController@index')->name('tickets.index');
    Route::post('reservation', 'ReservationController@store')->name('reservation.store');
    Route::delete('reservation', 'ReservationController@destroy')->name('reservation.destroy');
    Route::post('lite-reservation', 'LiteReservationController@store')->name('lite-reservation.store');
});

/* DEV */
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
