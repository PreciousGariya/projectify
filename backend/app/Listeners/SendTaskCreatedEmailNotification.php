<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use App\Mail\TaskCreatedNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendTaskCreatedEmailNotification
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
    public function handle(TaskCreated $event): void
    {
        $user = $event->task->user;
        $createdBy= $event->task->createdBy;
        Mail::to($user->email)->send(new TaskCreatedNotificationMail($event->task, $user->name,'user'));
        Mail::to($createdBy->email)->send(new TaskCreatedNotificationMail($event->task, $createdBy->name,'creater'));
    }
}
