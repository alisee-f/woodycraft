<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#d9d9d9]">
    <div class="bg-[#d9d9d9] min-h-screen flex flex-col items-center">
        
        <!-- Bandeau bleu clair -->
        <div class="w-full bg-sky-400 py-4 text-center shadow-md">
            <h1 class="text-white text-3xl font-extrabold tracking-wider" style="font-family: 'Bungee', cursive;">
                INSCRIPTION
            </h1>
        </div>

        <!-- Formulaire -->
        <form method="POST" action="{{ route('register') }}" 
              class="bg-white w-full max-w-md mt-10 p-8 rounded-2xl shadow-2xl space-y-6 border border-gray-200">
            @csrf

            <!-- Prénom -->
            <div>
                <label for="prenom" class="block text-gray-700 font-semibold uppercase tracking-wide">Prénom</label>
                <input id="prenom" name="prenom" type="text" value="{{ old('prenom') }}" required
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
            </div>

            <!-- Nom -->
            <div>
                <label for="nom" class="block text-gray-700 font-semibold uppercase tracking-wide">Nom de famille</label>
                <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold uppercase tracking-wide">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
            </div>

            <!-- Téléphone -->
            <div>
                <label for="telephone" class="block text-gray-700 font-semibold uppercase tracking-wide">Téléphone</label>
                <input id="telephone" name="telephone" type="text" value="{{ old('telephone') }}" required
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-gray-700 font-semibold uppercase tracking-wide">Mot de passe</label>
                <input id="password" name="password" type="password" required
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
            </div>

            <!-- Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-semibold uppercase tracking-wide">Confirmer mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="mt-2 w-full rounded-xl border border-gray-300 focus:ring-2 focus:ring-sky-400 py-3 px-4 text-gray-800" />
            </div>

            <!-- Boutons -->
            <div class="flex flex-col items-center space-y-4 mt-8">
                <button type="submit"
                        class="w-full bg-sky-400 text-white text-lg font-bold py-3 rounded-xl shadow-md hover:bg-sky-500 hover:scale-[1.02] transition-transform duration-200">
                    S'inscrire
                </button>

                <a href="{{ route('login') }}"
                   class="w-full text-center border-2 border-sky-400 text-sky-600 font-semibold py-3 rounded-xl hover:bg-sky-50 transition">
                    Déjà membre ? Connexion
                </a>
            </div>
        </form>

        <!-- Pied de page bleu -->
        <div class="w-full bg-sky-400 mt-10 py-3"></div>
    </div>
</body>
</html>