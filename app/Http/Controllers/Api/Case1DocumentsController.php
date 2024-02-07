<?php

namespace App\Http\Controllers\Api;

use App\Models\Case1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentCollection;

class Case1DocumentsController extends Controller
{
    public function index(Request $request, Case1 $case1): DocumentCollection
    {
        $this->authorize('view', $case1);

        $search = $request->get('search', '');

        $documents = $case1
            ->documents()
            ->search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    public function store(Request $request, Case1 $case1): DocumentResource
    {
        $this->authorize('create', Document::class);

        $validated = $request->validate([
            'caseID' => ['required', 'max:255', 'string'],
            'documentType' => ['required', 'max:255', 'string'],
            'dateFiled' => ['required', 'date'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $document = $case1->documents()->create($validated);

        return new DocumentResource($document);
    }
}
