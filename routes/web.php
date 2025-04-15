<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\Backend\AnnouncementController;


Auth::routes();

Route::get('/login-view', [AdminController::class, 'loginView'])->name('login-view');
Route::get('/user-login', [AdminController::class, 'userLogin'])->name('login');

Route::get('/signin-view', [AdminController::class, 'signinView'])->name('signin-view');
Route::get('/create-user', [AdminController::class, 'createUser'])->name('create-user');

Route::group(['middleware' => ['admin']], function () {
    
    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['middleware' => ['headsir']], function () {
        Route::get('/teacher-view', [TeacherController::class, 'teacherView'])->name('teacher-view');
        Route::post('/create-teacher', [TeacherController::class, 'teacherCreate'])->name('teacher-add');

        Route::get('/student-view', [StudentController::class, 'studentView'])->name('student-view');
        Route::post('/create-student', [StudentController::class, 'studentCreate'])->name('student-add');

        Route::post('/task-create', [TaskController::class, 'taskCreate'])->name('task-add');
        Route::get('/tast-edit/{id}', [TaskController::class, 'taskEdit'])->name('task-edit');
        Route::get('/task-edit-update/{id}', [TaskController::class, 'taskUpdate'])->name('task-update');

        Route::get('/task-approved', [TaskController::class, 'taskApprovedView'])->name('task-approved-view');
        Route::get('/tasK-feedback-view/{id}', [TaskController::class, 'taskFeedbackView'])->name('task-feedback-view');

        Route::get('/task-approve/{id}', [TaskController::class, 'taskApprove'])->name('task-approve');
        Route::get('/task-reject/{id}', [TaskController::class, 'taskReject'])->name('task-reject');

        Route::post('/create-announcement', [AnnouncementController::class, 'createAnnouncement'])->name('create-announcement');
        Route::get('/announcement-edit/{id}', [AnnouncementController::class, 'announcementEdit'])->name('announcement-edit');
        Route::get('/announcement-delete/{id}', [AnnouncementController::class, 'announcementDelete']);
        Route::get('/announcement-edit-update/{id}', [AnnouncementController::class, 'announcementUpdate'])->name('announcement-Update');
    });

    Route::group(['middleware' => ['teacher']], function () {
        Route::get('/student-view', [StudentController::class, 'studentView'])->name('student-view');
        Route::post('/create-student', [StudentController::class, 'studentCreate'])->name('student-add');

        Route::post('/task-create', [TaskController::class, 'taskCreate'])->name('task-add');

        Route::get('/tast-delete/{id}', [TaskController::class, 'tastDelete']);
        Route::get('/tast-edit/{id}', [TaskController::class, 'taskEdit'])->name('task-edit');
        Route::get('/task-edit-update/{id}', [TaskController::class, 'taskUpdate'])->name('task-update');

        Route::get('/task-approved', [TaskController::class, 'taskApprovedView'])->name('task-approved-view');
    });

    Route::get('/task-view', [TaskController::class, 'taskView'])->name('task-view');
    Route::get('/task-submition/{id}', [TaskController::class, 'taskSubmition'])->name('task-submition');
    Route::get('/task-submition-updated/{id}', [TaskController::class, 'tastSubmitUpdated'])->name('task-submition-updated');

    Route::get('/announcement-view', [AnnouncementController::class, 'announcementView'])->name('announcement-view');
    Route::get('/view-announcement-specific/{id}', [AnnouncementController::class, 'announcementSpecific'])->name('announcement-specific');

    Route::get('/profile-view', [AdminController::class, 'profileView'])->name('profile-view');
    Route::post('/user-profile-update/{id}', [AdminController::class, 'profileUpdate']);
    Route::get('/password-view/{id}', [AdminController::class, 'passView']);
    Route::get('/password-update/{id}', [AdminController::class, 'passwordUpdate']);

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout']);

});