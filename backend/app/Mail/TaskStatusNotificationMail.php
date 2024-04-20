<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskStatusNotificationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $task;
    public $newStatus;
    public $name;
    public function __construct(Task $task, $newStatus, $name)
    {
        $this->task = $task;
        $this->newStatus = $newStatus;
        $this->name = $name;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject($this->name. '| Task Status Changed |'.$this->task->title )->markdown('emails.task-status-notification');
    }
}
