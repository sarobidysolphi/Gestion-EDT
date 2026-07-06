<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salle;
use App\Models\Emploi;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    public function index()
    {
        $salles = Salle::all();
        foreach($salles as $salle) {
            $estOccupee = Emploi::where('idsalle', $salle->idsalle)->exists();
            $salle->occupation = $estOccupee;
        }
        return view('admin.salles.index', compact('salles'));
    }

    public function create()
    {
        return view('admin.salles.create');
    }

    public function store(Request $request)
    {
        Salle::create(['design' => $request->design]);
        return redirect()->route('salles.index');
    }

    public function edit($idsalle)
    {
        $salle = Salle::findOrFail($idsalle);
        return view('admin.salles.edit', compact('salle'));
    }

    public function update(Request $request, $idsalle)
    {
        $salle = Salle::findOrFail($idsalle);
        $salle->update(['design' => $request->design]);
        return redirect()->route('salles.index');
    }

    public function destroy($idsalle)
    {
        Salle::findOrFail($idsalle)->delete();
        return redirect()->route('salles.index');
    }
}