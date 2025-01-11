<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(private readonly EmployeeService $employeeService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $employees = $this->employeeService->paginate($request->integer('per_page', 5));

        return response()->json($employees);
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $employee = $this->employeeService->create($request->validated());

        return response()->json($employee, 201);
    }

    public function show(Employee $employee): JsonResponse
    {
        $employee->load('departments.salary');
        return response()->json($employee);
    }

    public function update(StoreEmployeeRequest $request, Employee $employee): JsonResponse
    {
        $this->employeeService->update($employee, $request->validated());

        return response()->json($employee);
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $this->employeeService->delete($employee);

        return response()->json(null, 204);
    }
}
