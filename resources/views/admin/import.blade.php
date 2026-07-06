@extends('admin.layout')

@section('content')
    <h1 style="color: #32CD32; text-align: center;">Importer des données (Excel)</h1>
    <div class="glass-form" style="max-width: 500px;">
        <form action="{{ route('import.excel.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Choisir un fichier Excel (.xlsx)</label>
                <input type="file" name="file" accept=".xlsx" required>
            </div>
            <button type="submit" class="btn-submit">Importer</button>
        </form>
    </div>
@endsection