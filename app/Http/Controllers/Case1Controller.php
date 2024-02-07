<?php

namespace App\Http\Controllers;

use App\Models\Case1;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Case1StoreRequest;
use App\Http\Requests\Case1UpdateRequest;

class Case1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Case1::class);

        $search = $request->get('search', '');

        $case1s = Case1::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.case1s.index', compact('case1s', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Case1::class);

        return view('app.case1s.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Case1StoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Case1::class);

        $validated = $request->validated();

        $case1 = Case1::create($validated);

        return redirect()
            ->route('case1s.edit', $case1)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Case1 $case1): View
    {
        $this->authorize('view', $case1);

        return view('app.case1s.show', compact('case1'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Case1 $case1): View
    {
        $this->authorize('update', $case1);

        return view('app.case1s.edit', compact('case1'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        Case1UpdateRequest $request,
        Case1 $case1
    ): RedirectResponse {
        $this->authorize('update', $case1);

        $validated = $request->validated();

        $case1->update($validated);

        return redirect()
            ->route('case1s.edit', $case1)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Case1 $case1): RedirectResponse
    {
        $this->authorize('delete', $case1);

        $case1->delete();

        return redirect()
            ->route('case1s.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
