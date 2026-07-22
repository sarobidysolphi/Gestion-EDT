<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Professeur;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
{
    // On utilise une méthode très simple pour récupérer les données
    $professeurs = \App\Models\Professeur::all();
    
    // On vérifie si des données existent (pour le débogage)
    if ($professeurs->isEmpty()) {
        return view('admin.professeurs.index', compact('professeurs'))->with('message', 'Aucun professeur trouvé');
    }
    
    return view('admin.professeurs.index', compact('professeurs'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.professeurs.create');
    }

   public function store(Request $request)
{
    Professeur::create([
        'Nom' => $request->Nom,
        'Prenoms' => $request->Prenoms,
        'Grade' => $request->Grade,
    ]);
    return redirect()->route('professeurs.index')->with('success', '✅ Professeur ajouté avec succès !');
}

public function update(Request $request, $idprof)
{
    $prof = Professeur::findOrFail($idprof);
    $prof->update([
        'Nom' => $request->Nom,
        'Prenoms' => $request->Prenoms,
        'Grade' => $request->Grade,
    ]);
    return redirect()->route('professeurs.index')->with('success', '✅ Professeur modifié avec succès !');
}

public function destroy($idprof)
{
    Professeur::findOrFail($idprof)->delete();
    return redirect()->route('professeurs.index')->with('success', '✅ Professeur supprimé avec succès !');
}

       public function edit($idprof)
{
    // On récupère le professeur grâce à son ID
    $professeur = Professeur::findOrFail($idprof);

    // On envoie la variable à la vue
    return view('admin.professeurs.edit', compact('professeur'));
}
}
