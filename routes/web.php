<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectsController;


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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('redirect', [HomeController::class, 'redirect']);

    Route::get('view_userstory', [AdminController::class, 'view_userstory']);
    Route::get('view_board', [AdminController::class, 'view_board']);
    Route::get('view_calender', [AdminController::class, 'view_calender']);
    Route::get('view_createproject', [AdminController::class, 'view_createproject']);

    Route::post('/UserStory', [AdminController::class, 'UserStory']);

    Route::get('/', [ProjectsController::class, 'index']);
    Route::get('admin/projects', [ProjectsController::class, 'viewAll'])->name('admin.projects');







    Route::post('project', [ProjectsController::class, 'store'])->name('project.store');

    Route::get('issues', [IssueController::class, 'index']);
    Route::get('issues/create', [IssueController::class, 'create']);
    Route::post('issues', [IssueController::class, 'store']);
    Route::get('issues/{id}/edit', [IssueController::class, 'edit']);
    Route::put('issues/{id}', [IssueController::class, 'update']);
    Route::delete('issues/{id}', [IssueController::class, 'destroy']);
});
