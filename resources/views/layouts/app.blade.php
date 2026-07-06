<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion EDT - {% yield title %}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0d1b2a] text-gray-100 min-h-screen">
    <nav class="bg-[#1b2a3a] border-b border-[#2a3a4a]">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="h-8">
                <span class="font-bold text-lg">Ecole Nationale d'Informatique</span>
            </div>
            <div class="flex items-center gap-4">
                @auth
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500/80 hover:bg-red-500 px-4 py-1 rounded">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 px-4 py-1 rounded hover:bg-blue-700">Se connecter</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>
</body>
</html>