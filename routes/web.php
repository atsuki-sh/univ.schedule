<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TaskController;

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
Route::post('/{user_id}/schedule/create', [CourseController::class, 'create'])->name('course.create');
// コース編集
Route::post('/{user_id}/schedule/update', [CourseController::class, 'update'])->name('course.update');
// コース削除
Route::post('/{user_id}/schedule/delete', [CourseController::class, 'delete'])->name('course.delete');

// タスク画面の表示
Route::get('/{user_id}/task', [TaskController::class, 'show'])->name('task.index');
// タスク作成
Route::post('/{user_id}/task/create', [TaskController::class, 'create'])->name('task.create');
// タスク編集
Route::post('/{user_id}/task/update', [TaskController::class, 'update'])->name('task.update');
// status編集(チェックボックス)
Route::post('/{user_id}/task/update_status', [TaskController::class, 'updateStatus'])->name('task.update.status');
// タスク削除
Route::post('/{user_id}/task/delete', [TaskController::class, 'delete'])->name('task.delete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
