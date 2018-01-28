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


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['middleware' => 'auth'], function (){
    Route::get("/", 'HomeController@index')->name('home');
    Route::get("/home", 'HomeController@index');

    /** Routes about tickets */
    Route::get("/ticket", 'TicketController@index')->name('ticket');
    Route::get('/ticket/adicionar', 'TicketController@create')->name('ticket.create');
    Route::post('/ticket/adicionar', 'TicketController@store')->name('ticket.store');




    //Route::delete('/linha/{id}', 'LineController@destroy')->name('line.delete');

});

Auth::routes();