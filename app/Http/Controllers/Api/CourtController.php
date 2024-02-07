<?php

namespace App\Http\Controllers\Api;

use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourtResource;
use App\Http\Resources\CourtCollection;
use App\Http\Requests\CourtStoreRequest;
use App\Http\Requests\CourtUpdateRequest;

class CourtController extends Controller
{
    public function index(Request $request): CourtCollection
    {
        $this->authorize('view-any', Court::class);

        $search = $request->get('search', '');

        $courts = Court::search($search)
            ->latest()
            ->paginate();

        return new CourtCollection($courts);
    }

    public function store(CourtStoreRequest $request): CourtResource
    {
        $this->authorize('create', Court::class);

        $validated = $request->validated();

        $court = Court::create($validated);

        return new CourtResource($court);
    }

    public function show(Request $request, Court $court): CourtResource
    {
        $this->authorize('view', $court);

        return new CourtResource($court);
    }

    public function update(
        CourtUpdateRequest $request,
        Court $court
    ): CourtResource {
        $this->authorize('update', $court);

        $validated = $request->validated();

        $court->update($validated);

        return new CourtResource($court);
    }

    public function destroy(Request $request, Court $court): Response
    {
        $this->authorize('delete', $court);

        $court->delete();

        return response()->noContent();
    }
}
