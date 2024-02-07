<?php

namespace App\Http\Controllers;

use App\Models\Case1;
use App\Models\Retain;
use App\Models\Attorney;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RetainStoreRequest;
use App\Http\Requests\RetainUpdateRequest;

class RetainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Retain::class);

        $search = $request->get('search', '');

        $retains = Retain::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.retains.index', compact('retains', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Retain::class);

        $case1s = Case1::pluck('partyID', 'id');
        $attorneys = Attorney::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');

        return view(
            'app.retains.create',
            compact('case1s', 'attorneys', 'employees')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RetainStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Retain::class);

        $validated = $request->validated();

        $retain = Retain::create($validated);

        return redirect()
            ->route('retains.edit', $retain)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Retain $retain): View
    {
        $this->authorize('view', $retain);

        return view('app.retains.show', compact('retain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Retain $retain): View
    {
        $this->authorize('update', $retain);

        $case1s = Case1::pluck('partyID', 'id');
        $attorneys = Attorney::pluck('name', 'id');
        $employees = Employee::pluck('name', 'id');

        return view(
            'app.retains.edit',
            compact('retain', 'case1s', 'attorneys', 'employees')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RetainUpdateRequest $request,
        Retain $retain
    ): RedirectResponse {
        $this->authorize('update', $retain);

        $validated = $request->validated();

        $retain->update($validated);

        return redirect()
            ->route('retains.edit', $retain)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Retain $retain): RedirectResponse
    {
        $this->authorize('delete', $retain);

        $retain->delete();

        return redirect()
            ->route('retains.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
