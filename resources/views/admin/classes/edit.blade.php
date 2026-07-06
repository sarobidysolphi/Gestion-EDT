@extends('admin.layout')

@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
            <h1 style="color: #32CD32; text-align: center; margin-bottom: 20px;">Modifier une Classe</h1>
    <div class="glass-form">
        <form action="{{ route('classes.update', $classe->idclasse) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Niveau</label>
                <input type="text" name="niveau" value="{{ $classe->niveau }}" required>
            </div>
            <button type="submit" class="btn-submit">Modifier</button>
            <a href="{{ route('classes.index') }}" class="btn-back">Retour</a>
        </form>
    </div
    <!-- COLLE LE MÊME CSS QUE DANS CREATE -->
    <style>
        /* ... copie le CSS du bloc <style> du create ... */
        .glass-form { background: rgba(255, 255, 255, 0.08); backdrop-filter: blur(15px); border-radius: 25px; padding: 30px 35px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: rgba(255, 255, 255, 0.8); }
        .form-group input, .form-group select { width: 100%; padding: 12px 18px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.2); background: rgba(255,255,255,0.12); color: #fff; }
        .form-group input:focus { border-color: #32CD32; box-shadow: 0 0 10px rgba(50,205,50,0.3); }
        .btn-submit { width: 100%; padding: 14px; border-radius: 50px; background: rgba(50,205,50,0.2); color: #fff; border: 1px solid rgba(50,205,50,0.4); }
        .btn-submit:hover { background: rgba(50,205,50,0.4); }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: rgba(255,255,255,0.6); text-decoration: none; }
    </style>
@endsection