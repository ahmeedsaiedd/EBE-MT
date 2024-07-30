<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Task;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class KanbanController extends Controller
{
    // Show Kanban board
    public function index()
    {
        $tasks= Task::all();
        $cards = Card::with('tasks')->get();
        return view('kanban.index', compact('cards','tasks'));
    }

    // Store a new card
    public function storeCard(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $card = Card::create($request->all());
        return response()->json($card);
    }

    // Delete a card
    public function destroyCard($id)
    {
        $card = Card::findOrFail($id);
        $card->delete();
        // return response()->json(['message' => 'Card deleted']);
    }

    // Store a new task
    public function storeTask(Request $request, $cardId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $task = Task::create(array_merge($request->only('name', 'description'), ['card_id' => $cardId]));
        // return response()->json($task);
        return redirect()->back()->with('success', 'Card created successfully!');
    }

    // Delete a task
    public function destroyTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        // return response()->json(['message' => 'Task deleted']);
    }

    public function moveTask(Request $request, $id)
{
    $task = Task::findOrFail($id);
    $task->card_id = $request->input('card_id');
    $task->save();

    return response()->json(['success' => true]);
}


    // Update card information
    public function updateCard(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $card = Card::findOrFail($id);
        $card->update($request->only('name'));
        return response()->json(['message' => 'Card updated successfully!']);
    }
}
