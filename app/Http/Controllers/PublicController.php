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
    $emplois = Emploi::with(['professeur', 'salle', 'classe']);

      if ($request->filled('semestre') && $request->filled('niveau')) {
        $emplois->where('semestre', $request->semestre)
                ->whereHas('classe', function($q) use ($request) {
                    $q->where('niveau', $request->niveau);
                });
    } else {
        // Si un seul est présent, on renvoie une collection vide
        $emplois = Emploi::whereRaw('1 = 0'); // Aucun résultat
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
