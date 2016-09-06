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
Route::post('/members/delete', 'MemberController@delete');
Route::get('/members/detail/{id}', 'MemberController@detail');

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

/*Category routes*/
Route::get('/categories', 'CategoryController@index');
Route::get('/categories/add', 'CategoryController@add');
Route::post('/categories/save', 'CategoryController@save');
Route::get('/categories/edit/{id}', 'CategoryController@edit');
Route::post('/categories/update', 'CategoryController@update');
Route::post('/categories/delete', 'CategoryController@delete');

/*SubCategory routes*/
Route::get('/subcategories', 'SubcategoryController@index');
Route::get('/subcategories/add', 'SubcategoryController@add');
Route::post('/subcategories/save', 'SubcategoryController@save');
Route::get('/subcategories/edit/{id}', 'SubcategoryController@edit');
Route::post('/subcategories/update', 'SubcategoryController@update');
Route::post('/subcategories/delete', 'SubcategoryController@delete');

/*Account routes*/
Route::get('/accounts', 'AccountController@index');
Route::get('/accounts/add', 'AccountController@add');
Route::post('/accounts/save', 'AccountController@save');
Route::get('/accounts/edit/{id}', 'AccountController@edit');
Route::post('/accounts/update', 'AccountController@update');
Route::post('/accounts/delete', 'AccountController@delete');

/*User routes*/
Route::get('/users', 'UserController@index');
Route::get('/users/add', 'UserController@add');
Route::post('/users/save', 'UserController@save');
Route::get('/users/edit/{id}', 'UserController@edit');
Route::post('/users/update', 'UserController@update');
Route::post('/users/delete', 'UserController@delete');

/*Expenses routes*/
Route::get('/expenses', 'ExpenseController@index');
Route::get('/expenses/add', 'ExpenseController@add');
Route::post('/expenses/save', 'ExpenseController@save');
Route::get('/expenses/edit/{id}', 'ExpenseController@edit');
Route::post('/expenses/update', 'ExpenseController@update');
Route::post('/expenses/delete', 'ExpenseController@delete');

/*Entities routes*/
Route::get('/entities', 'EntityController@index');
Route::get('/entities/add', 'EntityController@add');
Route::post('/entities/save', 'EntityController@save');
Route::get('/entities/edit/{id}', 'EntityController@edit');
Route::post('/entities/update', 'EntityController@update');
Route::post('/entities/delete', 'EntityController@delete');

/*Reports routes*/
Route::get('/reports/tithesmember', 'ReportController@totalTithesMember');
Route::get('/reports/tithesdetail/{id}', 'ReportController@tithesDetail');
Route::match(['get', 'post'], '/reports/tithesperiod', 'ReportController@tithesPeriod');


/*See public/js/combobox.js for more details*/
Route::get('/combobox/subcategory/{id}', function ($id) {
    $d = new \App\Library\Combobox();

    return $d->getJquerySubCategory($id);
});
Route::get('/combobox/member/{id}', function ($id) {
    $d = new \App\Library\Combobox();

    return $d->getJqueryMember($id);
});