<?php

namespace App\Http\Controllers;

use App\Models\Case1;
use App\Models\Attorney;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AttorneyStoreRequest;
use App\Http\Requests\AttorneyUpdateRequest;

class AttorneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Attorney::class);

        $search = $request->get('search', '');

        $attorneys = Attorney::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.attorneys.index', compact('attorneys', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Attorney::class);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.attorneys.create', compact('case1s'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttorneyStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Attorney::class);

        $validated = $request->validated();

        $attorney = Attorney::create($validated);

        return redirect()
            ->route('attorneys.edit', $attorney)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Attorney $attorney): View
    {
        $this->authorize('view', $attorney);

        return view('app.attorneys.show', compact('attorney'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Attorney $attorney): View
    {
        $this->authorize('update', $attorney);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.attorneys.edit', compact('attorney', 'case1s'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AttorneyUpdateRequest $request,
        Attorney $attorney
    ): RedirectResponse {
        $this->authorize('update', $attorney);

        $validated = $request->validated();

        $attorney->update($validated);

        return redirect()
            ->route('attorneys.edit', $attorney)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Attorney $attorney
    ): RedirectResponse {
        $this->authorize('delete', $attorney);

        $attorney->delete();

        return redirect()
            ->route('attorneys.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
