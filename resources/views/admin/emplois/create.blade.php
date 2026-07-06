@extends('admin.layout')

@section('content')
    <h1 style="color: #32CD32; text-align: center; margin-bottom: 20px;">Ajouter un Emploi du temps</h1>
    
    <div class="glass-form">
        <form action="{{ route('emplois.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Cours</label>
                <input type="text" name="cours" placeholder="Ex: Algorithmique" required>
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" required>
            </div>

            <div class="form-group">
                <label>Heure Début</label>
                <input type="time" name="heure_debut" required>
            </div>

            <div class="form-group">
                <label>Heure Fin</label>
                <input type="time" name="heure_fin" required>
            </div>

            <div class="form-group">
                <label>Jour Semaine</label>
                <select name="jour_semaine" required>
                    <option value="Lundi">Lundi</option>
                    <option value="Mardi">Mardi</option>
                    <option value="Mercredi">Mercredi</option>
                    <option value="Jeudi">Jeudi</option>
                    <option value="Vendredi">Vendredi</option>
                </select>
            </div>

            <div class="form-group">
                <label>Semaine</label>
                <input type="number" name="semaine" value="{{ date('W') }}" required>
            </div>

            <div class="form-group">
                <label>Semestre</label>
                <select name="semestre" required>
                    <option value="Semestre 1">Semestre 1</option>
                    <option value="Semestre 2">Semestre 2</option>
                    <option value="Semestre 2">Semestre 3</option>
                    <option value="Semestre 2">Semestre 4</option>
                    <option value="Semestre 2">Semestre 5</option>
                    <option value="Semestre 2">Semestre 6</option>
                    <option value="Semestre 2">Semestre 7</option>
                    <option value="Semestre 2">Semestre 7</option>
                    <option value="Semestre 2">Semestre 8</option>
                    <option value="Semestre 2">Semestre 9</option>
                    <option value="Semestre 2">Semestre 10</option>
                </select>
            </div>

            <div class="form-group">
                <label>Professeur</label>
                <select name="idprof" required>
                    <option value="">Sélectionner</option>
                    @foreach($professeurs as $prof)
                        <option value="{{ $prof->idprof }}">{{ $prof->Nom }} {{ $prof->Prenoms }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Classe</label>
                <select name="idclasse" required>
                    <option value="">Sélectionner</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->idclasse }}">{{ $classe->niveau }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Salle</label>
    <select name="idsalle" required>
    <option value="">Sélectionner une salle</option>
    @foreach($salles as $salle)
        @php
            // Vérifie si la salle a AU MOINS UN cours dans la base (peu importe la date)
            $estOccupee = \App\Models\Emploi::where('idsalle', $salle->idsalle)->exists();
        @endphp
        <option value="{{ $salle->idsalle }}" 
            @if($estOccupee) disabled style="color: #ff6b6b; text-decoration: line-through;" @endif>
            {{ $salle->design }}
            @if($estOccupee)
                (Occupée)
            @endif
        </option>
    @endforeach
</select>
            </div>

            <button type="submit" class="btn-submit">Enregistrer</button>
            <a href="{{ route('emplois.index') }}" class="btn-back">Retour</a>
        </form>
    </div>

    <style>
        .glass-form {
            max-width: 700px; margin: 0 auto;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            padding: 35px 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px; font-size: 0.9rem;
        }
        .form-group input, .form-group select {
            width: 100%; padding: 12px 18px; border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff; font-size: 1rem; outline: none;
        }
        .form-group input:focus, .form-group select:focus { border-color: #32CD32; }
        .form-group select option { background: #1e293b; color: #fff; }
        .btn-submit {
            width: 100%; padding: 14px; border-radius: 50px;
            background: rgba(50, 205, 50, 0.2); color: #fff;
            border: 1px solid rgba(50, 205, 50, 0.4);
            margin-top: 10px; cursor: pointer; transition: 0.3s;
        }
        .btn-submit:hover { background: rgba(50, 205, 50, 0.4); }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: rgba(255,255,255,0.6); text-decoration: none; }
        .btn-back:hover { color: #fff; }
    </style>
@endsection