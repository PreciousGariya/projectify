<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string|max:1000',
            // 'status' => 'required|in:pending,completed,overdue',
            'deadline' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'description.required'=>'The description field is required.',
            'description.string'=>'The description must be a string.',
            'deadline.required' => 'The deadline field is required.',
            'deadline.date' => 'The deadline must be a valid date.',
            'user_id.required' => 'The user field is required.',
            'user_id.exists' => 'The selected user is invalid.',
        ];
    }
}
