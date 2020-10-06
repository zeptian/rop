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

Route::get('/rop', 'RopController@index')->name('rop');
Route::get('/rop/form', 'RopController@create')->name('rop.create');
Route::post('/rop/form', 'RopController@store')->name('rop.store');
Route::get('/rop/{id}',  'RopController@show')->name('rop.show');
Route::get('/rop/edit/{id}',  'RopController@edit')->name('rop.edit');
Route::put('/rop/edit/{id}',  'RopController@update')->name('rop.update');
Route::delete('/rop/delete/{id}',  'RopController@destroy')->name('rop.destroy');