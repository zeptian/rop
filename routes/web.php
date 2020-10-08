<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes(['register' => false, 'password.request' => false]);

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/rop', 'RopController@index')->name('rop');
// Route::get('/rop/form', 'RopController@create')->name('rop.create');
// Route::post('/rop/form', 'RopController@store')->name('rop.store');
// Route::get('/rop/{id}',  'RopController@show')->name('rop.show');
// Route::get('/rop/edit/{id}',  'RopController@edit')->name('rop.edit');
// Route::put('/rop/edit/{id}',  'RopController@update')->name('rop.update');
// Route::delete('/rop/delete/{id}',  'RopController@destroy')->name('rop.destroy');


//plan
Route::get('/plan', 'PlanController@index')->name('plan');
Route::get('/plan/form', 'PlanController@create')->name('plan.create');
Route::post('/plan/form', 'PlanController@store')->name('plan.store');
// Route::get('/plan/{id}',  'PlanController@show')->name('plan.show');
Route::get('/plan/edit/{id}',  'PlanController@edit')->name('plan.edit');
Route::put('/plan/edit/{id}',  'PlanController@update')->name('plan.update');
Route::delete('/plan/delete/{id}',  'PlanController@destroy')->name('plan.destroy');

//real
Route::get('/real/form', 'RealController@create')->name('real.create');
Route::post('/real/form', 'RealController@store')->name('real.store');
Route::get('/real/{id}',  'RealController@show')->name('real.show');
Route::get('/real/edit/{id}',  'RealController@edit')->name('real.edit');
Route::put('/real/edit/{id}',  'RealController@update')->name('real.update');
Route::delete('/real/delete/{id}',  'RealController@destroy')->name('real.destroy');

Route::get('/ajax/subcategory', 'CategoryController@subcategory')->name('ajax.subcategory');