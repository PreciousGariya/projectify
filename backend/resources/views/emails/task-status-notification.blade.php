@component('mail::message')
# Task Status Changed

The status of your task has been changed to: {{ $newStatus }}
@php
$now = \Carbon\Carbon::now();
$deadline = \Carbon\Carbon::parse($task->deadline)->endOfDay(); // Consider the end of the day for comparison
@endphp
Task Details:
- Task Title: {{ $task->title }}
- Description: {{ $task->description }}
- Deadline: {{ $deadline->format('d-M-Y'), }}
- Status: {{ $task->status, }}
- Updated At : {{$task->updated_at->diffForHumans()}}

You can view the task by clicking the button below:

@component('mail::button', ['url' => env('FRONTEND_URL') . '/tasks/' . $task->uid])
View Task
@endcomponent


Thank you for using our application!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
