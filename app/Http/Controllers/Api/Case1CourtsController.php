<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourtResource;
use App\Http\Resources\CourtCollection;

class Case1CourtsController extends Controller
{
    public function index(Request $request, Case1 $case1): CourtCollection
    {
        $this->authorize('view', $case1);

        $search = $request->get('search', '');

        $courts = $case1
            ->courts()
            ->search($search)
            ->latest()
            ->paginate();

        return new CourtCollection($courts);
    }

    public function store(Request $request, Case1 $case1): CourtResource
    {
        $this->authorize('create', Court::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'zipcode' => ['required', 'numeric'],
        ]);

        $court = $case1->courts()->create($validated);

        return new CourtResource($court);
    }
}
