<?php

namespace App\Http\Controllers;

use App\Models\Attorney;
use Illuminate\View\View;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SpecialityStoreRequest;
use App\Http\Requests\SpecialityUpdateRequest;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Speciality::class);

        $search = $request->get('search', '');

        $specialities = Speciality::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.specialities.index',
            compact('specialities', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Speciality::class);

        $attorneys = Attorney::pluck('name', 'id');

        return view('app.specialities.create', compact('attorneys'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecialityStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Speciality::class);

        $validated = $request->validated();

        $speciality = Speciality::create($validated);

        return redirect()
            ->route('specialities.edit', $speciality)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Speciality $speciality): View
    {
        $this->authorize('view', $speciality);

        return view('app.specialities.show', compact('speciality'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Speciality $speciality): View
    {
        $this->authorize('update', $speciality);

        $attorneys = Attorney::pluck('name', 'id');

        return view(
            'app.specialities.edit',
            compact('speciality', 'attorneys')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SpecialityUpdateRequest $request,
        Speciality $speciality
    ): RedirectResponse {
        $this->authorize('update', $speciality);

        $validated = $request->validated();

        $speciality->update($validated);

        return redirect()
            ->route('specialities.edit', $speciality)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Speciality $speciality
    ): RedirectResponse {
        $this->authorize('delete', $speciality);

        $speciality->delete();

        return redirect()
            ->route('specialities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
