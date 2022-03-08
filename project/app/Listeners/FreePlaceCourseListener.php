<?php

namespace App\Listeners;

use App\Events\DoubleCourseEvent;
use App\Events\FreePlaceCourseEvent;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FreePlaceCourseListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param FreePlaceCourseEvent $event
     */
    public function handle(FreePlaceCourseEvent $event)
    {
        $placeCount = Course::find($event->course_id)->student_capacity;
        $usersCount = CourseUser::where(['course_id' => $event->course_id])->get()->count();

        if ($usersCount >= $placeCount) {
            return false;
        }
    }
}


