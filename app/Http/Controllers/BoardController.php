<?php

// app/Http/Controllers/BoardController.php
namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::with('cards.tasks')->get();
        return response()->json($boards);
    }

    public function store(Request $request)
    {
        $board = Board::create($request->all());
        return response()->json($board, 201);
    }

    public function update(Request $request, Board $board)
    {
        $board->update($request->all());
        return response()->json($board);
    }

    public function destroy(Board $board)
    {
        $board->delete();
        return response()->json(null, 204);
    }
}
