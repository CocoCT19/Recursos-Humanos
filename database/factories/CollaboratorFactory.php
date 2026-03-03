<?php

namespace Database\Factories;

use App\Models\Collaborator;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaboratorFactory extends Factory
{
    protected $model = Collaborator::class;

    public function definition(): array
    {
        return [
            'first_name'      => $this->faker->firstName,
            'last_name'       => $this->faker->lastName,
            'document_type'   => 'CC',
            'document_number' => $this->faker->unique()->numerify('########'),
            'birth_date'      => $this->faker->date(),
            'email'           => $this->faker->unique()->safeEmail,
            'phone_number'    => $this->faker->numerify('3#########'),
            'address'         => $this->faker->address,
        ];
    }
}
