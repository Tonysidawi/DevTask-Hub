<?php

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_edit_page_shows_the_current_project_and_saves_changes(): void
    {
        $organization = Organization::factory()->create();
        $user = User::factory()->create([
            'organization_id' => $organization->id,
        ]);
        $project = Project::factory()->create([
            'organization_id' => $organization->id,
            'name' => 'Billing rewrite',
            'description' => 'Replace the old invoices.',
            'status' => 'active',
        ]);

        $this->actingAs($user)
            ->get("/projects/{$project->id}/edit")
            ->assertOk()
            ->assertSee('Edit Project')
            ->assertSee('Billing rewrite')
            ->assertSee('Replace the old invoices.')
            ->assertSee('Update Project')
            ->assertSee('DevTask Hub')
            ->assertSee('Projects');

        $this->actingAs($user)
            ->put("/projects/{$project->id}", [
                'organization_id' => $organization->id,
                'name' => 'Billing rewrite v2',
                'description' => 'Replace the old invoices.',
                'status' => 'archived',
            ])
            ->assertRedirect("/projects/{$project->id}");

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'name' => 'Billing rewrite v2',
            'status' => 'archived',
        ]);
    }
}
