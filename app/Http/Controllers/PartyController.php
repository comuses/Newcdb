<?php

namespace App\Http\Controllers;

use App\Models\Party;
use App\Models\Case1;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PartyStoreRequest;
use App\Http\Requests\PartyUpdateRequest;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Party::class);

        $search = $request->get('search', '');

        $parties = Party::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.parties.index', compact('parties', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Party::class);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.parties.create', compact('case1s'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartyStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Party::class);

        $validated = $request->validated();

        $party = Party::create($validated);

        return redirect()
            ->route('parties.edit', $party)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Party $party): View
    {
        $this->authorize('view', $party);

        return view('app.parties.show', compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Party $party): View
    {
        $this->authorize('update', $party);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.parties.edit', compact('party', 'case1s'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PartyUpdateRequest $request,
        Party $party
    ): RedirectResponse {
        $this->authorize('update', $party);

        $validated = $request->validated();

        $party->update($validated);

        return redirect()
            ->route('parties.edit', $party)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Party $party): RedirectResponse
    {
        $this->authorize('delete', $party);

        $party->delete();

        return redirect()
            ->route('parties.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
