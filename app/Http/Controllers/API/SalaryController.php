<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Salary\StoreSalaryRequest;
use App\Models\Salary;
use App\Services\SalaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct(private readonly SalaryService $salaryService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $salaries = $this->salaryService->paginate($request->integer('per_page', 5));
        return response()->json($salaries);
    }

    public function store(StoreSalaryRequest $request): JsonResponse
    {
        $salary = $this->salaryService->create($request->validated());

        return response()->json($salary, 201);
    }

    public function show(Salary $salary): JsonResponse
    {
        return response()->json($salary);
    }

    public function update(StoreSalaryRequest $request, Salary $salary): JsonResponse
    {
        $this->salaryService->update($salary, $request->validated());

        return response()->json($salary->fresh());
    }

    public function destroy(Salary $salary): JsonResponse
    {
        $this->salaryService->delete($salary);

        return response()->json(null, 204);
    }
}
