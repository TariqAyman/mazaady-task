<?php

namespace App\Http\Controllers\Salary;

use App\Http\Controllers\Controller;
use App\Http\Requests\Salary\SalaryFilterRequest;
use App\Http\Requests\Salary\StoreSalaryRequest;
use App\Models\Employee;
use App\Models\Salary;
use App\Services\SalaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function __construct(private readonly SalaryService $salaryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $salaries = $this->salaryService->paginate($request->integer('per_page', 5));

        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salaries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalaryRequest $request)
    {
        $this->salaryService->create($request->validated());

        return redirect()
            ->route('salaries.index')
            ->with('success', 'Salary created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salary $salary)
    {
        return view('salaries.edit', compact('salary'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salary $salary)
    {
        return view('salaries.edit', compact('salary'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSalaryRequest $request, Salary $salary)
    {
        $this->salaryService->update($salary, $request->validated());

        return redirect()
            ->route('salaries.index')
            ->with('success', 'Salary updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salary $salary)
    {
        $this->salaryService->delete($salary);

        return redirect()
            ->route('salaries.index')
            ->with('success', 'Salary deleted successfully!');
    }
}
