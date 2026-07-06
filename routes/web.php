<?php

use App\Http\Controllers\Admin\ProfesseurController;
use App\Http\Controllers\Admin\SalleController;
use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\EmploiController;
use App\Http\Controllers\ProfesseurController as ProfController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// --- PAGE D'ACCUEIL ---
Route::get('/', [PublicController::class, 'index'])->name('accueil');

// --- ROUTE PDF ---
Route::get('/generer-pdf', [PDFController::class, 'generer'])->name('pdf.generer');

// --- ROUTES ADMIN (PROTÉGÉES) ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Dashboard
      Route::get('/dashboard', function() { return view('admin.dashboard'); })->name('admin.dashboard');

    // Professeurs (CRUD complet)
      Route::resource('professeurs', ProfesseurController::class);

      Route::get('/salles/libres', function(\Illuminate\Http\Request $request) {
    $date = $request->date;
    $salles = \App\Models\Salle::all();
    $sallesLibres = [];

    foreach($salles as $salle) {
        $estOccupee = \App\Models\Emploi::where('idsalle', $salle->idsalle)
                                        ->where('date', $date)
                                        ->exists();
        if (!$estOccupee) {
            $sallesLibres[] = $salle;
        }
    }

    return response()->json($sallesLibres);
})->middleware('auth');
    
    // Salles (CRUD complet)
      Route::resource('salles', SalleController::class);
    
    // Classes (CRUD complet)
    Route::resource('classes', ClasseController::class);

    // --- EMPLOIS DU TEMPS (CRUD sur mesure pour la grille) ---
    // 1. Index (Liste des emplois)
    Route::get('/emplois', [EmploiController::class, 'index'])->name('emplois.index');

    // 2. Create (Formulaire avancé avec la grille)
    Route::get('/emplois/create', function() {
        // On a besoin d'envoyer les listes pour les listes déroulantes (si on veut les utiliser plus tard)
        $professeurs = \App\Models\Professeur::all();
        $classes = \App\Models\Classe::all();
        $salles = \App\Models\Salle::all();
        return view('admin.emplois.create', compact('professeurs', 'classes', 'salles'));
    })->name('emplois.create');

    
    Route::post('/emplois', [App\Http\Controllers\Admin\EmploiController::class, 'store'])->name('emplois.store');

    
    Route::get('/emplois/{id}/edit', [EmploiController::class, 'edit'])->name('emplois.edit');
    Route::put('/emplois/{id}', [EmploiController::class, 'update'])->name('emplois.update');

    Route::delete('/emplois/{id}', [EmploiController::class, 'destroy'])->name('emplois.destroy');

    

Route::get('/admin/salles/libres', function(Request $request) {
    $sallesOccupees = \App\Models\Emploi::where('date', $request->date)->pluck('idsalle');
    $sallesLibres = \App\Models\Salle::whereNotIn('idsalle', $sallesOccupees)->get();
    return response()->json($sallesLibres);
})->middleware('auth');

Route::get('/admin/emplois/get-salles', function(Request $request) {
    $date = $request->date;
    $salles = \App\Models\Salle::all();
    $result = [];

    foreach($salles as $salle) {
        $estOccupee = \App\Models\Emploi::where('idsalle', $salle->idsalle)
                    ->whereDate('date', $date)
                    ->exists();
        $result[] = [
            'idsalle' => $salle->idsalle,
            'design' => $salle->design,
            'occupation' => $estOccupee
        ];
    }

    return response()->json($result);
})->middleware('auth');


Route::get('/admin/salles/libres', function(Request $request) {
    $date = $request->date;
    $heure_debut = $request->heure_debut;
    $heure_fin = $request->heure_fin;

    // 1. Trouver les salles occupées à cette date et cette heure
    $sallesOccupees = \App\Models\Emploi::where('date', $date)
        ->where(function($q) use ($heure_debut, $heure_fin) {
            // Si un cours chevauche l'intervalle demandé
            $q->whereBetween('heure_debut', [$heure_debut, $heure_fin])
              ->orWhereBetween('heure_fin', [$heure_debut, $heure_fin])
              ->orWhere(function($q2) use ($heure_debut, $heure_fin) {
                  $q2->where('heure_debut', '<=', $heure_debut)
                     ->where('heure_fin', '>=', $heure_fin);
              });
        })->pluck('idsalle')->unique();

    // 2. Récupérer toutes les salles SAUF celles occupées
    $sallesLibres = \App\Models\Salle::whereNotIn('idsalle', $sallesOccupees)->get();

    return response()->json($sallesLibres);
})->middleware('auth');




Route::get('/admin/salles/libres', function(\Illuminate\Http\Request $request) {
    $date = $request->date;
    $salles = \App\Models\Salle::all();
    $sallesLibres = [];

    foreach($salles as $salle) {
        // On vérifie si cette salle a un cours à cette date précise
        $estOccupee = \App\Models\Emploi::where('idsalle', $salle->idsalle)
                                        ->where('date', $date)
                                        ->exists();
        if (!$estOccupee) {
            $sallesLibres[] = $salle;
        }
    }

    return response()->json($sallesLibres);
})->middleware('auth');


});






Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
})->middleware(['auth'])->name('dashboard');




require __DIR__.'/auth.php';