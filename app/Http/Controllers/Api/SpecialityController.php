<?php

namespace App\Http\Controllers\Api;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialityResource;
use App\Http\Resources\SpecialityCollection;
use App\Http\Requests\SpecialityStoreRequest;
use App\Http\Requests\SpecialityUpdateRequest;

class SpecialityController extends Controller
{
    public function index(Request $request): SpecialityCollection
    {
        $this->authorize('view-any', Speciality::class);

        $search = $request->get('search', '');

        $specialities = Speciality::search($search)
            ->latest()
            ->paginate();

        return new SpecialityCollection($specialities);
    }

    public function store(SpecialityStoreRequest $request): SpecialityResource
    {
        $this->authorize('create', Speciality::class);

        $validated = $request->validated();

        $speciality = Speciality::create($validated);

        return new SpecialityResource($speciality);
    }

    public function show(
        Request $request,
        Speciality $speciality
    ): SpecialityResource {
        $this->authorize('view', $speciality);

        return new SpecialityResource($speciality);
    }

    public function update(
        SpecialityUpdateRequest $request,
        Speciality $speciality
    ): SpecialityResource {
        $this->authorize('update', $speciality);

        $validated = $request->validated();

        $speciality->update($validated);

        return new SpecialityResource($speciality);
    }

    public function destroy(Request $request, Speciality $speciality): Response
    {
        $this->authorize('delete', $speciality);

        $speciality->delete();

        return response()->noContent();
    }
}
