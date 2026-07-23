<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Emploi;

class PublicController extends Controller
{
public function index(Request $request)
{
    // 1. Récupérer toutes les classes pour remplir les listes déroulantes (Semestre, Niveau)
    $classes = Classe::all();

    // 2. Filtrer les emplois du temps
    $emplois = Emploi::with(['professeur', 'salle', 'classe']);

    if ($request->filled('semestre') && $request->semestre !== 'Tous') {
        $emplois->where('semestre', $request->semestre);
    }

    if ($request->filled('niveau') && $request->niveau !== 'Tous') {
        $emplois->whereHas('classe', function($q) use ($request) {
            $q->where('niveau', $request->niveau);
        });
    }

    $emplois = $emplois->get();

    if ($request->ajax()) {
        return view('partials.emplois_table', compact('emplois'))->render();
    }

    return view('accueil', compact('emplois', 'classes'));
}
}
