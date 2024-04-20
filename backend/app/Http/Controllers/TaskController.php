<?php

namespace App\Http\Controllers;

use App\Events\TaskCreated;
use App\Events\TaskDeleted;
use App\Events\TaskStatusChanged;
use App\Events\TaskUpdated;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->input('per_page', 10); // Number of items per page, default is 10
            $page = $request->input('page', 1); // Page number, default is 1

            // Calculate the offset based on the page number
            $offset = ($page - 1) * $perPage;

            // Fetch tasks with pagination
            $tasks = Task::with(['user', 'createdBy'])
                ->where('created_by', auth()->guard('api')->user()->id)
                ->orWhere('user_id', auth()->guard('api')->user()->id)
                ->skip($offset)
                ->take($perPage)
                ->paginate($perPage);
            // Transform the paginated tasks using TaskResource
            $taskResource = TaskResource::collection($tasks);
            $paginationMetaData = $tasks->toArray();
            // Convert pagination links HTML to JSON
            $paginationLinks = collect($tasks->links()->elements)
                ->map(function ($link) {
                    return $link;
                });
            return response()->json([
                'status' => true,
                'data' => $taskResource,
                'meta' => [
                    'current_page' => $paginationMetaData['current_page'],
                    'per_page' => $paginationMetaData['per_page'],
                    'total' => $paginationMetaData['total'],
                    'last_page' => $paginationMetaData['last_page'],
                    'page' => $page, // Include the current page parameter
                    'links' =>  $paginationMetaData['links'], // Include Bootstrap pagination links
                ],
            ]);

            return response()->json(['status' => true, 'data' => $taskResource]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => [], 'message' => $th->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function status()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['created_by'] = auth()->guard('api')->user()->id;
            $task = Task::create($validatedData);
            event(new TaskCreated($task));
            return response()->json(['status' => true, 'data' => $task], 201);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => [], 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    try {
        $task = Task::with(['user', 'createdBy'])
            ->where('created_by', auth()->guard('api')->user()->id)
            ->where('uid', $id)
            ->firstOrFail();

        // Transform the task data using the TaskResource
        $taskResource = new TaskResource($task);

        return response()->json(['status' => true, 'data' => $taskResource]);
    } catch (\Throwable $th) {
        return response()->json(['status' => false, 'data' => [], 'message' => $th->getMessage()]);
    }
}

    /**
     * Show the form for editing the specified resource.
     */
    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|in:pending,completed,overdue',
        ]);

        // Find the task by ID
        $task = Task::where('uid',$id)->first();
        // Check if the task exists
        if(!$task){
            return response()->json(['message' => 'No data found', 'data'=>[], 'status'=>false]);
        }
        // Update the task status
        $task->status = $request->input('status');
        $task->save();
        event(new TaskStatusChanged($task, $request->input('status')));
        // Return a response
        return response()->json(['message' => 'Task status updated successfully']);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CreateTaskRequest $request, string $id)
    {
        // $validatedData = $request->validate([
        //     'title' => 'required|string',
        //     'description' => 'nullable|string',
        //     'status' => 'required|in:pending,completed,overdue',
        //     'deadline' => 'required|date',
        //     'user_id' => 'required|exists:users,id', // Ensure the user_id exists in the users table
        // ]);
        $validatedData = $request->validated();
        $task = Task::where('uid', $id)->first();
        if (!$task) {
            return response()->json(['status' => false, 'data' => [], 'message' => 'Task not found.'], 404);
        }

        $task->update($validatedData);
        event(new TaskUpdated($task));
        return response()->json(['status' => true, 'data' => $task, 'message' => 'Task updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $task = Task::where('uid', $id)->first();
            if (!$task) {
                return response()->json(['status' => false, 'data' => [], 'message' => 'Task not found.'], 404);
            }
            $task->delete();
            event(new TaskDeleted($task));
            return response()->json(['status' => true, 'data' => [], 'message' => 'Task deleted successfully.'], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'data' => [], 'message' => 'Something went wrong please try again.'], 404);
        }
    }
}
