<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;



Route::get('/create',[AuthController::class,'createAccounts']);
Route::get('/create-programs',[ProgramController::class,'createPrograms']);

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('/curriculum',[ProgramController::class,'programs'])->name('curriculum');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
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
});

Route::middleware('guest')->group(function(){
    Route::get('/',[AuthController::class,'loginView'])->name('login');
    Route::post('/login',[AuthController::class,'login'])->name('post-login');
});