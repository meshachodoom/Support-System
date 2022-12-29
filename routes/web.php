<?php

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

Route::get('/', 'App\Http\Controllers\Auth\AuthController@index')->name('login');
Route::post('post-login', 'App\Http\Controllers\Auth\AuthController@postLogin')->name('login.post');

Route::get('registration', 'App\Http\Controllers\Auth\AuthController@registration')->name('register');
Route::post('post-registration', 'App\Http\Controllers\Auth\AuthController@postRegistration')->name('register.post');

Route::get('personaldashboard', 'App\Http\Controllers\Auth\AuthController@personaldashboard')->name('activities.personaldashboard');
Route::get('searchpersonal', 'App\Http\Controllers\ActivitiesController@searchpersonal')->name('activities.searchpersonal');
Route::get('dashboard', 'App\Http\Controllers\ActivitiesController@dashboard')->name('dashboard');
Route::get('search', 'App\Http\Controllers\ActivitiesController@search')->name('activities.search');

 Route::get('newactivity', 'App\Http\Controllers\ActivitiesController@newActivity')->name('activities.newactivity');
 Route::post('post-activity', 'App\Http\Controllers\ActivitiesController@store')->name('activities.store');

 Route::get('updateactivity/{id}', 'App\Http\Controllers\ActivitiesController@updateActivity')->name('activities.updateactivity');
 Route::post('post-update/{id}', 'App\Http\Controllers\ActivitiesController@update')->name('activities.update');

Route::get('logout', 'App\Http\Controllers\Auth\AuthController@logout')->name('logout');
