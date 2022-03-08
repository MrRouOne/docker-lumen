<?php

namespace App\Events;

use App\Models\CourseUser;

class FreePlaceCourseEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $course_id;
    public function __construct($course_id)
    {
        $this->course_id = $course_id;
    }
}

