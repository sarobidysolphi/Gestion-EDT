<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion EDT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #ffffff;
            min-height: 100vh;
        }
        .header-glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header-glass .logo-area { display: flex; align-items: center; gap: 15px; }
        .header-glass .logo-area img { height: 50px; border-radius: 50%; }
        .header-glass .logo-area h1 { font-size: 1.5rem; color: #fff; }
        .btn-login-glass {
            background: rgba(50, 205, 50, 0.2);
            color: #fff;
            padding: 10px 25px;
            border: 1px solid rgba(50, 205, 50, 0.4);
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-login-glass:hover { background: rgba(50, 205, 50, 0.4); }
        .hero-container { max-width: 1200px; margin: 60px auto; padding: 0 20px; display: flex; align-items: center; gap: 50px; }
        .hero-text h1 { font-size: 3.5rem; line-height: 1.2; margin-bottom: 20px; }
        .hero-text p { color: rgba(255, 255, 255, 0.7); font-size: 1.2rem; margin-bottom: 30px; }
        .hero-image img { max-width: 100%; height: auto; border-radius: 20px; }
        .glass-card {
            max-width: 1200px; margin: 0 auto 50px auto; padding: 20px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 25px;
        }
        .filter-row { display: flex; gap: 20px; flex-wrap: wrap; align-items: flex-end; margin-bottom: 20px; }
        .filter-group { flex: 1; min-width: 150px; }
        .filter-group label { display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px; font-size: 0.9rem; }
        .filter-group select {
            width: 100%; padding: 12px 15px; border-radius: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.15); color: #fff; outline: none;
        }
        .filter-group select option { background: #1e293b; }
        
        /* Tableau */
        table { width: 100%; border-collapse: collapse; color: #fff; margin-top: 10px; }
        th, td { padding: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); text-align: center; }
        th { color: #32CD32; font-weight: bold; }
        tr:hover { background: rgba(255,255,255,0.05); }
        .empty-msg { color: rgba(255, 255, 255, 0.5); text-align: center; padding: 40px; }
    </style>
</head>
<body>

    <header class="header-glass">
        <div class="logo-area">
            <img src="{{ asset('LogoENI.png') }}" alt="Logo de l'Ecole">
            <h1>Ecole Nationale de l'informatique</h1>
        </div>
        <a href="{{ route('login') }}" class="btn-login-glass">Admin</a>
    </header>

    <div class="hero-container">
        <div class="hero-text">
            <h1>Plateforme de gestion d'emplois du temps.</h1>
            <p>Transformez la gestion manuelle de vos emplois du temps en une gestion automatisée et efficace.</p>
        </div>
        <div class="hero-image">
            <img src="{{ asset('illustration.png') }}" alt="Illustration" style="max-height: 300px; opacity: 0.8;">
        </div>
    </div>
      
     @if(isset($debutSemaine) && isset($finSemaine))
    <div style="color: #32CD32; font-weight: bold; text-align: center; margin-bottom: 15px;">
        Semaine du {{ $debutSemaine->format('d/m/Y') }} au {{ $finSemaine->format('d/m/Y') }}
    </div>
@endif


    <div class="glass-card">
        <h2 style="color: #32CD32; margin-bottom: 20px; text-align: center;">Consulter les emplois du temps</h2>

        <div class="filter-row">
            <div class="filter-group">
                <label>Semestre</label>
                <select id="semestreSelect" class="form-select">
                    <option value="">Tous</option>
                    <option value="">Semestre 1</option>
                    <option value="">Semestre 2</option>
                    <option value="">Semestre 3</option>
                    <option value="">Semestre 4</option>
                    <option value="">Semestre 5</option>
                    <option value="">Semestre 6</option>
                    <option value="">Semestre 7</option>
                    <option value="">Semestre 8</option>
                    <option value="">Semestre 9</option>
                    <option value="">Semestre 10</option>
                    @foreach($classes as $classe)
                        @if($classe->semestre)
                            <option value="{{ $classe->semestre }}">{{ $classe->semestre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            
            <div class="filter-group">
                <label>Niveau</label>
                <select id="niveauSelect" class="form-select">
                    <option value="">Tous</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->niveau }}">{{ $classe->niveau }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div id="emploisContainer" class="table-responsive">
            <p class="empty-msg">Veuillez sélectionner un niveau pour voir l'emploi du temps.</p>
        </div>
    </div>

    <footer style="text-align: center; padding: 30px; color: rgba(255,255,255,0.4); font-size: 0.9rem;">
        &copy; Projet L2 2026 - PHP
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const semestre = document.getElementById('semestreSelect');
            const niveau = document.getElementById('niveauSelect');
            const container = document.getElementById('emploisContainer');

            function loadEmplois() {
                // Si aucun niveau n'est sélectionné, on demande à l'utilisateur de choisir
                if(niveau.value === '') {
                    container.innerHTML = '<p class="empty-msg">Veuillez sélectionner un niveau pour voir l\'emploi du temps.</p>';
                    return;
                }

                // Construire l'URL de la requête avec le semestre et le niveau
                const url = `/?semestre=${semestre.value}&niveau=${niveau.value}`;
                
                fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(res => res.text())
                    .then(html => { container.innerHTML = html; });
            }

            semestre.addEventListener('change', loadEmplois);
            niveau.addEventListener('change', loadEmplois);
        });
    </script>
</body>
</html>