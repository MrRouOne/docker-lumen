<?php

namespace App\Events;

use App\Models\CourseUser;

class DoubleCourseEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $user_id;
    public $course_id;
    public function __construct($user_id,$course_id)
    {
        $this->user_id = $user_id;
        $this->course_id = $course_id;
    }
}

