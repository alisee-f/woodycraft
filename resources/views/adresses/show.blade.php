<x-app-layout>
    <div class="bg-gray-200 min-h-screen flex flex-col items-center py-10">
        
        <!-- En-tête -->
        <div class="bg-white w-full max-w-5xl text-center shadow-md py-6 mb-8">
            <h1 class="text-3xl font-extrabold text-black" style="font-family: 'Bungee', cursive;">
                ADRESSE DE LIVRAISON
            </h1>
        </div>

        <!-- Message de succès -->
        @if(session('success'))
            <div class="bg-green-200 text-green-800 font-bold px-4 py-2 mb-6 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bloc principal -->
        <div class="bg-white w-full max-w-md p-8 rounded-xl shadow-lg text-center">
            @if(!$adresse)
                <!-- Aucun enregistrement -->
                <h2 class="text-xl font-bold mb-6">Ajouter une adresse</h2>
                <form action="{{ route('adresses.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="text" name="adresse" placeholder="Saisir votre adresse"
                        class="w-full p-3 bg-sky-100 border border-sky-400 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        required>
                    <button type="submit"
                        class="w-full bg-sky-500 text-white font-bold py-3 rounded-md shadow-md hover:bg-sky-600">
                        Ajouter l’adresse
                    </button>
                </form>

            @else
                <!-- Adresse existante -->
                <h2 class="text-xl font-bold mb-6">Votre adresse actuelle</h2>
                <p class="bg-gray-100 border border-gray-300 rounded-md py-3 px-4 mb-6">
                    {{ $adresse->adresse }}
                </p>

                <!-- Modifier -->
                <form action="{{ route('adresses.update', $adresse->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <input type="text" name="adresse" placeholder="Nouvelle adresse"
                        class="w-full p-3 border border-sky-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500"
                        required>
                    <button type="submit"
                        class="w-full bg-yellow-500 text-white font-bold py-3 rounded-md shadow-md hover:bg-yellow-600">
                        Modifier l’adresse
                    </button>
                </form>

                <!-- Supprimer -->
                <form action="{{ route('adresses.destroy', $adresse->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full bg-red-500 text-white font-bold py-3 rounded-md shadow-md hover:bg-red-600">
                        Supprimer l’adresse
                    </button>
                </form>
            @endif

            <!-- Bouton Paiement -->
            <a href="{{ route('paniers.index') }}"
               class="block w-full mt-6 bg-gray-400 text-white font-extrabold py-3 rounded-md shadow-md hover:bg-gray-500">
               CHOIX DU PAIEMENT
            </a>
        </div>

        <!-- Bandeau bas -->
        <div class="bg-sky-400 w-full max-w-5xl mt-12 h-4 rounded-full"></div>
    </div>
</x-app-layout>
