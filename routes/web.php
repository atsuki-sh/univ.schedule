<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

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

// スケジュール画面の表示
Route::get('/{user_id}/schedule', [CourseController::class, 'show'])->name('course.index');
// コース作成
Route::post('/{user_id}/schedule/create', [CourseController::class, 'create']);
// コース編集
Route::post('/{user_id}/schedule/update', [CourseController::class, 'update']);
// コース削除
Route::post('/{user_id}/schedule/delete', [CourseController::class, 'delete']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
