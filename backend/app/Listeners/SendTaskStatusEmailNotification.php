<?php

namespace App\Listeners;

use App\Events\TaskStatusChanged;
use App\Mail\TaskStatusNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskStatusEmailNotification
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
    public function handle(TaskStatusChanged $event): void
    {
        $user = $event->task->user;
        $createdBy= $event->task->createdBy;
        Mail::to($user->email)->send(new TaskStatusNotificationMail($event->task, $event->newStatus,$user->name));
        Mail::to($createdBy->email)->send(new TaskStatusNotificationMail($event->task, $event->newStatus, $createdBy->name));
    }
}
