<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employe;
// importer le hash et le storage
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|comptable|rh')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // affichage des Cinq employe recente
        $employes = Employe::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // affichage du profile de l'utilisateur actuellement connecté:
    public function profile()
    {
        return view('base/profileAdmins/profile', ['user' => auth()->user()]);
    }

    // affichage du formulaire de modification du profile de l'utilisateur actuellement connecté parmis admin rh et comptable:
    public function editProfile()
    {
        return view('base/profileAdmins/modifierprofile', ['user' => auth()->user()]);
    }

    // le traitement de l'edition avec tout les champs necessaire
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'prenom'         => 'nullable|string|max:255',
            'email'          => 'required|email|max:255|unique:employes,email,'.$user->id,
            'telephone'      => 'nullable|string|max:255',
            'adresse'        => 'nullable|string|max:255',
            'date_naissance' => 'nullable|date',
            'photo'          => 'nullable|image|max:2048',
            'password'       => 'nullable|string|min:6|confirmed',
        ]);

        // Gestion du mot de passe
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Gestion de la photo
        if ($request->hasFile('photo')) {
            // Supprimer l’ancienne si elle existe
            if ($user->photo && Storage::exists($user->photo)) {
                Storage::delete($user->photo);
            }
            $validated['photo'] = $request->file('photo')->store('employes');
        }

        // Mise à jour
        $user->update($validated);

        return redirect()->route('profile_admins')->with('success', 'Profil mis à jour avec succès.');
    }

}
