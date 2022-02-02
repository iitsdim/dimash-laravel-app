<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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

Route::get('/', 'App\Http\Controllers\WeatherController@show_forecast');

Route::post('books/{id?}/save', 'App\Http\Controllers\BookController@save');
Route::get('books/', 'App\Http\Controllers\BookController@index');
Route::get('books/{id}', 'App\Http\Controllers\BookController@get');
Route::get('books/{id}/delete', 'App\Http\Controllers\BookController@delete');
Route::get('books/{id}/edit', 'App\Http\Controllers\BookController@edit');


Route::post('authors/{id?}/save', 'App\Http\Controllers\AuthorController@save');
Route::get('authors/getAll', 'App\Http\Controllers\AuthorController@getAllJson');
Route::get('authors/', 'App\Http\Controllers\AuthorController@index');
Route::get('authors/{id}', 'App\Http\Controllers\AuthorController@get');
Route::get('authors/{id}/delete', 'App\Http\Controllers\AuthorController@delete');
Route::get('authors/{id}/edit', 'App\Http\Controllers\AuthorController@edit');

