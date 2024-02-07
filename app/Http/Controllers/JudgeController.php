<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use App\Models\Court;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JudgeStoreRequest;
use App\Http\Requests\JudgeUpdateRequest;

class JudgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Judge::class);

        $search = $request->get('search', '');

        $judges = Judge::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.judges.index', compact('judges', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Judge::class);

        $courts = Court::pluck('name', 'id');

        return view('app.judges.create', compact('courts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JudgeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Judge::class);

        $validated = $request->validated();

        $judge = Judge::create($validated);

        return redirect()
            ->route('judges.edit', $judge)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Judge $judge): View
    {
        $this->authorize('view', $judge);

        return view('app.judges.show', compact('judge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Judge $judge): View
    {
        $this->authorize('update', $judge);

        $courts = Court::pluck('name', 'id');

        return view('app.judges.edit', compact('judge', 'courts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JudgeUpdateRequest $request,
        Judge $judge
    ): RedirectResponse {
        $this->authorize('update', $judge);

        $validated = $request->validated();

        $judge->update($validated);

        return redirect()
            ->route('judges.edit', $judge)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Judge $judge): RedirectResponse
    {
        $this->authorize('delete', $judge);

        $judge->delete();

        return redirect()
            ->route('judges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
