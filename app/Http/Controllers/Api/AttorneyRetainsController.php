<?php

namespace App\Http\Controllers\Api;

use App\Models\Attorney;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetainResource;
use App\Http\Resources\RetainCollection;

class AttorneyRetainsController extends Controller
{
    public function index(
        Request $request,
        Attorney $attorney
    ): RetainCollection {
        $this->authorize('view', $attorney);

        $search = $request->get('search', '');

        $retains = $attorney
            ->retains()
            ->search($search)
            ->latest()
            ->paginate();

        return new RetainCollection($retains);
    }

    public function store(Request $request, Attorney $attorney): RetainResource
    {
        $this->authorize('create', Retain::class);

        $validated = $request->validate([
            'attorneyID' => ['required', 'max:255', 'string'],
            'caseID' => ['required', 'max:255', 'string'],
            'emplooyID' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'case1_id' => ['required', 'exists:case1s,id'],
            'employee_id' => ['required', 'exists:employees,id'],
        ]);

        $retain = $attorney->retains()->create($validated);

        return new RetainResource($retain);
    }
}
