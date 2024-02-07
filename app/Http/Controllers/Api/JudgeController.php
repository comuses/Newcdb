<?php

namespace App\Http\Controllers\Api;

use App\Models\Judge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\JudgeResource;
use App\Http\Resources\JudgeCollection;
use App\Http\Requests\JudgeStoreRequest;
use App\Http\Requests\JudgeUpdateRequest;

class JudgeController extends Controller
{
    public function index(Request $request): JudgeCollection
    {
        $this->authorize('view-any', Judge::class);

        $search = $request->get('search', '');

        $judges = Judge::search($search)
            ->latest()
            ->paginate();

        return new JudgeCollection($judges);
    }

    public function store(JudgeStoreRequest $request): JudgeResource
    {
        $this->authorize('create', Judge::class);

        $validated = $request->validated();

        $judge = Judge::create($validated);

        return new JudgeResource($judge);
    }

    public function show(Request $request, Judge $judge): JudgeResource
    {
        $this->authorize('view', $judge);

        return new JudgeResource($judge);
    }

    public function update(
        JudgeUpdateRequest $request,
        Judge $judge
    ): JudgeResource {
        $this->authorize('update', $judge);

        $validated = $request->validated();

        $judge->update($validated);

        return new JudgeResource($judge);
    }

    public function destroy(Request $request, Judge $judge): Response
    {
        $this->authorize('delete', $judge);

        $judge->delete();

        return response()->noContent();
    }
}
