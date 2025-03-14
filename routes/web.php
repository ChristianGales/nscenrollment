<?php

use App\Http\Controllers\test;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AcadYearController;
use App\Http\Controllers\Admin\GradeLevelController;

//landing page / login page
Route::get('/', function () {
    return view('auth.login');
});

// profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//user routes
Route::middleware(['auth', 'userMiddleware'])->group(function(){
    
    Route::get('dashboard', [UserController::class, 'index'])->name('dashboard');

    //ScheduleController  route
    Route::controller(ScheduleController::class)
        ->prefix('schedule')
        ->name('schedule.')
        ->group(function () {
            Route::get('', 'index')->name('index');

            Route::get('/create', 'create')->name('create');
            Route::post('', 'store')->name('store');

           
            Route::get('{schedule}/edit', 'edit')->name('edit');
            Route::put('{schedule}', 'update')->name('update');
           
            Route::delete('{schedule}', 'destroy')->name('destroy');

            Route::get('download-pdf', 'download')->name('download');
    });

    //test pdf
    Route::get('download-pdf', [test::class, 'download'])->name('download.pdf');

    


});


//admin routes
Route::middleware(['auth', 'adminMiddleware'])->group(function(){
    
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

  
    //grade level route
    Route::controller(GradeLevelController::class)
    ->prefix('admin/gradelevel')
        ->name('admin.grade.')
        ->group(function () {
            Route::get('', 'index')->name('index');

            Route::get('/create', 'create')->name('create'); 
            Route::post('', 'store')->name('store'); 

            Route::get('{gradeLevel}/edit', 'edit')->name('edit');
            Route::put('{gradeLevel}', 'update')->name('update');

            Route::delete('{gradeLevel}', 'destroy')->name('destroy'); 
            
    });

    //acad yr routes
    Route::prefix('admin/acadyear')
        ->name('admin.year.')
        ->controller(AcadYearController::class)
        ->group(function () {
            //show or view route
            Route::get('', 'index')->name('index');
            //store and create route
            Route::get('/create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            //active school yr route
            Route::post('{acadYear}/activate', 'activate')->name('activate');
            //edit & updateroute
            Route::get('{acadYear}/edit', 'edit')->name('edit');
            Route::put('{acadYear}', 'update')->name('update');
            //delete yr route
            Route::delete('{acadYear}', 'destroy')->name('destroy');
    });


    //techer routes
    Route::controller(TeacherController::class)
        ->prefix('admin/teachers')
        ->name('admin.teacher.')
        ->group(function() {
            Route::get('', 'index')->name('index');

            Route::get('/create', 'create')->name('create');
            Route::post('', 'store')->name('store');

           
            Route::get('{teacher}/edit', 'edit')->name('edit');
            Route::put('{teacher}', 'update')->name('update');
           
            Route::delete('{teacher}', 'destroy')->name('destroy');
            
    });

    //section routes
    Route::controller(SectionController::class)
        ->prefix('admin/sections')
        ->name('admin.section.')
        ->group(function (){
            Route::get('', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('', 'store')->name('store');

           
            Route::get('{section}/edit', 'edit')->name('edit');
            Route::put('{section}', 'update')->name('update');
           
            Route::delete('{section}', 'destroy')->name('destroy');

    });

    //subject routes
    Route::controller(SubjectController::class)
        ->prefix('admin/subjects')
        ->name('admin.subject.')
        ->group(function (){
            Route::get('', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('', 'store')->name('store');

           
            Route::get('{subject}/edit', 'edit')->name('edit');
            Route::put('{subject}', 'update')->name('update');
           
            Route::delete('{subject}', 'destroy')->name('destroy');
    });

    //student routes
    Route::controller(StudentController::class)
        ->prefix('admin/students')
        ->name('admin.student.')
        ->group(function (){
            Route::get('', 'index')->name('index');

            Route::get('/create', 'create')->name('create');
            Route::post('', 'store')->name('store');

           
            Route::get('{student}/edit', 'edit')->name('edit');
            Route::put('{student}', 'update')->name('update');
           
            Route::delete('{student}', 'destroy')->name('destroy');

            Route::get('{student}/show', 'show')->name('show');

            Route::get('{student}/download-pdf', 'download')->name('download');
        });


});

require __DIR__.'/auth.php';