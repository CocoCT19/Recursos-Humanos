<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListCollaboratorsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_view_list_of_collaborators()
    {
        /** @var App\Models\User $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        Collaborator::factory()->count(3)->create();

        $response = $this->get('/collaborators');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}