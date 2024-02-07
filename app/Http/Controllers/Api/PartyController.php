<?php

namespace App\Http\Controllers\Api;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PartyResource;
use App\Http\Resources\PartyCollection;
use App\Http\Requests\PartyStoreRequest;
use App\Http\Requests\PartyUpdateRequest;

class PartyController extends Controller
{
    public function index(Request $request): PartyCollection
    {
        $this->authorize('view-any', Party::class);

        $search = $request->get('search', '');

        $parties = Party::search($search)
            ->latest()
            ->paginate();

        return new PartyCollection($parties);
    }

    public function store(PartyStoreRequest $request): PartyResource
    {
        $this->authorize('create', Party::class);

        $validated = $request->validated();

        $party = Party::create($validated);

        return new PartyResource($party);
    }

    public function show(Request $request, Party $party): PartyResource
    {
        $this->authorize('view', $party);

        return new PartyResource($party);
    }

    public function update(
        PartyUpdateRequest $request,
        Party $party
    ): PartyResource {
        $this->authorize('update', $party);

        $validated = $request->validated();

        $party->update($validated);

        return new PartyResource($party);
    }

    public function destroy(Request $request, Party $party): Response
    {
        $this->authorize('delete', $party);

        $party->delete();

        return response()->noContent();
    }
}
