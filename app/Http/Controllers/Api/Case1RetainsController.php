<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetainResource;
use App\Http\Resources\RetainCollection;

class Case1RetainsController extends Controller
{
    public function index(Request $request, Case1 $case1): RetainCollection
    {
        $this->authorize('view', $case1);

        $search = $request->get('search', '');

        $retains = $case1
            ->retains()
            ->search($search)
            ->latest()
            ->paginate();

        return new RetainCollection($retains);
    }

    public function store(Request $request, Case1 $case1): RetainResource
    {
        $this->authorize('create', Retain::class);

        $validated = $request->validate([
            'attorneyID' => ['required', 'max:255', 'string'],
            'caseID' => ['required', 'max:255', 'string'],
            'emplooyID' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'attorney_id' => ['required', 'exists:attorneys,id'],
            'employee_id' => ['required', 'exists:employees,id'],
        ]);

        $retain = $case1->retains()->create($validated);

        return new RetainResource($retain);
    }
}
