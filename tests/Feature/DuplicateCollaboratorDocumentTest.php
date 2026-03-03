<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DuplicateCollaboratorDocumentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_rejects_creating_collaborator_with_duplicate_document_number()
    {
    
        $this->post('/register', [
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        
        $this->post('/collaborators', [
            'first_name'      => 'Juan',
            'last_name'       => 'Perez',
            'document_type'   => 'CC',
            'document_number' => '999999',
            'birth_date'      => '1995-01-01',
            'email'           => 'juan@test.com',
            'phone_number'    => '3000000000',
            'address'         => 'Calle 1',
        ])->assertRedirect('/collaborators');

        
        $response = $this->post('/collaborators', [
            'first_name'      => 'Pedro',
            'last_name'       => 'Gomez',
            'document_type'   => 'CC',
            'document_number' => '999999',
            'birth_date'      => '1998-01-01',
            'email'           => 'pedro@test.com',
            'phone_number'    => '3111111111',
            'address'         => 'Calle 2',
        ]);

       
        $response->assertStatus(302);

        $response->assertSessionHasErrors('document_number');

        $this->assertDatabaseCount('collaborators', 1);
    }
}