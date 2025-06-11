<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EmployeeRoleController extends Controller
{
    public function assign(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $employee->roles()->syncWithoutDetaching([$data['role_id']]);

        return response()->json(['message' => 'Role assigned successfully'], Response::HTTP_OK);
    }

    public function remove(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'role_id' => ['required', 'exists:roles,id'],
        ]);

        $employee->roles()->detach($data['role_id']);

        return response()->json(['message' => 'Role removed successfully'], Response::HTTP_OK);
    }
}
