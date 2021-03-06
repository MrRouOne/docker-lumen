<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CourseUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'course_id' => Course::all()->random()->id,
            'percentage_passing' => random_int(0,100),
        ];
    }
}
