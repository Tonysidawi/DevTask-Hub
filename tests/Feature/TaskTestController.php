<?php

namespace Tests\Feature;

use App\Models\Organisation;
use App\Models\Project;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTestController extends TestCase
{
    use RefreshDatabase;

    public function test_create_page_saves_a_task_on_the_project(): void
    {
        $organization = Organisation::factory()->create();
        $user = User::factory()->create([
            'organization_id' => $organization->id,
        ]);
        $project = Project::factory()->create([
            'organization_id' => $organization->id,
            'name' => 'Billing rewrite',
        ]);
        $tag = Tag::factory()->create(['name' => 'Bug']);

        $this->actingAs($user)
            ->get('/projects/'.$project->id.'/tasks/create')
            ->assertOk()
            ->assertSee('Add a Task')
            ->assertSee('Billing rewrite')
            ->assertSee('Bug')
            ->assertDontSee('Select a project');

        $this->actingAs($user)
            ->post('/tasks', [
                'project_id' => $project->id,
                'title' => 'Write the invoice query',
                'description' => 'Cover overdue accounts.',
                'user_id' => $user->id,
                'priority' => 'high',
                'status' => 'todo',
                'due_date' => '2026-11-01',
                'tags' => [$tag->id],
            ])
            ->assertRedirect('/projects/'.$project->id);

        $task = $project->tasks()->where('title', 'Write the invoice query')->first();

        $this->assertNotNull($task);
        $this->assertTrue($task->tags->contains($tag));
        $this->assertSame($user->id, $task->user_id);
    }
}
