<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $puzzle->nom }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
        <img src="{{ asset('images/puzzles/' . $puzzle->image) }}" 
        alt="{{ $puzzle->nom }}" 
        class="w-32 h-32 object-contain rounded shadow">


            <h3 class="font-semibold text-2xl mb-2">{{ $puzzle->nom }}</h3>
            <p class="text-gray-600 mb-4">{{ $puzzle->description }}</p>
            
            <p class="font-bold text-gray-800 text-xl mb-4">Prix : {{ number_format($puzzle->prix, 2) }} €</p>
            <p class="text-gray-500 mb-4">Catégorie : {{ $puzzle->categorie->nom }}</p>

            <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 mb-2">
                Retour
            </a>
            <form action="{{ route('paniers.store', $puzzle->id) }}" method="POST" class="mb-6">
                @csrf
                <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded hover:bg-sky-600">
                    Ajouter au panier
                </button>
            </form>

            {{-- Section avis --}}
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4 text-center">Avis des utilisateurs</h3>

                @if($puzzle->avis->count() > 0)
                    @foreach($puzzle->avis as $avis)
                        <div class="card my-2 shadow-sm border rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="font-bold">{{ $avis->user->name }}</span>
                                <span>{{ $avis->note }} ⭐</span>
                            </div>
                            <p>{{ $avis->commentaire }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 italic text-center">Pas d'avis sur cet article.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
