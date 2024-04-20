<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $now = Carbon::now();
        $deadline = Carbon::parse($this->deadline)->endOfDay(); // Consider the end of the day for comparison

        // Check if the deadline is overdue
        $isOverdue = $deadline->isPast();

        // Calculate the difference between now and the deadline
        $diff = $now->diff($deadline);

        // Format the difference for humans
        $deadlineLeft = $isOverdue ? 'Overdue' : ($diff->days > 0 ? $diff->format('%dd %hh %im') : 'Today');

        return [
            'id' => $this->id,
            'uid' => $this->uid,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'deadline_left' => $deadlineLeft,
            'deadline_formatted' => $deadline->format('d-M-Y'),
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'created_by' => $this->created_by,
            'created_by_name' => $this->createdBy->name,
            'created_at' => $this->created_at->diffForHumans(), // Format created_at timestamp
            'updated_at' => $this->updated_at->diffForHumans(), // Format updated_at timestamp
            // Add more fields as needed
        ];


    }
}
