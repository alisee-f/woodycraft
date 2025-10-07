<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adresse de livraison
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow space-y-6">

            <h3 class="text-2xl font-bold text-center">Adresse de livraison</h3>

            @if ($adresse)
                <!-- Afficher adresse existante -->
                <div class="bg-gray-100 p-4 rounded">
                    <p><strong>Rue :</strong> {{ $adresse->rue }}</p>
                    <p><strong>Ville :</strong> {{ $adresse->ville }}</p>
                    <p><strong>Code postal :</strong> {{ $adresse->code_postal }}</p>
                    <p><strong>Pays :</strong> {{ $adresse->pays }}</p>
                </div>

                <!-- Formulaire pour modifier -->
                <form method="POST" action="{{ route('adresses.update', $adresse->id) }}" class="space-y-4 mt-6">
                    @csrf
                    @method('PUT')

                    <input type="text" name="rue" value="{{ $adresse->rue }}" class="w-full border p-2 rounded">
                    <input type="text" name="ville" value="{{ $adresse->ville }}" class="w-full border p-2 rounded">
                    <input type="text" name="code_postal" value="{{ $adresse->code_postal }}" class="w-full border p-2 rounded">
                    <input type="text" name="pays" value="{{ $adresse->pays }}" class="w-full border p-2 rounded">

                    <button type="submit" class="w-full bg-sky-500 text-white py-2 rounded hover:bg-sky-600">
                        Modifier l’adresse
                    </button>
                </form>

            @else
                <!-- Formulaire pour ajouter une adresse -->
                <form method="POST" action="{{ route('adresses.store') }}" class="space-y-4">
                    @csrf

                    <input type="text" name="rue" placeholder="Rue" class="w-full border p-2 rounded">
                    <input type="text" name="ville" placeholder="Ville" class="w-full border p-2 rounded">
                    <input type="text" name="code_postal" placeholder="Code postal" class="w-full border p-2 rounded">
                    <input type="text" name="pays" placeholder="Pays" value="France" class="w-full border p-2 rounded">

                    <button type="submit" class="w-full bg-sky-500 text-white py-2 rounded hover:bg-sky-600">
                        Enregistrer mon adresse
                    </button>
                </form>
            @endif

            <div class="mt-6">
                <a href="{{ route('adresses.show') }}" class="block w-full text-center bg-gray-700 text-white py-2 rounded hover:bg-gray-800">
                    Choix du paiement
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
