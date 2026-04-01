<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    protected $model = \App\Models\Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subjects_name' => fake()->unique()->randomElement([
                'Data Structures',
                'Algorithms',
                'Operating Systems',
                'Database Management Systems',
                'Computer Networks',
                'Software Engineering',
                'Artificial Intelligence',
                'Machine Learning',
                'Cyber Security',
                'Web Development',
            ]),

        ];
    }
}
