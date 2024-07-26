<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'name' => 'Project-1',
            'type' => 'Scrum'
        ]);
        Project::create([
            'name' => 'Project-2',
            'type' => 'kanban'
        ]);
        Project::create([
            'name' => 'Project-3',
            'type' => 'Scrum'
        ]);
        Project::create([
            'name' => 'Project-4',
            'type' => 'kanban'
        ]);
    }
}
