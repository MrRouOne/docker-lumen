<?php

namespace App\Providers;

use App\Events\DoubleCourseEvent;
use App\Events\FreePlaceCourseEvent;
use App\Listeners\DoubleCourseListener;
use App\Listeners\FreePlaceCourseListener;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        DoubleCourseEvent::class => [
            DoubleCourseListener::class,
        ],
        FreePlaceCourseEvent::class => [
            FreePlaceCourseListener::class,
        ],
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
