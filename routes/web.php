<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToppageController;
use App\Http\Controllers\addpageController;

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

Route::get('/', 'ToppageController@show');
Route::get('/', 'ToppageController@func');

Route::get('/task_add', 'addpageController@show');

Route::get('/task_change', 'addpageController@show');
Route::post('/task_change', 'addpageController@func');

Route::post('/task_confirm','addpageController@form');

Route::post('/task_regist','addpageController@registration');

Route::get('/task_history', 'historyController@show');
Route::get('/task_history', 'historyController@func');

Route::post('/history_details','historyController@details');

Route::get('/task_achieve', 'achieveController@show');
Route::get('/task_achieve', 'achieveController@func');