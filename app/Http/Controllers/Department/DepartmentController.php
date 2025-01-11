<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\SalaryService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct(
        private readonly DepartmentService $departmentService,
        private readonly SalaryService     $salaryService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = $this->departmentService->paginate($request->integer('per_page', 5));

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salaries = $this->salaryService->all();
        return view('departments.create', compact('salaries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $this->departmentService->create($request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $salaries = $this->salaryService->all();

        return view('departments.edit', compact('department', 'salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $salaries = $this->salaryService->all();

        return view('departments.edit', compact('department', 'salaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDepartmentRequest $request, Department $department)
    {
        $this->departmentService->update($department, $request->validated());

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $this->departmentService->delete($department);

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully!');
    }
}
