@extends('admin.layout')

@section('content')
    <h1>Gestion des Professeurs</h1>
    <div class="admin-table-container">
        <a href="{{ route('professeurs.create') }}" class="btn-add"><i class="fas fa-plus"></i> Ajouter</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénoms</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($professeurs as $prof)
                <tr>
                    <td>{{ $prof->idprof }}</td>
                    <td>{{ $prof->Nom }}</td>
                    <td>{{ $prof->Prenoms }}</td>
                    <td>{{ $prof->Grade }}</td>
                    <td>
                        <a href="{{ route('professeurs.edit', $prof->idprof) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('professeurs.destroy', $prof->idprof) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Supprimer ce professeur ?')">
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