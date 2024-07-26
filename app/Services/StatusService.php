<?php

namespace App\Services;

use App\Models\Status;

class StatusService
{
    public function getAllStatuses()
    {
        return Status::all();
    }
}
