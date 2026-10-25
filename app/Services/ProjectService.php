<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    /**
     * Create a project and wrap everything in a database transaction.
     */
    public function createProject(array $data): Project
    {
        return DB::transaction(function () use ($data) {
            // 1. Create the core project
            $project = Project::create($data);

            // 2. Automatically generate a default "Getting Started" task for new projects
            $project->tasks()->create([
                'title' => 'Initial Project Setup',
                'description' => 'Review project requirements and assign team members.',
                'priority' => 'high',
                'status' => 'todo',
            ]);

            // 3. Return the fully built project
            return $project;
        });
    }
}
