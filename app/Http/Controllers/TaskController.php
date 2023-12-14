<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $tasks = Task::where('user_id', $userId)->get();

        return $tasks;
    }

    public function store(Request $request)
    {
        if (Auth::check()) {
            $data = $request->validate([
                'name' => 'required|string',
                'completed' => 'required|boolean',
            ]);


            $task = $request->user()->tasks()->create($data);

            return $task;
        }
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'string',
            'completed' => 'boolean',
        ]);

        $task->update($data);

        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
