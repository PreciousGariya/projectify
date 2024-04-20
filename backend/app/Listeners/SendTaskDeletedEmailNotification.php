<?php

namespace App\Listeners;

use App\Events\TaskDeleted;
use App\Mail\TaskDeletedNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskDeletedEmailNotification
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
    public function handle(TaskDeleted $event): void
    {
        $user = $event->task->user;
        $createdBy= $event->task->createdBy;
        Mail::to($user->email)->send(new TaskDeletedNotificationMail($event->task, $user->name,'user'));
        Mail::to($createdBy->email)->send(new TaskDeletedNotificationMail($event->task, $createdBy->name,'creater'));
    }
}
