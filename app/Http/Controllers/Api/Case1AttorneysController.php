<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttorneyResource;
use App\Http\Resources\AttorneyCollection;

class Case1AttorneysController extends Controller
{
    public function index(Request $request, Case1 $case1): AttorneyCollection
    {
        $this->authorize('view', $case1);

        $search = $request->get('search', '');

        $attorneys = $case1
            ->attorneys()
            ->search($search)
            ->latest()
            ->paginate();

        return new AttorneyCollection($attorneys);
    }

    public function store(Request $request, Case1 $case1): AttorneyResource
    {
        $this->authorize('create', Attorney::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'state' => ['required', 'max:255', 'string'],
            'zipcode' => ['required', 'max:255', 'string'],
        ]);

        $attorney = $case1->attorneys()->create($validated);

        return new AttorneyResource($attorney);
    }
}
