@extends('admin.layout')

@section('content')
    <div style="max-width: 800px; margin: 0 auto;">
        <h1 style="color: #32CD32; text-align: center; margin-bottom: 20px;">Modifier un Emploi du temps</h1>
        <div class="glass-form">
            <form action="{{ route('emplois.update', $emploi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Cours</label>
                    <input type="text" name="cours" value="{{ $emploi->cours }}" required>
                </div>

                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" value="{{ $emploi->date }}" required>
                </div>

                <div class="form-group">
                    <label>Heure Début</label>
                    <input type="time" name="heure_debut" value="{{ $emploi->heure_debut }}" required>
                </div>

                <div class="form-group">
                    <label>Heure Fin</label>
                    <input type="time" name="heure_fin" value="{{ $emploi->heure_fin }}" required>
                </div>

                <div class="form-group">
                    <label>Jour Semaine</label>
                    <select name="jour_semaine" required>
                        <option value="Lundi" {{ $emploi->jour_semaine == 'Lundi' ? 'selected' : '' }}>Lundi</option>
                        <option value="Mardi" {{ $emploi->jour_semaine == 'Mardi' ? 'selected' : '' }}>Mardi</option>
                        <option value="Mercredi" {{ $emploi->jour_semaine == 'Mercredi' ? 'selected' : '' }}>Mercredi</option>
                        <option value="Jeudi" {{ $emploi->jour_semaine == 'Jeudi' ? 'selected' : '' }}>Jeudi</option>
                        <option value="Vendredi" {{ $emploi->jour_semaine == 'Vendredi' ? 'selected' : '' }}>Vendredi</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Semaine</label>
                    <input type="number" name="semaine" value="{{ $emploi->semaine }}" required>
                </div>

                <div class="form-group">
                    <label>Semestre</label>
                    <select name="semestre" required>
                        <option value="Semestre 1" {{ $emploi->semestre == 'Semestre 1' ? 'selected' : '' }}>Semestre 1</option>
                        <option value="Semestre 2" {{ $emploi->semestre == 'Semestre 2' ? 'selected' : '' }}>Semestre 2</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Professeur</label>
                    <select name="idprof" required>
                        <option value="">Sélectionner</option>
                        @foreach($professeurs as $prof)
                            <option value="{{ $prof->idprof }}" {{ $emploi->idprof == $prof->idprof ? 'selected' : '' }}>{{ $prof->Nom }} {{ $prof->Prenoms }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Classe</label>
                    <select name="idclasse" required>
                        <option value="">Sélectionner</option>
                        @foreach($classes as $classe)
                            <option value="{{ $classe->idclasse }}" {{ $emploi->idclasse == $classe->idclasse ? 'selected' : '' }}>{{ $classe->niveau }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Salle</label>
                    <select name="idsalle" required>
                        <option value="">Sélectionner</option>
                        @foreach($salles as $salle)
                            <option value="{{ $salle->idsalle }}" {{ $emploi->idsalle == $salle->idsalle ? 'selected' : '' }}>{{ $salle->design }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-submit">Modifier</button>
                <a href="{{ route('emplois.index') }}" class="btn-back">Retour</a>
            </form>
        </div>
    </div>

    <style>
        .glass-form {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            padding: 30px 35px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 18px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            font-size: 1rem;
            outline: none;
            transition: 0.3s;
        }
        .form-group input:focus { border-color: #32CD32; }
        .btn-submit {
            width: 100%;
            padding: 14px;
            border-radius: 50px;
            background: rgba(50, 205, 50, 0.2);
            color: #fff;
            border: 1px solid rgba(50, 205, 50, 0.4);
            margin-top: 10px;
            cursor: pointer;
        }
        .btn-submit:hover { background: rgba(50, 205, 50, 0.4); }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: rgba(255,255,255,0.6); text-decoration: none; }
    </style>
@endsection