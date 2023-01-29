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

// ログイン
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login');
// 新規登録
Route::get('/sign_up', 'LoginController@signUp');
Route::post('/sign_up', 'LoginController@register');
// ログアウト
Route::get('/logout', 'LoginController@logout');
// トップ
Route::get('/', 'ToppageController@index');
// タスク追加
Route::get('/task_add', 'TaskController@add');
Route::post('/task_confirm','TaskController@confirm');
Route::post('/task_regist','TaskController@registration');
// タスク編集
Route::get('/task_change/{id}', 'TaskController@detail');
// タスク履歴一覧
Route::get('/task_history', 'historyController@index');
// タスク履歴詳細
Route::get('/history_details/{id}','TaskController@detail');
// 達成率
Route::get('/task_achieve', 'achieveController@index');