<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mon Panier ({{ count($puzzles) }} article(s))
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Liste des articles -->
            <div class="md:col-span-2 space-y-4">
                @forelse ($puzzles as $puzzle)
                    <div class="flex items-center justify-between bg-white p-4 rounded shadow">
                        
                        <!-- Image -->
                        <img src="{{ asset('images/puzzles/' . $puzzle->image) }}" 
                        alt="{{ $puzzle->nom }}" 
                        class="w-32 h-32 object-contain rounded shadow">



                        <!-- Infos produit -->
                        <div class="flex-1 px-4">
                            <p class="font-bold">{{ $puzzle->nom }}</p>
                            <p class="text-gray-600">Prix : {{ number_format($puzzle->prix, 2) }} €</p>
                            
                            <!-- Boutons + / - -->
                            <div class="flex items-center mt-2 space-x-2">
                                <!-- Bouton - -->
                                <form action="{{ route('paniers.update', $puzzle->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantite" value="{{ $puzzle->pivot->quantite - 1 }}">
                                    <button 
                                        type="submit"
                                        class="px-2 py-1 bg-gray-300 text-black rounded hover:bg-gray-400"
                                        @if($puzzle->pivot->quantite <= 1) disabled @endif>
                                        -
                                    </button>
                                </form>

                                <span class="font-semibold">{{ $puzzle->pivot->quantite }}</span>

                                <!-- Bouton + -->
                                <form action="{{ route('paniers.update', $puzzle->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantite" value="{{ $puzzle->pivot->quantite + 1 }}">
                                    <button 
                                        type="submit"
                                        class="px-2 py-1 bg-gray-300 text-black rounded hover:bg-gray-400">
                                        +
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Supprimer -->
                        <form action="{{ route('paniers.destroy', $puzzle->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Supprimer
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-600">Votre panier est vide.</p>
                @endforelse
            </div>

            <!-- Résumé commande -->
            <div class="bg-white p-6 rounded shadow space-y-4">
                <h3 class="font-bold text-lg">Résumé de la commande</h3>

                <p>Articles : <span class="font-semibold">
                    {{ $puzzles instanceof \Illuminate\Support\Collection ? $puzzles->sum('pivot.quantite') : 0 }}
                </span></p>

                <p>Frais d'expédition (TVA incluse) : <span class="font-semibold">5.00 €</span></p>

                <hr>

                <p class="text-xl font-bold">Montant total : 
                    {{ number_format($total + 5, 2) }} €
                </p>

                <a href="{{ route('adresses.show') }}" 
                   class="block w-full text-center bg-sky-500 text-white py-2 rounded hover:bg-sky-600">
                   Procéder au paiement
                </a>

                <a href="{{ route('categories.index') }}" 
                   class="block w-full text-center bg-gray-200 text-gray-700 py-2 rounded hover:bg-gray-300">
                   Poursuivre mes achats
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
