<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\KanbanController;

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
    Route::get('/', function () {
        return view('/');
    })->name('dashboard');

    Route::get('redirect', [HomeController::class, 'redirect']);

    Route::get('Issue', [AdminController::class, 'Issue']);
    Route::get('Board', [AdminController::class, 'Board']);
    Route::get('Calender', [AdminController::class, 'Calender']);
    Route::get('view_createproject', [AdminController::class, 'view_createproject']);

    Route::post('/UserStory', [AdminController::class, 'UserStory']);
    // Route::get('/admin/userstory', [AdminController::class, 'userstory'])->name('admin.userstory');
    Route::get('/userstory', [AdminController::class, 'Issue'])->name('issue');



    Route::get('/admin/story/dd', [AdminController::class, 'userstory'])->name('admin.story');


    Route::get('/', [DashboardController::class, 'index']);
    Route::get('admin/projects', [ProjectsController::class, 'viewAll'])->name('admin.projects');
    Route::get('/projects', [AdminController::class, 'projects'])->name('admin.projects');









    Route::post('project', [ProjectsController::class, 'store'])->name('project.store');

    Route::get('issues', [IssueController::class, 'index']);
    Route::get('issues/create', [IssueController::class, 'create']);
    
    Route::post('issues', [IssueController::class, 'store'])->name('issue.store');
    Route::get('issues/{id}/edit', [IssueController::class, 'edit']);
    Route::put('issues/{id}', [IssueController::class, 'update']);
    Route::delete('issues/{id}', [IssueController::class, 'destroy']);

    Route::get('issue', [AdminController::class, 'issue'])->name('admin.userstory');

    Route::get('issues', [IssueController::class, 'index']);


    // Route to show the Kanban board
    Route::get('/kanban', [KanbanController::class, 'index'])->name('kanban.index');

    // Route to add a new card
    Route::post('/kanban/cards', [KanbanController::class, 'storeCard'])->name('kanban.storeCard');

    // Route to delete a card
    Route::delete('/kanban/cards/{id}', [KanbanController::class, 'destroyCard'])->name('kanban.destroyCard');

    // Route to add a new task to a card
    Route::post('/kanban/cards/{cardId}/tasks', [KanbanController::class, 'storeTask'])->name('kanban.storeTask');

    // Route to delete a task
    Route::delete('/kanban/tasks/{id}', [KanbanController::class, 'destroyTask'])->name('kanban.destroyTask');

    // Route to update a task's column (move task)
    Route::put('/kanban/tasks/{id}/move', [KanbanController::class, 'moveTask'])->name('kanban.moveTask');

    // Route to update card information (e.g., title)
    Route::put('/kanban/cards/{id}', [KanbanController::class, 'updateCard'])->name('kanban.updateCard');
    Route::put('/kanban/tasks/{id}', [KanbanController::class, 'updateTask'])->name('kanban.updateTask');

    Route::get('/kanban', [KanbanController::class, 'index'])->name('kanban.index');
});
