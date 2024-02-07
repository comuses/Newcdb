<?php

namespace App\Http\Controllers\Api;

use App\Models\Bar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\BarResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarCollection;
use App\Http\Requests\BarStoreRequest;
use App\Http\Requests\BarUpdateRequest;

class BarController extends Controller
{
    public function index(Request $request): BarCollection
    {
        $this->authorize('view-any', Bar::class);

        $search = $request->get('search', '');

        $bars = Bar::search($search)
            ->latest()
            ->paginate();

        return new BarCollection($bars);
    }

    public function store(BarStoreRequest $request): BarResource
    {
        $this->authorize('create', Bar::class);

        $validated = $request->validated();

        $bar = Bar::create($validated);

        return new BarResource($bar);
    }

    public function show(Request $request, Bar $bar): BarResource
    {
        $this->authorize('view', $bar);

        return new BarResource($bar);
    }

    public function update(BarUpdateRequest $request, Bar $bar): BarResource
    {
        $this->authorize('update', $bar);

        $validated = $request->validated();

        $bar->update($validated);

        return new BarResource($bar);
    }

    public function destroy(Request $request, Bar $bar): Response
    {
        $this->authorize('delete', $bar);

        $bar->delete();

        return response()->noContent();
    }
}
