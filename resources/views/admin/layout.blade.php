<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Affichage des messages Toastr -->
@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif

    <title>Plateforme de gestion d'emploi du temps</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #ffffff;
        }
        .admin-container { display: flex; min-height: 100vh; }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px 15px;
            display: flex;
            flex-direction: column; /* Permet de pousser le bouton du bas */
        }

        /* Titre "Menu principal" avec grand espace */
        .sidebar-title {
            color: #32CD32;
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 30px; /* GRAND ESPACE AVANT LE PREMIER BOUTON */
            padding-left: 5px;
        }

        /* Navigation (boutons du milieu) */
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 18px; /* ESPACE RÉGULIER ENTRE LES BOUTONS */
        }

        .sidebar-nav a {
            display: block;
            padding: 16px 24px;
            border-radius: 50px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid transparent;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .sidebar-nav a:hover {
            background: rgba(50, 205, 50, 0.15);
            border: 1px solid rgba(50, 205, 50, 0.3);
            color: #32CD32;
            transform: translateX(6px);
        }

        /* Conteneur Déconnexion (poussé tout en bas) */
        .logout-container {
            margin-top: auto; /* Pousse le bouton tout en bas */
            padding-top: 25px; /* Espace de 25px entre le dernier bouton et la déco */
        }

        /* ================= MAIN CONTENT ================= */
        .main-content {
            flex: 1; 
            padding: 30px;
            background: rgba(255, 255, 255, 0.03);
        }

        h1 { color: #ffffff; margin-bottom: 20px; font-size: 1.8rem; }
        
        /* ================= TABLES & FORMULAIRES ================= */
        .admin-table-container { margin-top: 20px; }
        .admin-table-container table { width: 100%; border-collapse: collapse; color: #fff; }
        .admin-table-container th, td { padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left; }
        .admin-table-container th { color: #32CD32; }
        .admin-table-container tr:hover { background: rgba(255,255,255,0.05); }

        /* Boutons d'ajout */
        .btn-add { 
            display: inline-block;
            padding: 10px 24px;
            border-radius: 50px;
            background: rgba(50, 205, 50, 0.2);
            color: #fff;
            border: 1px solid rgba(50, 205, 50, 0.4);
            text-decoration: none;
            float: right;
            margin-bottom: 15px;
            transition: 0.3s;
        }
        .btn-add:hover { background: rgba(50, 205, 50, 0.4); }

        /* Boutons d'action (Modifier / Supprimer) */
        .btn-action {
            background: none; border: none; cursor: pointer;
            font-size: 1.1rem; margin-right: 10px; transition: 0.3s;
        }
        .btn-edit { color: #32CD32; }
        .btn-edit:hover { color: #7cff7c; }
        .btn-delete { color: #ff6b6b; }
        .btn-delete:hover { color: #ff3333; }

        /* Formulaire Glassmorphism */
        .glass-form {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 25px;
            padding: 30px 35px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px; }
        .form-group input, .form-group select {
            width: 100%; padding: 12px 18px; border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff; font-size: 1rem; outline: none;
        }
        .form-group input:focus, .form-group select:focus { border-color: #32CD32; }
        
        .btn-submit {
            width: 100%; padding: 14px; border-radius: 50px;
            background: rgba(50, 205, 50, 0.2); color: #fff;
            border: 1px solid rgba(50, 205, 50, 0.4);
            margin-top: 10px; cursor: pointer; transition: 0.3s;
        }
        .btn-submit:hover { background: rgba(50, 205, 50, 0.4); }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: rgba(255,255,255,0.6); text-decoration: none; }
        .btn-back:hover { color: #fff; }
    
              /* Boîte de notification personnalisée */
.notification-box {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 25px;
    border-radius: 15px;
    color: #fff;
    font-weight: bold;
    box-shadow: 0 10px 25px rgba(0,0,0,0.5);
    z-index: 9999;
    transform: translateX(150%);
    transition: transform 0.5s ease;
}
.notification-box.show {
    transform: translateX(0);
}
.notification-box.success {
    background: #32CD32; /* Vert */
}
.notification-box.error {
    background: #ff6b6b; /* Rouge */
}
    
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- SIDEBAR -->
        <div class="sidebar">
            
            <!-- Titre avec grand espacement -->
            <h4 class="sidebar-title">
                <i class="fas fa-school" style="margin-right: 10px;"></i> Menu principal
            </h4>

            <!-- Boutons du menu avec espace entre eux -->
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
                <a href="{{ route('emplois.index') }}"><i class="fas fa-calendar-alt me-2"></i> Emploi du temps</a>
                <a href="{{ route('classes.index') }}"><i class="fas fa-graduation-cap me-2"></i> Classes</a>
                <a href="{{ route('professeurs.index') }}"><i class="fas fa-chalkboard-teacher me-2"></i> Professeurs</a>
                <a href="{{ route('salles.index') }}"><i class="fas fa-door-open me-2"></i> Salles</a>
            </nav>

            <!-- Bouton Déconnexion (poussé tout en bas) -->
            <div class="logout-container">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="
                        width: 100%;
                        padding: 14px;
                        border-radius: 50px;
                        background: rgba(255, 0, 0, 0.1);
                        border: 1px solid rgba(255, 0, 0, 0.2);
                        color: #ff6b6b;
                        font-size: 1rem;
                        cursor: pointer;
                        transition: 0.3s;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        gap: 10px;
                    ">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </button>
                </form>
            </div>

        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- JAVASCRIPT (SweetAlert pour la suppression) -->
    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#32CD32',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Création du formulaire
                    let form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';

                    let csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = '{{ csrf_token() }}';
                    form.appendChild(csrf);

                    let method = document.createElement('input');
                    method.type = 'hidden';
                    method.name = '_method';
                    method.value = 'DELETE';
                    form.appendChild(method);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    // 1. Configurer Toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": 3000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // 2. Lire le message directement depuis l'URL (paramètre GET)
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const successMsg = urlParams.get('success');
        const errorMsg = urlParams.get('error');

        if (successMsg) {
            toastr.success(decodeURIComponent(successMsg));
        }
        if (errorMsg) {
            toastr.error(decodeURIComponent(errorMsg));
        }
    });
</script>


</body>
</html>