<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use App\Models\Employe;

class GestionDocument extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->only(['index', 'create', 'store', 'edit', 'update', 'show', 'destroy']);
        //$this->middleware('role:rh')->only(['index', 'create', 'store', 'editer', 'update', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ajouter de pagination et recherche
        $search = request('search');
        $documents = Document::when($search, function ($query) use ($search) {
            return $query->where('nom', 'like', "%{$search}%");
        })->paginate(4);

        return view('base.GestionDocument.liste', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $employes=Employe::all();
        return view('base.GestionDocument.ajouter', compact('employes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:contrat,fiche_de_paie,cv,diplome,autre',
            'typefichier' => 'nullable|in:pdf,docx,jpg,png,autre',
            'description' => 'nullable|string',
            'chemin' => 'required|file|mimes:pdf,docx,jpg,jpeg,png|max:2048',
            'employe_id' => 'required|exists:employes,id',
        ]);

        // 2. Upload du fichier
        if ($request->hasFile('chemin')) {
            $file = $request->file('chemin');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public'); 
            $validated['chemin'] = $path;
        }

        // 3. Création du document
        Document::create($validated);

        // 4. Redirection avec message
        return redirect()->route('documents.index')
                        ->with('success', 'Document ajouté avec succès ✅');
        
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $document = Document::findOrFail($id);
        return view('base.GestionDocument.voir', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $document = Document::findOrFail($id);
        $employes = Employe::all();
        return view('base.GestionDocument.modifier', compact('document', 'employes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $document = Document::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'type' => 'required|in:contrat,fiche_de_paie,cv,diplome,autre',
            'typefichier' => 'nullable|in:pdf,docx,jpg,png,autre',
            'description' => 'nullable|string',
            'chemin' => 'nullable|file|mimes:pdf,docx,jpg,jpeg,png|max:2048',
            'employe_id' => 'required|exists:employes,id',
        ]);

        // 2. Upload du fichier
        if ($request->hasFile('chemin')) {
            $file = $request->file('chemin');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');
            $validated['chemin'] = $path;
        }

        // 3. Mise à jour du document
        $document->update($validated);

        // 4. Redirection avec message
        return redirect()->route('documents.index')
            ->with('success', 'Document modifié avec succès ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
