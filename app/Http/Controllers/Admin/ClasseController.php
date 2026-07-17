<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create');
    }

    public function store(Request $request)
    {
        Classe::create([
            'niveau' => $request->niveau,
        ]);
        return redirect()->route('classes.index');


         Classe::create(['niveau' => $request->niveau]);
    return redirect()->route('classes.index')->with('success', '✅ Classe ajoutée avec succès !');
    }

    public function edit($idclasse)
    {
        $classe = Classe::findOrFail($idclasse);
        return view('admin.classes.edit', compact('classe'));
    }

    public function update(Request $request, $idclasse)
    {
        $classe = Classe::findOrFail($idclasse);
        $classe->update([
            'niveau' => $request->niveau,
        ]);
        return redirect()->route('classes.index');
    }

    public function destroy($idclasse)
    {
        $classe = Classe::findOrFail($idclasse);
        $classe->delete();
        return redirect()->route('classes.index');
    }
}