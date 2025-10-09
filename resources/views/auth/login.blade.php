<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#d9d9d9]">
    <div class="bg-[#d9d9d9] min-h-screen flex flex-col items-center">
        
        <!-- Bandeau bleu -->
        <div class="w-full bg-sky-400 py-4 text-center shadow-md">
            <h1 class="text-white text-3xl font-extrabold tracking-wider" style="font-family: 'Bungee', cursive;">
                CONNEXION
            </h1>
        </div>

        <!-- Statut de session -->
        <x-auth-session-status class="mb-4 mt-6" :status="session('status')" />

        <!-- Formulaire -->
        <form method="POST" action="{{ route('login') }}" 
              class="bg-white w-full max-w-md mt-10 p-8 rounded-2xl shadow-2xl space-y-6 border border-gray-200">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold uppercase tracking-wide">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-gray-700 font-semibold uppercase tracking-wide">Mot de passe</label>
                <input id="password" name="password" type="password" required autocomplete="current-password"
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
            </div>

            <!-- Se souvenir de moi -->
            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="inline-flex items-center space-x-2">
                    <input id="remember_me" type="checkbox" name="remember"
                           class="rounded border-gray-300 text-sky-500 focus:ring-sky-400">
                    <span class="text-sm text-gray-700 font-medium">Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-sky-600 hover:underline font-semibold">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <!-- Boutons -->
            <div class="flex flex-col items-center space-y-4 mt-8">
                <button type="submit"
                        class="w-full bg-sky-400 text-white text-lg font-bold py-3 rounded-xl shadow-md hover:bg-sky-500 hover:scale-[1.02] transition-transform duration-200">
                    Se connecter
                </button>

                <a href="{{ route('register') }}"
                class="w-full text-center border-2 border-sky-400 text-sky-600 font-semibold py-3 rounded-xl hover:bg-sky-50 transition">
                    Pas encore inscrit ? Créer un compte
                </a>
            </div>
            </form>

            <!-- Pied de page bleu fixé -->
            <div class="w-full bg-sky-400 py-3 fixed bottom-0 left-0"></div>
            </div>
</body>
</html>

