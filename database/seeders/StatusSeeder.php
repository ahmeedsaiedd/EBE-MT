<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run()
    {
        Status::create([
            'name' => 'Open',
        ]);
        Status::create([
            'name' => 'In Progress DEV',
        ]);
        Status::create([
            'name' => 'In Review DEV',
        ]);
        Status::create([
            'name' => 'In Progress QC',
        ]);
        Status::create([
            'name' => 'In Review QC',
        ]);
        Status::create([
            'name' => 'Compelete',
        ]);
    }
}
