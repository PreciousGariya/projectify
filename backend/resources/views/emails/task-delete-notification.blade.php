@component('mail::message')

@if($role==='user')
# Hi {{$task->user->name}}!
The Task was asign to you has beeen Deleted by {{$task->createdBy->name}}
@endif

@if($role==='creater')
# Hi {{$task->createdBy->name}}!
The Task  Asigned to {{$task->user->name}} has beeen Deleted successfully by you!
@endif

@php

$now = \Carbon\Carbon::now();
$deadline = \Carbon\Carbon::parse($task->deadline)->endOfDay(); // Consider the end of the day for comparison
@endphp
Task Details:
- Task Title: {{ $task->title }}
- Description: {{ $task->description }}
- Deadline: {{ $deadline->format('d-M-Y'), }}
- Status: {{ $task->status, }}
- Deleted At: {{ $task->deleted_at->format('d-M-Y h:i A') }}


You can view the task by clicking the button below:

@component('mail::button', ['url' => env('FRONTEND_URL') . '/tasks/' . $task->uid])
View Task
@endcomponent


Thank you for using our application!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
