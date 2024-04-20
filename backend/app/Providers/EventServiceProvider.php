<?php

namespace App\Providers;

use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskStatusChanged;
use App\Events\TaskUpdated;
use App\Listeners\SendTaskCreatedEmailNotification;
use App\Listeners\SendTaskDeletedEmailNotification;
use App\Listeners\SendTaskStatusEmailNotification;
use App\Listeners\SendTaskUpdateEmailNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TaskStatusChanged::class => [
            SendTaskStatusEmailNotification::class
        ],
        TaskUpdated::class =>[
            SendTaskUpdateEmailNotification::class
        ],
        TaskCreated::class =>[
            SendTaskCreatedEmailNotification::class
        ],
        TaskDeleted::class =>[
            SendTaskDeletedEmailNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
