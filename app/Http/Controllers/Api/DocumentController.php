<?php

namespace App\Http\Controllers\Api;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentResource;
use App\Http\Resources\DocumentCollection;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Requests\DocumentUpdateRequest;

class DocumentController extends Controller
{
    public function index(Request $request): DocumentCollection
    {
        $this->authorize('view-any', Document::class);

        $search = $request->get('search', '');

        $documents = Document::search($search)
            ->latest()
            ->paginate();

        return new DocumentCollection($documents);
    }

    public function store(DocumentStoreRequest $request): DocumentResource
    {
        $this->authorize('create', Document::class);

        $validated = $request->validated();

        $document = Document::create($validated);

        return new DocumentResource($document);
    }

    public function show(Request $request, Document $document): DocumentResource
    {
        $this->authorize('view', $document);

        return new DocumentResource($document);
    }

    public function update(
        DocumentUpdateRequest $request,
        Document $document
    ): DocumentResource {
        $this->authorize('update', $document);

        $validated = $request->validated();

        $document->update($validated);

        return new DocumentResource($document);
    }

    public function destroy(Request $request, Document $document): Response
    {
        $this->authorize('delete', $document);

        $document->delete();

        return response()->noContent();
    }
}
