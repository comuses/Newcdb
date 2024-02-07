<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetainResource;
use App\Http\Resources\RetainCollection;

class EmployeeRetainsController extends Controller
{
    public function index(
        Request $request,
        Employee $employee
    ): RetainCollection {
        $this->authorize('view', $employee);

        $search = $request->get('search', '');

        $retains = $employee
            ->retains()
            ->search($search)
            ->latest()
            ->paginate();

        return new RetainCollection($retains);
    }

    public function store(Request $request, Employee $employee): RetainResource
    {
        $this->authorize('create', Retain::class);

        $validated = $request->validate([
            'attorneyID' => ['required', 'max:255', 'string'],
            'caseID' => ['required', 'max:255', 'string'],
            'emplooyID' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'case1_id' => ['required', 'exists:case1s,id'],
            'attorney_id' => ['required', 'exists:attorneys,id'],
        ]);

        $retain = $employee->retains()->create($validated);

        return new RetainResource($retain);
    }
}
