<x-app-layout>
    <div class="bg-gray-100 min-h-screen flex flex-col items-center py-10" x-data="{ openAdd: false }">

        <!-- 🔹 Bouton retour au panier -->
        <div class="w-full max-w-5xl px-6 mb-2 flex items-center justify-start">
            <a href="{{ route('paniers.index') }}"
               class="text-sky-600 text-sm font-medium flex items-center hover:text-sky-800 transition">
                <span class="mr-1">←</span> Retour au panier
            </a>
        </div>

        <!-- Titre principal -->
        <div class="bg-white w-full max-w-5xl text-center shadow-md py-6 mb-8 border-b-4 border-sky-500">
            <h1 class="text-3xl font-extrabold text-sky-600" style="font-family: 'Bungee', cursive;">
                ADRESSES DE LIVRAISON
            </h1>
        </div>

        @if(session('success'))
            <div class="bg-sky-100 text-sky-800 font-bold px-4 py-2 mb-6 rounded-md border border-sky-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white w-full max-w-3xl p-8 rounded-xl shadow-lg text-center border border-sky-200">

            <!-- Bouton d’ajout -->
            <button @click="openAdd = !openAdd"
                class="mb-6 w-full text-sky-600 border-2 border-sky-500 font-bold py-3 rounded-md transition hover:bg-sky-500 hover:text-white">
                <span x-show="!openAdd">Ajouter une nouvelle adresse</span>
                <span x-show="openAdd">Annuler</span>
            </button>

            <!-- Formulaire d’ajout -->
            <div x-show="openAdd" x-transition>
                <form action="{{ route('adresses.store') }}" method="POST" class="space-y-4 mb-8">
                    @csrf

                    <div class="grid grid-cols-2 gap-3">
                        <input type="number" name="numero" placeholder="Numéro"
                            class="p-3 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                        <input type="text" name="rue" placeholder="Rue"
                            class="p-3 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="text" name="ville" placeholder="Ville"
                            class="p-3 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                        <input type="text" name="code_postal" placeholder="Code postal"
                            class="p-3 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                    </div>
                    <input type="text" name="pays" placeholder="Pays" value="France"
                        class="p-3 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400">

                    <button type="submit"
                        class="w-full bg-sky-500 text-white font-bold py-3 rounded-md hover:bg-sky-600 transition">
                        Enregistrer l’adresse
                    </button>
                </form>
            </div>

            <!-- Liste des adresses -->
            @if($adresses->count() > 0)
                <h2 class="text-xl font-bold mb-6 text-sky-700">Vos adresses enregistrées</h2>

                @foreach($adresses as $adresse)
                    <div class="border border-sky-300 rounded-md bg-white p-4 mb-6 text-left shadow-sm" x-data="{ editMode: false }">

                        <!-- Vue simple -->
                        <div x-show="!editMode">
                            <p><strong>Numéro :</strong> {{ $adresse->numero }}</p>
                            <p><strong>Rue :</strong> {{ $adresse->rue }}</p>
                            <p><strong>Ville :</strong> {{ $adresse->ville }}</p>
                            <p><strong>Code postal :</strong> {{ $adresse->code_postal }}</p>
                            <p><strong>Pays :</strong> {{ $adresse->pays }}</p>

                            <div class="mt-4 flex flex-col space-y-2">
                                <!-- Choisir cette adresse -->
                                <a href="{{ route('paiements.index', ['adresse' => $adresse->id]) }}"
                                   class="block w-full text-sky-600 border-2 border-sky-500 font-bold py-2 rounded-md text-center hover:bg-sky-500 hover:text-white transition">
                                   Choisir cette adresse
                                </a>

                                <!-- Modifier -->
                                <button @click="editMode = true"
                                        class="w-full text-sky-600 border-2 border-sky-500 font-bold py-2 rounded-md hover:bg-sky-500 hover:text-white transition">
                                    Modifier
                                </button>

                                <!-- Supprimer -->
                                <form action="{{ route('adresses.destroy', $adresse->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full text-sky-600 border-2 border-sky-500 font-bold py-2 rounded-md hover:bg-sky-500 hover:text-white transition">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Formulaire de modification -->
                        <div x-show="editMode" x-transition>
                            <button type="button" @click="editMode = false"
                                    class="text-sky-600 text-sm font-medium mb-3 flex items-center hover:text-sky-800 transition self-start">
                                <span class="mr-1">←</span> Retour au choix de l’adresse
                            </button>

                            <form action="{{ route('adresses.update', $adresse->id) }}" method="POST" class="space-y-3 mt-2">
                                @csrf
                                @method('PUT')

                                <div class="grid grid-cols-2 gap-3">
                                    <input type="number" name="numero" value="{{ $adresse->numero }}"
                                        class="p-2 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                                    <input type="text" name="rue" value="{{ $adresse->rue }}"
                                        class="p-2 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <input type="text" name="ville" value="{{ $adresse->ville }}"
                                        class="p-2 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                                    <input type="text" name="code_postal" value="{{ $adresse->code_postal }}"
                                        class="p-2 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400" required>
                                </div>
                                <input type="text" name="pays" value="{{ $adresse->pays }}"
                                    class="p-2 border border-sky-300 rounded-md focus:ring-2 focus:ring-sky-400">

                                <div class="flex gap-2">
                                    <button type="submit"
                                            class="flex-1 bg-sky-500 text-white font-bold py-2 rounded-md hover:bg-sky-600 transition">
                                        Enregistrer
                                    </button>
                                    <button type="button" @click="editMode = false"
                                            class="flex-1 text-sky-600 border-2 border-sky-500 font-bold py-2 rounded-md hover:bg-sky-500 hover:text-white transition">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-600">Vous n’avez encore enregistré aucune adresse.</p>
            @endif
        </div>
    </div>
</x-app-layout>
