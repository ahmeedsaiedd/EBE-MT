<?php

// app/Http/Controllers/CardController.php
namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        $card = Card::create($request->all());
        return response()->json($card, 201);
    }

    public function update(Request $request, Card $card)
    {
        $card->update($request->all());
        return response()->json($card);
    }

    public function destroy(Card $card)
    {
        $card->delete();
        return response()->json(null, 204);
    }
}

