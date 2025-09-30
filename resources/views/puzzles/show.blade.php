<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $puzzle->nom }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <img src="{{ $puzzle->image }}" alt="{{ $puzzle->nom }}" class="w-full h-64 object-cover mb-4 rounded">
            
            <h3 class="font-semibold text-2xl mb-2">{{ $puzzle->nom }}</h3>
            <p class="text-gray-600 mb-4">{{ $puzzle->description }}</p>
            
            <p class="font-bold text-gray-800 text-xl mb-4">Prix : {{ number_format($puzzle->prix, 2) }} €</p>
            
            <p class="text-gray-500 mb-4">Catégorie : {{ $puzzle->categorie->nom }}</p>

            <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                Retour
            </a>
        </div>
    </div>
</x-app-layout>
