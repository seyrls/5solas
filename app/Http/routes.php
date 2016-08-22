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
/*Login routes*/
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');

/*Dashboard routes*/
Route::get('/account', 'DashboardController@show');
Route::get('/dashboard', 'DashboardController@index');

/*Family rotes*/
Route::get('/families', 'FamilyController@index');
Route::get('/families/add', 'FamilyController@add');
Route::get('/families/edit/{id}', 'FamilyController@edit');
Route::post('/families/update', 'FamilyController@update');
Route::post('/families/delete', 'FamilyController@delete');
Route::post('/families/save', 'FamilyController@save');

/*Member routes*/
Route::get('/members', 'MemberController@index');
Route::get('/members/add', 'MemberController@add');
Route::post('/members/save', 'MemberController@save');
Route::get('/members/edit/{id}', 'MemberController@edit');
Route::post('/members/update', 'MemberController@update');
Route::get('/members/delete', 'MemberController@delete');

/*Type routes*/
Route::get('/types', 'TypeController@index');
Route::get('/types/add', 'TypeController@add');
Route::post('/types/save', 'TypeController@save');
Route::get('/types/edit/{id}', 'TypeController@edit');
Route::post('/types/update', 'TypeController@update');
Route::post('/types/delete', 'TypeController@delete');

/*Tithe routes*/
Route::get('/tithes', 'TitheController@index');
Route::get('/tithes/add', 'TitheController@add');
Route::post('/tithes/save', 'TitheController@save');
Route::get('/tithes/edit/{id}', 'TitheController@edit');
Route::post('/tithes/update', 'TitheController@update');
Route::post('/tithes/delete', 'TitheController@delete');