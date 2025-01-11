<?php

namespace App\Http\Controllers;

use App\Http\Requests\Salary\SalaryFilterRequest;
use App\Services\SalaryService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(private readonly SalaryService $salaryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function __invoke(SalaryFilterRequest $request)
    {
        $employees = null;

        if ($nth = $request->integer('nth',0)) {
            $employees = $this->salaryService->getEmployeesHighestSalary($nth);
        }

        return view('dashboard', compact('employees', 'nth'));
    }
}
