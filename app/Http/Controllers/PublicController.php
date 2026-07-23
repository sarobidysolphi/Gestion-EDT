<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Emploi;

class PublicController extends Controller
{
public function index(Request $request)
{
    $classes = Classe::all();

    // 1. On prépare la requête des emplois du temps
    $emplois = Emploi::with(['professeur', 'salle', 'classe']);

    // 2. On applique les filtres (Semestre, Niveau)
    if ($request->filled('semestre') && $request->semestre !== 'Tous') {
        $emplois->where('semestre', $request->semestre);
    }

    if ($request->filled('niveau') && $request->niveau !== 'Tous') {
        $emplois->whereHas('classe', function($q) use ($request) {
            $q->where('niveau', $request->niveau);
        });
    }

    $emplois = $emplois->get();

    // 3. SI AUCUN EMPLOI N'EST TROUVÉ, ON AFFICHE LA GRILLE VIDE MAIS ON GARDE LA SEMAINE
    $premiereDate = $emplois->first() ? $emplois->first()->date : now();
    $debutSemaine = \Carbon\Carbon::parse($premiereDate)->startOfWeek(\Carbon\Carbon::MONDAY);
    $finSemaine = (clone $debutSemaine)->endOfWeek(\Carbon\Carbon::SUNDAY);

    if ($request->ajax()) {
        return view('partials.emplois_table', compact('emplois', 'debutSemaine', 'finSemaine'))->render();
    }

    return view('accueil', compact('emplois', 'classes', 'debutSemaine', 'finSemaine'));
}
}
