<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'student_capacity' => random_int(10,35),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'has_certificate' => random_int(0,1),
        ];
    }
}
