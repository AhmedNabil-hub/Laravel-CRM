<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()
        ->count(30)
        ->hasTasks(3)
        ->forUser(1)
        ->forClient(1)
        ->create();
    }
}
