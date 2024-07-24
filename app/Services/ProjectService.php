<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
   public function getAllProjetcs(){
      return Project::all();
   }
}

