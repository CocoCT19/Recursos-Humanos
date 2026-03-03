<?php

use App\Models\Collaborator;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_soft_delete_collaborator()
    {
        $user = User::factory()->create();
        $collaborator = Collaborator::factory()->create();

        $response = $this->actingAs($user)
            ->delete("/collaborators/{$collaborator->id}");

        $response->assertStatus(200);

        $this->assertSoftDeleted('collaborators', [
            'id' => $collaborator->id
        ]);
    }
}