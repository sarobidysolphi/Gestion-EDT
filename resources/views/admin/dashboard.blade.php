@extends('admin.layout')

@section('content')
    <!-- En-tête -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 1.8rem; color: #fff;">Bienvenue {{ auth()->user()->name }}!</h1>
            <p style="color: rgba(255,255,255,0.6);">Accueil / Admin</p>
        </div>
    </div>

    <!-- Cartes de statistiques -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <!-- Classes -->
        <div style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Classes</p>
                    <h2 style="color: #32CD32; font-size: 2rem; margin-top: 5px;">{{ \App\Models\Classe::count() }}</h2>
                </div>
                <div style="background: rgba(50,205,50,0.2); padding: 12px; border-radius: 50%; color: #32CD32; font-size: 1.5rem;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
            </div>
        </div>

        <!-- Salles -->
        <div style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Salles</p>
                    <h2 style="color: #32CD32; font-size: 2rem; margin-top: 5px;">{{ \App\Models\Salle::count() }}</h2>
                </div>
                <div style="background: rgba(50,205,50,0.2); padding: 12px; border-radius: 50%; color: #32CD32; font-size: 1.5rem;">
                    <i class="fas fa-door-open"></i>
                </div>
            </div>
        </div>

        <!-- Professeurs -->
        <div style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Professeurs</p>
                    <h2 style="color: #32CD32; font-size: 2rem; margin-top: 5px;">{{ \App\Models\Professeur::count() }}</h2>
                </div>
                <div style="background: rgba(50,205,50,0.2); padding: 12px; border-radius: 50%; color: #32CD32; font-size: 1.5rem;">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
            </div>
        </div>

        <!-- Emplois -->
        <div style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border-radius: 15px; padding: 20px; border: 1px solid rgba(255,255,255,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.9rem;">Emplois</p>
                    <h2 style="color: #32CD32; font-size: 2rem; margin-top: 5px;">{{ \App\Models\Emploi::count() }}</h2>
                </div>
                <div style="background: rgba(50,205,50,0.2); padding: 12px; border-radius: 50%; color: #32CD32; font-size: 1.5rem;">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Raccourcis de tâches -->
    <div style="background: rgba(255,255,255,0.08); backdrop-filter: blur(10px); border-radius: 20px; padding: 25px; border: 1px solid rgba(255,255,255,0.1); margin-top: 20px;">
        <h3 style="color: #fff; font-size: 1.3rem; margin-bottom: 20px;">Raccourcis de Tâches</h3>
        <div style="display: flex; gap: 20px; flex-wrap: wrap;">
            
            <!-- Importer Excel -->
            <a href="{{ route('import.excel') }}" style="flex: 1; min-width: 150px; background: #32CD32; color: white; padding: 20px; border-radius: 15px; text-align: center; text-decoration: none; transition: 0.3s;">
                <i class="fas fa-file-excel" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                <span>Importer depuis Excel</span>
            </a>

            <!-- Générer PDF -->
            <a href="{{ route('pdf.generer') }}" style="flex: 1; min-width: 150px; background: rgba(255,255,255,0.1); color: white; padding: 20px; border-radius: 15px; text-align: center; text-decoration: none; transition: 0.3s;">
    <i class="fas fa-file-pdf" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
    <span>Exporter en PDF</span>
</a>
        </div>
    </div>

    <!-- Statut des tâches (Optionnel) -->
    <div style="background: rgba(255,255,255,0.05); border-radius: 15px; padding: 20px; margin-top: 20px; border: 1px solid rgba(255,255,255,0.05);">
        <h4 style="color: rgba(255,255,255,0.8); margin-bottom: 15px;">Statut des Tâches</h4>
        <div style="display: flex; gap: 15px; color: rgba(255,255,255,0.6); font-size: 0.9rem;">
            <span><i class="fas fa-check-circle" style="color: #32CD32;"></i> Import Excel : Terminé</span>
            <span><i class="fas fa-times-circle" style="color: #ff6b6b;"></i> Export PDF : À configurer</span>
        </div>
    </div>
@endsection