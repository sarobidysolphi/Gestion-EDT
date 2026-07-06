<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - ENI</title>
    <style>
        /* Reset et fond général */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Fond sombre avec dégradé pour faire ressortir le verre dépoli */
            background: linear-gradient(135deg, #1e293b, #0f172a); 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
        }

        /* La carte principale en verre dépoli (Glassmorphism) */
        .login-container {
            background: rgba(255, 255, 255, 0.1); /* Fond blanc très transparent */
            backdrop-filter: blur(15px); /* Effet de flou derrière */
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2); /* Bordure subtile */
            border-radius: 30px;
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        /* Le Logo */
        .logo-container {
            margin-bottom: 20px;
        }
        .logo-container img {
            max-width: 120px;
            height: auto;
            border-radius: 50%;
            background: rgba(255,255,255,0.8);
            padding: 5px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        /* Titres */
        h2 { color: #ffffff; font-size: 2rem; margin-bottom: 10px; letter-spacing: 1px; }
        .subtitle { color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin-bottom: 30px; }

        /* Champs de saisie */
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .input-group label {
            display: block;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        .input-group input {
            width: 100%;
            padding: 15px 20px;
            border-radius: 50px; /* Coins très arrondis comme sur la photo */
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.15); /* Fond semi-transparent */
            color: #ffffff;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s ease;
        }
        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        .input-group input:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #32CD32; /* Vert citron au focus */
            box-shadow: 0 0 10px rgba(50, 205, 50, 0.3);
        }

        /* Bouton Connexion (Transparent solide) */
        .btn-submit {
            width: 100%;
            padding: 15px;
            border-radius: 50px;
            border: none;
            /* Fond vert citron mais légèrement transparent */
            background: rgba(50, 205, 50, 0.2); 
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            border: 1px solid rgba(50, 205, 50, 0.4);
        }
        .btn-submit:hover {
            background: rgba(50, 205, 50, 0.4); /* S'illumine au survol */
            box-shadow: 0 0 20px rgba(50, 205, 50, 0.2);
            transform: scale(1.02); /* Petit effet de zoom */
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container { padding: 30px 20px; }
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('LogoENI.png') }}" alt="Logo ENI">
        </div>

        <h2>Connexion</h2>
        <p class="subtitle">Accédez à votre espace administrateur</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="input-group">
                <label>Adresse e-mail</label>
                <input type="email" name="email" placeholder="Entrer votre adresse email" required autofocus>
            </div>

            <div class="input-group">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Connexion</button>
        </form>
    </div>

</body>
</html>