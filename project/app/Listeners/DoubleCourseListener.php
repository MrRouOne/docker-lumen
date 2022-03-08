<?php

namespace App\Listeners;

use App\Events\DoubleCourseEvent;
use App\Models\CourseUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DoubleCourseListener
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
     * @param DoubleCourseEvent $event
     */
    public function handle(DoubleCourseEvent $event)
    {
       $singleRecord =  CourseUser::where(['user_id'=>$event->user_id,
                                            'course_id'=>$event->course_id])->first();

       if (!empty($singleRecord)) {
           return false;
       }
    }
}


