<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// User routes
Route::get('/', [Controllers\HomeController::class,"index"])->middleware("auth")->name("home");
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', Controllers\IndexController::class)->name("index");

Route::get('/lessens/{academic_subject}', Controllers\Lessens\LessenManagerController::class)->middleware("auth")->name("lessens");

Route::get('/tasks/{lessen}', Controllers\Tasks\TaskManagerController::class)->middleware("auth")->name("tasks");
Route::get('/tasks/{lessen}/show', Controllers\Tasks\TaskShowController::class)->middleware("auth")->name("task.show");
Route::get('/tasks/show/{task}', [Controllers\Tasks\TaskShowController::class,'showTask'])->middleware("auth")->name("taskinfo.show");
Route::get('/finalytask/create', Controllers\Tasks\FinalyTaskCreateController::class)->middleware("auth")->name("finalytask.create");

Auth::routes();
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->name('password.reset');

Route::get('/info', App\Http\Controllers\Users\UserSettingsController::class)->middleware("auth")->name('userinfo');

//Admin Routes

Route::group(['namespace'=>"App\Http\Controllers\Admin", 'middleware'=>"admin_panel"], function (){
    Route::get("/admin", AdminController::class)->name("admin");
    Route::get("/admin/finaly-task", FinalyTaskController::class)->name("finaly_task.show");
    Route::group(['namespace'=>"Courses"], function (){
        Route::get("/admin/courses", ShowController::class)->name("courses.show");
        Route::get("/admin/courses/destroy", DestroyController::class)->name("courses.destroy");
        Route::get("/admin/courses/edit", UpdateController::class)->name("courses.edit");
        Route::get("/admin/courses/create", CreateController::class)->name("courses.create");
    });
    Route::group(['namespace'=>"Lessens"], function (){
        Route::get("/admin/lessens", ShowController::class)->name("lessens.show");
        Route::get("/admin/lessens/destroy", DestroyController::class)->name("lessens.destroy");
        Route::get("/admin/lessens/edit", UpdateController::class)->name("lessens.edit");
        Route::get("/admin/lessens/create", CreateController::class)->name("lessens.create");
    });
    Route::group(['namespace'=>"Tasks"], function (){
        Route::get("/admin/tasks", ShowController::class)->name("tasks.show");
        Route::get("/admin/tasks/lessens", [Controllers\Admin\Tasks\ShowController::class, 'loadLessens'])->name("tasks.show.lessen");
        Route::get("/admin/tasks/destroy", DestroyController::class)->name("tasks.destroy");
        Route::get("/admin/tasks/edit", UpdateController::class)->name("tasks.edit");
        Route::get("/admin/tasks/create", CreateController::class)->name("tasks.create");
    });
    Route::group(['namespace'=>"Students"], function (){
        Route::get("/admin/students", ShowController::class)->name("students.show");
        Route::get("/admin/students/destroy", DestroyController::class)->name("students.destroy");
        Route::get("/admin/students/edit", UpdateController::class)->name("students.edit");
//        Route::get("/admin/students/create", ShowController::class)->name("students.create");
    });




});
