<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeCollection;

class UserEmployeesController extends Controller
{
    public function index(Request $request, User $user): EmployeeCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $employees = $user
            ->employees()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmployeeCollection($employees);
    }

    public function store(Request $request, User $user): EmployeeResource
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
        ]);

        $employee = $user->employees()->create($validated);

        return new EmployeeResource($employee);
    }
}
