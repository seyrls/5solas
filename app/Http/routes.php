<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'LoginController@index');

Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');


Route::get('/account', 'DashboardController@show');
Route::get('/dashboard', 'DashboardController@index');

Route::get('/families', 'FamilyController@index');