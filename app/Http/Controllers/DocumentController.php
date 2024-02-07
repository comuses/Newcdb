<?php

namespace App\Http\Controllers;

use App\Models\Case1;
use App\Models\Document;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Requests\DocumentUpdateRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Document::class);

        $search = $request->get('search', '');

        $documents = Document::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.documents.index', compact('documents', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Document::class);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.documents.create', compact('case1s'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DocumentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Document::class);

        $validated = $request->validated();

        $document = Document::create($validated);

        return redirect()
            ->route('documents.edit', $document)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Document $document): View
    {
        $this->authorize('view', $document);

        return view('app.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Document $document): View
    {
        $this->authorize('update', $document);

        $case1s = Case1::pluck('partyID', 'id');

        return view('app.documents.edit', compact('document', 'case1s'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DocumentUpdateRequest $request,
        Document $document
    ): RedirectResponse {
        $this->authorize('update', $document);

        $validated = $request->validated();

        $document->update($validated);

        return redirect()
            ->route('documents.edit', $document)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Document $document
    ): RedirectResponse {
        $this->authorize('delete', $document);

        $document->delete();

        return redirect()
            ->route('documents.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
