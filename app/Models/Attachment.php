<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = ['issue_id', 'file_path'];

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }
}
