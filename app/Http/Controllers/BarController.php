<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Attorney;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BarStoreRequest;
use App\Http\Requests\BarUpdateRequest;

class BarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Bar::class);

        $search = $request->get('search', '');

        $bars = Bar::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.bars.index', compact('bars', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Bar::class);

        $attorneys = Attorney::pluck('name', 'id');

        return view('app.bars.create', compact('attorneys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Bar::class);

        $validated = $request->validated();

        $bar = Bar::create($validated);

        return redirect()
            ->route('bars.edit', $bar)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Bar $bar): View
    {
        $this->authorize('view', $bar);

        return view('app.bars.show', compact('bar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Bar $bar): View
    {
        $this->authorize('update', $bar);

        $attorneys = Attorney::pluck('name', 'id');

        return view('app.bars.edit', compact('bar', 'attorneys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BarUpdateRequest $request,
        Bar $bar
    ): RedirectResponse {
        $this->authorize('update', $bar);

        $validated = $request->validated();

        $bar->update($validated);

        return redirect()
            ->route('bars.edit', $bar)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Bar $bar): RedirectResponse
    {
        $this->authorize('delete', $bar);

        $bar->delete();

        return redirect()
            ->route('bars.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
