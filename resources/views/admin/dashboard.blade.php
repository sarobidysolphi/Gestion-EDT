@extends('admin.layout')

@section('content')
    <h1 style="color: #ffffff; font-size: 2rem; margin-bottom: 10px;">Tableau de bord</h1>
    <p style="color: rgba(255, 255, 255, 0.6); margin-bottom: 30px;">Bienvenue sur votre espace administrateur.</p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px;">
        <div class="stat-card">
            <h5 style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin-bottom: 5px;">Professeurs</h5>
            <h3 style="color: #32CD32; font-size: 2rem;">{{ \App\Models\Professeur::count() }}</h3>
        </div>
        <div class="stat-card">
            <h5 style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin-bottom: 5px;">Classes</h5>
            <h3 style="color: #32CD32; font-size: 2rem;">{{ \App\Models\Classe::count() }}</h3>
        </div>
        <div class="stat-card">
            <h5 style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin-bottom: 5px;">Salles</h5>
            <h3 style="color: #32CD32; font-size: 2rem;">{{ \App\Models\Salle::count() }}</h3>
        </div>
    </div>

    <style>
        /* Design Glassmorphism pour les cartes du Dashboard */
        .stat-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.12);
        }
    </style>
@endsection