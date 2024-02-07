<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;

class Case1EmployeesController extends Controller
{
    public function index(Request $request, Case1 $case1): EmployeeCollection
    {
        $this->authorize('view', $case1);

        $search = $request->get('search', '');

        $employees = $case1
            ->employees()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmployeeCollection($employees);
    }

    public function store(Request $request, Case1 $case1): EmployeeResource
    {
        $this->authorize('create', Employee::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'zipcode' => ['required', 'max:255', 'string'],
            'telephone' => ['required', 'max:255', 'string'],
            'dob' => ['required', 'date'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $employee = $case1->employees()->create($validated);

        return new EmployeeResource($employee);
    }
}
