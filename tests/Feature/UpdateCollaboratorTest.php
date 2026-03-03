<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Collaborator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_update_existing_collaborator()
    {
        
        $this->post('/register', [
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);
        

      
        $collaborator = Collaborator::create([
            'first_name'      => 'Juan',
            'last_name'       => 'Perez',
            'document_type'   => 'CC',
            'document_number' => '111111',
            'birth_date'      => '1990-01-01',
            'email'           => 'juan@test.com',
            'phone_number'    => '3000000000',
            'address'         => 'Calle 1',
        ]);

        $response = $this->put("/collaborators/{$collaborator->id}", [
            'first_name'      => 'Juan Carlos',
            'last_name'       => 'Perez Gomez',
            'document_type'   => 'CC',
            'document_number' => '111111',
            'birth_date'      => '1990-01-01',
            'email'           => 'juan.carlos@test.com',
            'phone_number'    => '3111111111',
            'address'         => 'Calle Actualizada',
        ]);

   
        $response->assertRedirect('/collaborators');

        
        $this->assertDatabaseHas('collaborators', [
            'id'         => $collaborator->id,
            'first_name' => 'Juan Carlos',
            'email'      => 'juan.carlos@test.com',
            'address'    => 'Calle Actualizada',
        ]);
    }
}