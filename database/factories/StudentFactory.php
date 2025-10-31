<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //здесь как раз таки и создаются рандомные ытуденты с помощью faker
    protected $model = Student::class;
    public function definition(): array
    {
        return [
            'name'       => $this->faker->name(),
            'age'        => $this->faker->numberBetween(16, 100),
            'group'      => $this->faker->word(),
            'email'      => $this->faker->unique()->safeEmail(),
            'avatar_url' => $this->faker->optional()->imageUrl()
        ];
    }
}
