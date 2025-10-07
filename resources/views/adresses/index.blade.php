<x-app-layout>
    <!-- Petit bouton de retour -->
    <div class="max-w-3xl mx-auto mt-4 px-4 flex items-center justify-start">
        <a href="{{ route('paniers.index') }}"
           class="text-sky-600 text-sm font-medium flex items-center hover:text-sky-800 transition">
            <span class="mr-1">←</span> Retour au panier
        </a>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adresse de livraison
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow space-y-6">

            <h3 class="text-2xl font-bold text-center text-sky-700">Adresse de livraison</h3>

            @if ($adresse)
                <!-- Afficher adresse existante -->
                <div class="bg-gray-100 p-4 rounded border border-sky-300">
                    <p><strong>Rue :</strong> {{ $adresse->rue }}</p>
                    <p><strong>Ville :</strong> {{ $adresse->ville }}</p>
                    <p><strong>Code postal :</strong> {{ $adresse->code_postal }}</p>
                    <p><strong>Pays :</strong> {{ $adresse->pays }}</p>
                </div>

                <!-- Formulaire pour modifier -->
                <form method="POST" action="{{ route('adresses.update', $adresse->id) }}" class="space-y-4 mt-6">
                    @csrf
                    @method('PUT')

                    <input type="text" name="rue" value="{{ $adresse->rue }}" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">
                    <input type="text" name="ville" value="{{ $adresse->ville }}" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">
                    <input type="text" name="code_postal" value="{{ $adresse->code_postal }}" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">
                    <input type="text" name="pays" value="{{ $adresse->pays }}" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">

                    <button type="submit" class="w-full text-sky-600 border-2 border-sky-500 font-bold py-2 rounded hover:bg-sky-500 hover:text-white transition">
                        Modifier l’adresse
                    </button>
                </form>

            @else
                <!-- Formulaire pour ajouter une adresse -->
                <form method="POST" action="{{ route('adresses.store') }}" class="space-y-4">
                    @csrf

                    <input type="text" name="rue" placeholder="Rue" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">
                    <input type="text" name="ville" placeholder="Ville" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">
                    <input type="text" name="code_postal" placeholder="Code postal" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">
                    <input type="text" name="pays" placeholder="Pays" value="France" class="w-full border border-sky-300 p-2 rounded focus:ring-2 focus:ring-sky-400">

                    <button type="submit" class="w-full text-sky-600 border-2 border-sky-500 font-bold py-2 rounded hover:bg-sky-500 hover:text-white transition">
                        Enregistrer mon adresse
                    </button>
                </form>
            @endif

            <div class="mt-6">
                <a href="{{ route('adresses.show') }}" class="block w-full text-center text-sky-600 border-2 border-sky-500 font-bold py-2 rounded hover:bg-sky-500 hover:text-white transition">
                    Choix du paiement
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
