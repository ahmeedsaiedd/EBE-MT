<?php

// app/Http/Controllers/TaskController.php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function updateTask(Request $request, $id)
{
    $task = Task::find($id);
    if (!$task) {
        return response()->json(['message' => 'Task not found'], 404);
    }

    $task->card_id = $request->input('card_id');
    $task->save();

    return response()->json(['message' => 'Task updated successfully']);
}

    public function destroyTask($id)
{
    $task = Task::find($id);
    
    if ($task) {
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }
    
    return response()->json(['message' => 'Task not found.'], 404);
}

}

