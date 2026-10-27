<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(5)->create();

        $tags = Tag::factory(4)->create();

        Organisation::factory(3)->create()->each(function ($organization) use ($tags) {

            Project::factory(2)->create([
                'organization_id' => $organization->id,
            ])->each(function ($project) use ($tags) {

                Task::factory(5)->create([
                    'project_id' => $project->id,
                ])->each(function ($task) use ($tags) {
                    // Attach 1 to 2 random tags to each task (Many-to-Many relationship)
                    $task->tags()->attach($tags->random(rand(1, 2))->pluck('id')->toArray());
                });

            });
        });
    }
}
