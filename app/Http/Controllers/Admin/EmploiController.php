<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Emploi;
use App\Models\Professeur;
use App\Models\Classe;
use App\Models\Salle;
use Illuminate\Http\Request;

class EmploiController extends Controller
{
    public function index()
    {
        $emplois = Emploi::with(['professeur', 'salle', 'classe'])->get();
        return view('admin.emplois.index', compact('emplois'));
    }

    public function create()
    {
        $professeurs = Professeur::all();
        $classes = Classe::all();
        $salles = Salle::all();
        return view('admin.emplois.create', compact('professeurs', 'classes', 'salles'));
    }

    public function store(Request $request)
    {
        // Validation des champs
        $request->validate([
            'cours' => 'required',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'semaine' => 'required|integer',
            'semestre' => 'required',
            'idprof' => 'required|exists:professeurs,idprof',
            'idclasse' => 'required|exists:classes,idclasse',
            'idsalle' => 'required|exists:salles,idsalle',
        ]);

        // Calcul automatique du jour de la semaine
        $jourSemaine = \Carbon\Carbon::parse($request->date)->locale('fr')->isoFormat('dddd');

        // Enregistrement
        Emploi::create([
            'cours' => $request->cours,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'jour_semaine' => $jourSemaine,
            'semaine' => $request->semaine,
            'semestre' => $request->semestre,
            'idprof' => $request->idprof,
            'idclasse' => $request->idclasse,
            'idsalle' => $request->idsalle,
        ]);

   return redirect()->route('emplois.index')->with('success', '✅ Emploi du temps ajouté avec succès !');
   
   }


    
    public function edit($id)
    {
        $emploi = Emploi::findOrFail($id);
        $professeurs = Professeur::all();
        $classes = Classe::all();
        $salles = Salle::all();
        return view('admin.emplois.edit', compact('emploi', 'professeurs', 'classes', 'salles'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'cours' => 'required',
            'date' => 'required|date',
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'semaine' => 'required|integer',
            'semestre' => 'required',
            'idprof' => 'required|exists:professeurs,idprof',
            'idclasse' => 'required|exists:classes,idclasse',
            'idsalle' => 'required|exists:salles,idsalle',
        ]);

        // Calcul automatique du jour de la semaine (comme dans store)
        $jourSemaine = \Carbon\Carbon::parse($request->date)->locale('fr')->isoFormat('dddd');

        $emploi = Emploi::findOrFail($id);
        $emploi->update([
            'cours' => $request->cours,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'jour_semaine' => $jourSemaine,
            'semaine' => $request->semaine,
            'semestre' => $request->semestre,
            'idprof' => $request->idprof,
            'idclasse' => $request->idclasse,
            'idsalle' => $request->idsalle,
        ]);

        return redirect()->route('emplois.index')->with('success', '✅ Emploi du temps modifié avec succès !');
    }

    public function destroy($id)
    {
        Emploi::findOrFail($id)->delete();
        return redirect()->route('emplois.index')->with('success', '✅ Emploi du temps supprimé avec succès !');
    }
}