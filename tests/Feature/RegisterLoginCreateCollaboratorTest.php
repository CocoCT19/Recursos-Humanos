<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterLoginCreateCollaboratorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_registers_logs_in_and_creates_collaborator()
    {
        
        $register = $this->post('/register', [
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $register->assertRedirect('/dashboard');

        
        $login = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $login->assertRedirect('/dashboard');

      
        $response = $this->post('/collaborators', [
            'first_name'      => 'Juan',
            'last_name'       => 'Pérez',
            'document_type'   => 'CC',
            'document_number' => '123456',
            'birth_date'      => '1999-06-15',
            'email'           => 'juan@test.com',
            'phone_number'    => '3001234567',
            'address'         => 'Calle 123',
        ]);

        
        $response->assertRedirect('/collaborators');

        
        $this->assertDatabaseHas('collaborators', [
            'document_number' => '123456',
        ]);
    }
}