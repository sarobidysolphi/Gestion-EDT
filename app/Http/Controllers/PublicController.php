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

    // 1. Filtrage par Semestre
    if ($request->filled('semestre')) {
        $emplois->where('semestre', $request->semestre);
    }

    // 2. Filtrage par Niveau
    if ($request->filled('niveau')) {
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
