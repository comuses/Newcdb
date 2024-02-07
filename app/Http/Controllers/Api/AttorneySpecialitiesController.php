<?php

namespace App\Http\Controllers\Api;

use App\Models\Attorney;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpecialityResource;
use App\Http\Resources\SpecialityCollection;

class AttorneySpecialitiesController extends Controller
{
    public function index(
        Request $request,
        Attorney $attorney
    ): SpecialityCollection {
        $this->authorize('view', $attorney);

        $search = $request->get('search', '');

        $specialities = $attorney
            ->specialities()
            ->search($search)
            ->latest()
            ->paginate();

        return new SpecialityCollection($specialities);
    }

    public function store(
        Request $request,
        Attorney $attorney
    ): SpecialityResource {
        $this->authorize('create', Speciality::class);

        $validated = $request->validate([
            'attorneyID' => ['required', 'max:255', 'string'],
            'speciality' => ['required', 'max:255', 'string'],
        ]);

        $speciality = $attorney->specialities()->create($validated);

        return new SpecialityResource($speciality);
    }
}
