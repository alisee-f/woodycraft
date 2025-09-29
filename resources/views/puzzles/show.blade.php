<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produits de la catégorie : ') . $categorie->nom }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($categorie->puzzles->isEmpty())
                <div class="bg-white p-6 rounded shadow text-center text-gray-500">
                    Aucun produit dans cette catégorie.
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($categorie->puzzles as $puzzle)
                        <div class="bg-white rounded shadow overflow-hidden">
                            <img src="{{ $puzzle->image }}" alt="{{ $puzzle->nom }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ $puzzle->nom }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $puzzle->description }}</p>
                                <p class="font-bold text-gray-800 mb-4">{{ number_format($puzzle->prix, 2) }} €</p>
                                <a href="{{ route('puzzles.show', $puzzle->id) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Voir le produit
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
