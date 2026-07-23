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
   $classes = Classe::select('semestre')->distinct()->get();
    $emplois = Emploi::with(['professeur', 'salle', 'classe']);

    // Filtrer par Semestre (si la colonne existe)
    if ($request->filled('semestre') && $request->semestre !== 'Tous') {
        $emplois->where('semestre', $request->semestre);
    }

    // Filtrer par Niveau
    if ($request->filled('niveau') && $request->niveau !== 'Tous') {
        $emplois->whereHas('classe', function($q) use ($request) {
            $q->where('niveau', $request->niveau);
        });
    }

    // Si au moins un filtre est actif, on exécute la requête
    $emplois = $emplois->get();

    if ($request->ajax()) {
        return view('partials.emplois_table', compact('emplois'))->render();
    }

    return view('accueil', compact('emplois', 'classes'));
    
     // Récupère la première date trouvée ou utilise la date d'aujourd'hui
    $premierEmploi = $emplois->orderBy('date')->first();
    $dateReference = $premierEmploi ? $premierEmploi->date : now();

    // Calcul du début et fin de semaine
    $debutSemaine = \Carbon\Carbon::parse($dateReference)->startOfWeek(\Carbon\Carbon::MONDAY);
    $finSemaine = (clone $debutSemaine)->endOfWeek(\Carbon\Carbon::SUNDAY);

    $emplois = $emplois->get();

    return view('accueil', compact('emplois', 'classes', 'debutSemaine', 'finSemaine'));

}
}
