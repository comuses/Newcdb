<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PartyResource;
use App\Http\Resources\PartyCollection;

class Case1PartiesController extends Controller
{
    public function index(Request $request, Case1 $case1): PartyCollection
    {
        $this->authorize('view', $case1);

        $search = $request->get('search', '');

        $parties = $case1
            ->parties()
            ->search($search)
            ->latest()
            ->paginate();

        return new PartyCollection($parties);
    }

    public function store(Request $request, Case1 $case1): PartyResource
    {
        $this->authorize('create', Party::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'attonery' => ['required', 'max:255', 'string'],
        ]);

        $party = $case1->parties()->create($validated);

        return new PartyResource($party);
    }
}
