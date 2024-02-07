<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Case1;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Event::class);

        $search = $request->get('search', '');

        $events = Event::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.events.index', compact('events', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Event::class);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.events.create', compact('case1s'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Event::class);

        $validated = $request->validated();

        $event = Event::create($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Event $event): View
    {
        $this->authorize('view', $event);

        return view('app.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Event $event): View
    {
        $this->authorize('update', $event);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.events.edit', compact('event', 'case1s'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EventUpdateRequest $request,
        Event $event
    ): RedirectResponse {
        $this->authorize('update', $event);

        $validated = $request->validated();

        $event->update($validated);

        return redirect()
            ->route('events.edit', $event)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        $event->delete();

        return redirect()
            ->route('events.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
