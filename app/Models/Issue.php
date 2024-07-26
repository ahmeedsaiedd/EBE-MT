<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'issues';
    protected $fillable = [
        'project_id',
        'status_id',
        'name',
        'summary',
        'description',
        'epic_title',
        'epic_description',
        'user_story_description',
        'test_case_title',
        'test_case_description',
        'test_set_title',
        'test_set_description',
        'test_execution_title',
        'test_execution_description',
        'bug_title',
        'bug_description',
    ];

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
