<?php

namespace App\Http\Controllers;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('created_from')) {
            $query->whereDate('created_at', '>=', $request->input('created_from'));
        }

        if ($request->filled('created_to')) {
            $query->whereDate('created_at', '<=', $request->input('created_to'));
        }

        if ($request->filled('employee_id')) {
            $query->whereHas('employees', function ($q) use ($request) {
                $q->where('employees.id', $request->input('employee_id'));
            });
        }

        $sortable = ['title', 'created_at', 'status'];
        $sortBy = in_array($request->input('sort_by'), $sortable)
            ? $request->input('sort_by')
            : 'created_at';

        $sortDir = $request->input('sort_dir') === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sortBy, $sortDir);

        return $query->paginate(20);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }

    public function groupedByStatus()
    {
        $tasks = Task::all()->groupBy('status');
        return response()->json($tasks);
    }

}
