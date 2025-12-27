<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompletionController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\isEncoder;
use Illuminate\Support\Facades\Route;


Route::get('/create-programs',[ProgramController::class,'createPrograms']);
Route::get('/create-admin',[AuthController::class,'createAdmin']);

Route::middleware('auth')->group(function(){
    Route::get('/role-redirector',[AuthController::class,'roleRedirector'])->name('role-redirector');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::get('/change-password',[AuthController::class,'changePassword'])->name('change-password');
    Route::post('/change-password',[AuthController::class,'postChangePassword'])->name('post-change-password');
    Route::middleware(isEncoder::class)->group(function(){
        Route::post('/edit-subject/{subject}',[ProgramController::class,'postEditSubject'])->name('post-edit-subject');
        Route::get('/edit-subject/{subject}', [ProgramController::class,'editSubject'])->name('edit-subject');
        Route::post('/delete-subject/{subject}',[ProgramController::class,'deleteSubject'])->name('delete-subject');
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/curriculum',[ProgramController::class,'programs'])->name('curriculum');
        Route::get('/curriculum/{program}',[ProgramController::class,'manageCurriculum'])->name('manage-curriculum');
        Route::get('/add-curriculum-subject/{program}',[ProgramController::class,'addSubjectView'])->name('add-curriculum-subject');
        Route::post('/add-curriculum-subject/{program}',[ProgramController::class,'addCurriculumSubject'])->name('post-add-curriculum-subject');
        Route::get('/add-prerequisite/{subject}',[ProgramController::class,'addPrerequisiteView'])->name('add-prerequisite');
        Route::post('/add-prerequisite/{subject}',[ProgramController::class,'postAddPrerequisite'])->name('post-add-prerequisite');
        Route::get('/enrollment',[EnrollmentController::class,'enrollmentView'])->name('enrollment');
        Route::get('/enrollment-list/{program}',[EnrollmentController::class,'enrollmentList'])->name('enrollment-list');
        Route::get('/add-enrollee/{program}',[EnrollmentController::class,'addEnrolleeView'])->name('add-enrollee');
        Route::get('/add-student/{program}',[StudentController::class,'addStudentView'])->name('add-student');
        Route::post('/add-student',[StudentController::class,'postAddStudent'])->name('post-add-student');
        Route::get('/add-enrollment-subjects/{student}',[EnrollmentController::class,'addSubjects'])->name('add-enrollment-subjects');
        Route::get('/active-semester',[SemesterController::class,'activeSemester'])->name('active-semester');
        Route::post('/update-active-semester',[SemesterController::class,'updateActiveSemester'])->name('update-active-semester');
        Route::post('/add-enrolled-subject/{enrollment}',[EnrollmentController::class,'postAddEnrolledSubject'])->name('post-add-enrolled-subject');
        Route::get('/student-records',[StudentController::class,'viewStudentRecords'])->name('student-records');
        Route::get('/search-student',[StudentController::class,'searchStudent'])->name('search-student');
        Route::get('/searched-students',[StudentController::class,'searchedStudents'])->name('searched-students');
        Route::get('/student-record/{student}',[StudentController::class,'viewStudentRecord'])->name('student-record');
        Route::get('/search-student-grades',[StudentController::class,'grades'])->name('grades');
        Route::get('/view-grades/{enrollment}',[StudentController::class,'viewGrades'])->name('view-grades');
        Route::post('/update-grade/{subjectEnrolled}',[StudentController::class,'updateGrade'])->name('update-grade');
        Route::get('/list-of-graduates',[GraduateController::class,'listOfGraduates'])->name('list-of-graduates');
        Route::post('/apply-for-graduation/{student}',[GraduateController::class,'applyForGraduation'])->name('apply-for-graduation');
        Route::get('/enrollment-summary',[EnrollmentController::class,'enrollmentSummary'])->name('enrollment-summary');
        Route::post('/shift-program/{student}',[StudentController::class,'shiftProgram'])->name('shift-program');
        Route::get('/promotion-report',[AuthController::class,'promotionReport'])->name('promotion-report');
        Route::get('/first-generation-students',[StudentController::class,'firstGenerationStudents'])->name('first-generation-students');
        Route::get('/ip-students',[StudentController::class,'ipStudents'])->name('ip-students');
        Route::get('/solo-parent',[StudentController::class, 'soloParent'])->name('solo-parent');
        Route::get('/pwd-students',[StudentController::class,'pwdStudents'])->name('pwd-students');
        Route::get('/add-completion/{subjectEnrolled}',[CompletionController::class,'addCompletion'])->name('add-completion');
        Route::post('/add-completion/{subjectEnrolled}',[CompletionController::class,'postAddCompletion'])->name('post-add-completion');
    });
    Route::middleware(IsAdmin::class)->group(function(){
        Route::prefix('admin')->group(function(){
            Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('admin-dashboard');
            Route::get('/add-encoder',[AuthController::class,'addEncoder'])->name('add-encoder');
            Route::post('/add-encoder',[AuthController::class,'postAddEncoder'])->name('post-add-encoder');
        });
    });
});

Route::middleware('guest')->group(function(){
    Route::get('/',[AuthController::class,'loginView'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('post-login');
    Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('forgot-password');
    Route::post('/forgot-password',[AuthController::class,'postForgotPassword'])->name('post-forgot-password');
    Route::get('/reset-password/{token}', [AuthController::class, 'passwordReset'])->name('password.reset');
});