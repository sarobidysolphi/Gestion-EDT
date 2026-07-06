@extends('admin.layout')

@section('content')
    <div class="admin-table-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1>Gestion des Classes</h1>
            <a href="{{ route('classes.create') }}" class="btn-add"><i class="fas fa-plus"></i> Ajouter</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Niveau</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($classes as $classe)
                <tr>
                    <td>{{ $classe->idclasse }}</td>
                    <td>{{ $classe->niveau }}</td>
                    <td>
                        <a href="{{ route('classes.edit', $classe->idclasse) }}" class="btn-action btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('classes.destroy', $classe->idclasse) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete">
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