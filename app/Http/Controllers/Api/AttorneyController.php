<?php

namespace App\Http\Controllers\Api;

use App\Models\Attorney;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AttorneyResource;
use App\Http\Resources\AttorneyCollection;
use App\Http\Requests\AttorneyStoreRequest;
use App\Http\Requests\AttorneyUpdateRequest;

class AttorneyController extends Controller
{
    public function index(Request $request): AttorneyCollection
    {
        $this->authorize('view-any', Attorney::class);

        $search = $request->get('search', '');

        $attorneys = Attorney::search($search)
            ->latest()
            ->paginate();

        return new AttorneyCollection($attorneys);
    }

    public function store(AttorneyStoreRequest $request): AttorneyResource
    {
        $this->authorize('create', Attorney::class);

        $validated = $request->validated();

        $attorney = Attorney::create($validated);

        return new AttorneyResource($attorney);
    }

    public function show(Request $request, Attorney $attorney): AttorneyResource
    {
        $this->authorize('view', $attorney);

        return new AttorneyResource($attorney);
    }

    public function update(
        AttorneyUpdateRequest $request,
        Attorney $attorney
    ): AttorneyResource {
        $this->authorize('update', $attorney);

        $validated = $request->validated();

        $attorney->update($validated);

        return new AttorneyResource($attorney);
    }

    public function destroy(Request $request, Attorney $attorney): Response
    {
        $this->authorize('delete', $attorney);

        $attorney->delete();

        return response()->noContent();
    }
}
