@extends('admin.layout')

@section('content')
    <h1 style="color: #32CD32; text-align: center; margin-bottom: 30px;">Importer des données depuis Excel</h1>
    
    <div class="glass-form" style="max-width: 500px;">
        <form action="{{ route('import.excel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label style="color: rgba(255,255,255,0.8);">Choisir un fichier Excel (.xlsx)</label>
                <input type="file" name="file" accept=".xlsx, .xls" required>
            </div>
            <button type="submit" class="btn-submit">Importer</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">Retour au Dashboard</a>
        </form>
    </div>
@endsection