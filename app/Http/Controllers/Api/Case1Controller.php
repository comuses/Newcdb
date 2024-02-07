<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\Case1Resource;
use App\Http\Resources\Case1Collection;
use App\Http\Requests\Case1StoreRequest;
use App\Http\Requests\Case1UpdateRequest;

class Case1Controller extends Controller
{
    public function index(Request $request): Case1Collection
    {
        $this->authorize('view-any', Case1::class);

        $search = $request->get('search', '');

        $case1s = Case1::search($search)
            ->latest()
            ->paginate();

        return new Case1Collection($case1s);
    }

    public function store(Case1StoreRequest $request): Case1Resource
    {
        $this->authorize('create', Case1::class);

        $validated = $request->validated();

        $case1 = Case1::create($validated);

        return new Case1Resource($case1);
    }

    public function show(Request $request, Case1 $case1): Case1Resource
    {
        $this->authorize('view', $case1);

        return new Case1Resource($case1);
    }

    public function update(
        Case1UpdateRequest $request,
        Case1 $case1
    ): Case1Resource {
        $this->authorize('update', $case1);

        $validated = $request->validated();

        $case1->update($validated);

        return new Case1Resource($case1);
    }

    public function destroy(Request $request, Case1 $case1): Response
    {
        $this->authorize('delete', $case1);

        $case1->delete();

        return response()->noContent();
    }
}
