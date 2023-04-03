<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\QuestionAnswerController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Artisan;

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


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
        return "Storage Link Done";
});
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return "Cache Clear Done";
});
Route::get('/migrate-refresh', function () {
    Artisan::call('migrate');
    return "migration Done";
});
Route::get('/db-seed', function () {
    Artisan::call('migrate');
    return "Seed Done";
});
Route::get('/queue-job', function () {
    chdir('..');
    exec('queue:work');
    return "Queue Done";
});


Route::group(['middleware' => 'admin.redirect'], function () {
    Route::get('/admin-login', [AdminAuthController::class, 'showLoginPage'])->name('admin.login.page');
    Route::post('/admin-login', [AdminAuthController::class, 'Login'])->name('admin.login');
    Route::resource('/student-register', StudentController::class);
    Route::get('/forget-password', [AdminProfileController::class, 'ShowForgetPasswordPage'])->name('forget.password.page');
    Route::post('/forget-password', [AdminProfileController::class, 'ForgetPassword'])->name('forget.password');
    Route::get('/reset-password/{token?}/{email?}', [AdminProfileController::class, 'ResetPasswordLink'])->name('reset.password.page');
    Route::post('/reset-password/', [AdminProfileController::class, 'ResetPassword'])->name('reset.password');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/dashboard', [AdminPageController::class, 'showDashboardPage'])->name('admin.dashboard.page');
    Route::get('/profile', [AdminPageController::class, 'showProfilePage'])->name('admin.profile.page');
    Route::post('/profile', [AdminPageController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/profile-password', [AdminPageController::class, 'updatePassword'])->name('admin.password.update');
    Route::get('/admin-logout', [AdminAuthController::class, 'Logout'])->name('admin.logout.page');
    Route::get('/admin-user-status-update/{id}', [AdminController::class, 'updateStatus'])->name('admin.status.update');
    Route::get('/admin-user-trash-update/{id}', [AdminController::class, 'updateTrash'])->name('admin.trash.update');
    Route::get('/admin-trash', [AdminController::class, 'trashUsers'])->name('admin.trash');
    Route::get('/student-status-update/{id}', [StudentController::class, 'updateStatus'])->name('student.status.update');
    Route::get('/student-trash-update/{id}', [StudentController::class, 'updateTrash'])->name('student.trash.update');
    Route::get('/student-trash', [StudentController::class, 'trashStudent'])->name('student.trash');
    Route::get('/student-block', [StudentController::class, 'blockStudent'])->name('student.block');
    Route::get('/student-destroy/{id}', [StudentController::class, 'destroyStudent'])->name('student.destroy');
    Route::get('/student-ban/{id}', [StudentController::class, 'banStudent'])->name('student.ban');


});
Route::group(['middleware' =>'route.redirect'], function () {
    Route::resource('/permission', AdminPermissionController::class);
    Route::resource('/role', AdminRoleController::class);
    Route::resource('/admin-user', AdminController::class);
    Route::resource('/theme-option', ThemeController::class);
    Route::resource('/exam-controll', ExamController::class);
    Route::get('/verified-student', [StudentController::class, 'verifiedStudent'])->name('student.verified');
    Route::get('/unverified-student', [StudentController::class, 'unverifiedStudent'])->name('student.unverified');
    Route::get('/add-question', [QuestionAnswerController::class, 'index'])->name('question.view');
    Route::post('/add-question', [QuestionAnswerController::class, 'store'])->name('question.store');
    Route::get('/edit-question/{id}', [QuestionAnswerController::class, 'edit'])->name('question.edit');
    Route::post('/update-question/{id}', [QuestionAnswerController::class, 'update'])->name('question.update');
    Route::get('/round-1', [QuestionAnswerController::class, 'round1'])->name('round.one');
    Route::post('/round-1', [QuestionAnswerController::class, 'round1store'])->name('round.one.store');
    Route::get('/result', [QuestionAnswerController::class, 'result'])->name('result.index');

    Route::post('/add-question-from-excel', [QuestionAnswerController::class, 'importQuestionFromExcel']);

});


Route::get('/', [FrontendController::class, 'showHomePage'])->name('home.page');
