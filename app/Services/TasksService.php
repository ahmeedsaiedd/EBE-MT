<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllStatuses()
    {
        return Task::all();
    }
}
