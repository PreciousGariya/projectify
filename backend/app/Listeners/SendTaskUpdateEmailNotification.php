<?php

namespace App\Listeners;

use App\Events\TaskUpdated;
use App\Mail\TaskUpdateNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskUpdateEmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TaskUpdated $event): void
    {
        $user = $event->task->user;
        $createdBy= $event->task->createdBy;
        Mail::to($user->email)->send(new TaskUpdateNotificationMail($event->task, $user->name,'user'));
        Mail::to($createdBy->email)->send(new TaskUpdateNotificationMail($event->task, $createdBy->name,'creater'));
    }
}
