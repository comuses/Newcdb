<?php

namespace App\Http\Controllers\Api;

use App\Models\Retain;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetainResource;
use App\Http\Resources\RetainCollection;
use App\Http\Requests\RetainStoreRequest;
use App\Http\Requests\RetainUpdateRequest;

class RetainController extends Controller
{
    public function index(Request $request): RetainCollection
    {
        $this->authorize('view-any', Retain::class);

        $search = $request->get('search', '');

        $retains = Retain::search($search)
            ->latest()
            ->paginate();

        return new RetainCollection($retains);
    }

    public function store(RetainStoreRequest $request): RetainResource
    {
        $this->authorize('create', Retain::class);

        $validated = $request->validated();

        $retain = Retain::create($validated);

        return new RetainResource($retain);
    }

    public function show(Request $request, Retain $retain): RetainResource
    {
        $this->authorize('view', $retain);

        return new RetainResource($retain);
    }

    public function update(
        RetainUpdateRequest $request,
        Retain $retain
    ): RetainResource {
        $this->authorize('update', $retain);

        $validated = $request->validated();

        $retain->update($validated);

        return new RetainResource($retain);
    }

    public function destroy(Request $request, Retain $retain): Response
    {
        $this->authorize('delete', $retain);

        $retain->delete();

        return response()->noContent();
    }
}
