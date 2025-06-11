<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        return Employee::with('roles')->get();
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        return response()->json($employee, 201);
    }

    public function show(Employee $employee)
    {
        return $employee->load('roles');
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return response()->json($employee);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->noContent();
    }
}
