<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Case1;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CourtStoreRequest;
use App\Http\Requests\CourtUpdateRequest;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Court::class);

        $search = $request->get('search', '');

        $courts = Court::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.courts.index', compact('courts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Court::class);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.courts.create', compact('case1s'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourtStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Court::class);

        $validated = $request->validated();

        $court = Court::create($validated);

        return redirect()
            ->route('courts.edit', $court)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Court $court): View
    {
        $this->authorize('view', $court);

        return view('app.courts.show', compact('court'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Court $court): View
    {
        $this->authorize('update', $court);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.courts.edit', compact('court', 'case1s'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CourtUpdateRequest $request,
        Court $court
    ): RedirectResponse {
        $this->authorize('update', $court);

        $validated = $request->validated();

        $court->update($validated);

        return redirect()
            ->route('courts.edit', $court)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Court $court): RedirectResponse
    {
        $this->authorize('delete', $court);

        $court->delete();

        return redirect()
            ->route('courts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
