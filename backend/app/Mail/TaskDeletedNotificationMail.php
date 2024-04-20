<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskDeletedNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $task;
    public $name;
    public $role;
    public function __construct(Task $task,$name,$role)
    {
        $this->task = $task;
        $this->name = $name;
        $this->role= $role;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject( $this->name .' | Task Deleted |'.$this->task->title)->markdown('emails.task-delete-notification');
    }
}
