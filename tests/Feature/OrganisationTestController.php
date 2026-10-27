<?php

namespace Tests\Feature;

use App\Models\Organisation;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganisationTestController extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_sees_only_their_organisations_projects(): void
    {
        $organisation = Organisation::factory()->create(['name' => 'Acme']);
        $other = Organisation::factory()->create(['name' => 'Other Co']);
        $user = User::factory()->create([
            'organization_id' => $organisation->id,
        ]);

        Project::factory()->create([
            'organization_id' => $organisation->id,
            'name' => 'Billing rewrite',
        ]);
        Project::factory()->create([
            'organization_id' => $other->id,
            'name' => 'Secret project',
        ]);

        $this->actingAs($user)
            ->get('/organisations')
            ->assertOk()
            ->assertSee('Acme')
            ->assertSee('Billing rewrite')
            ->assertDontSee('Secret project')
            ->assertDontSee('Other Co');
    }
}
