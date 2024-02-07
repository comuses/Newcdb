<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventCollection;

class Case1EventsController extends Controller
{
    public function index(Request $request, Case1 $case1): EventCollection
    {
        $this->authorize('view', $case1);

        $search = $request->get('search', '');

        $events = $case1
            ->events()
            ->search($search)
            ->latest()
            ->paginate();

        return new EventCollection($events);
    }

    public function store(Request $request, Case1 $case1): EventResource
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
            'caseID' => ['required', 'max:255', 'string'],
            'eventType' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i:s'],
            'location' => ['required', 'max:255', 'string'],
            'outcome' => ['required', 'max:255', 'string'],
        ]);

        $event = $case1->events()->create($validated);

        return new EventResource($event);
    }
}
