<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(private readonly DepartmentService $departmentService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $departments = $this->departmentService->paginate($request->integer('per_page', 5));
        return response()->json($departments);
    }

    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        $department = $this->departmentService->create($request->validated());

        return response()->json($department, 201);
    }

    public function show(Department $department): JsonResponse
    {
        $department->load('salary');

        return response()->json($department);
    }

    public function update(StoreDepartmentRequest $request, Department $department): JsonResponse
    {
        $this->departmentService->update($department, $request->validated());

        return response()->json($department);
    }

    public function destroy(Department $department): JsonResponse
    {
        $this->departmentService->delete($department);

        return response()->json(null, 204);
    }
}
