@extends('admin.layout')

@section('content')
    <h1>Gestion des Emplois du temps</h1>
    <div class="admin-table-container">
        <a href="{{ route('emplois.create') }}" class="btn-add"><i class="fas fa-plus"></i> Ajouter</a>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Cours</th>
                    <th>Professeur</th>
                    <th>Salle</th>
                    <th>Classe</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emplois as $emploi)
                <tr>
                    <td>{{ $emploi->date }}</td>
                    <td>{{ $emploi->heure_debut }} - {{ $emploi->heure_fin }}</td>
                    <td>{{ $emploi->cours }}</td>
                    <td>{{ $emploi->professeur->Nom }}</td>
                    <td>{{ $emploi->salle->design }}</td>
                    <td>{{ $emploi->classe->niveau }}</td>
                    <td>
                        <a href="{{ route('emplois.edit', $emploi->id) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('emplois.destroy', $emploi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer cet emploi ?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection