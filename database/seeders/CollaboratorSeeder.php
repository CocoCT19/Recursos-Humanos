<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collaborator;

class CollaboratorSeeder extends Seeder
{
    public function run(): void
    {
        Collaborator::create([
            'first_name' => 'Juan',
            'last_name' => 'Pérez',
            'document_type' => 'CC',
            'document_number' => '123456789',
            'birth_date' => '1995-06-15',
            'email' => 'juan.perez@empresa.com',
            'phone_number' => '3001234567',
            'address' => 'Bogotá'
        ]);

        Collaborator::create([
            'first_name' => 'María',
            'last_name' => 'Gómez',
            'document_type' => 'CC',
            'document_number' => '987654321',
            'birth_date' => '1998-03-22',
            'email' => 'maria.gomez@empresa.com',
            'phone_number' => '3109876543',
            'address' => 'Medellín'
        ]);
    }
}
