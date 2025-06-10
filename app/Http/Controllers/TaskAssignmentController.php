<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskAssignmentController extends Controller
{
    public function assign(Task $task, Request $request)
    {
        $employeeIds = $request->validate([
            'employee_ids' => ['required', 'array'],
            'employee_ids.*' => ['integer', 'exists:employees,id'],
        ])['employee_ids'];

        $employees = Employee::whereIn('id', $employeeIds)->get();

        foreach ($employees as $employee) {
            if ($employee->status->value === 'vacation') {
                return response()->json([
                    'message' => "Employee {$employee->id} is on vacation and cannot be assigned."
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        $task->employees()->syncWithoutDetaching($employeeIds);

        return response()->json(['message' => 'Employees assigned successfully']);
    }

    public function unassign(Task $task, Request $request)
    {
        $employeeIds = $request->validate([
            'employee_ids' => ['required', 'array'],
            'employee_ids.*' => ['integer', 'exists:employees,id'],
        ])['employee_ids'];

        $task->employees()->detach($employeeIds);

        return response()->json(['message' => 'Employees unassigned successfully']);
    }
}
