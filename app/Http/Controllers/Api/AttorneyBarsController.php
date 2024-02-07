<?php

namespace App\Http\Controllers\Api;

use App\Models\Attorney;
use Illuminate\Http\Request;
use App\Http\Resources\BarResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarCollection;

class AttorneyBarsController extends Controller
{
    public function index(Request $request, Attorney $attorney): BarCollection
    {
        $this->authorize('view', $attorney);

        $search = $request->get('search', '');

        $bars = $attorney
            ->bars()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarCollection($bars);
    }

    public function store(Request $request, Attorney $attorney): BarResource
    {
        $this->authorize('create', Bar::class);

        $validated = $request->validate([
            'attorneyID' => ['required', 'max:255', 'string'],
            'bar' => ['required', 'max:255', 'string'],
        ]);

        $bar = $attorney->bars()->create($validated);

        return new BarResource($bar);
    }
}
