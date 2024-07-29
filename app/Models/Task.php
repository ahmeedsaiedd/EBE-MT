<?php

// app/Models/Task.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['card_id', 'name'];

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
