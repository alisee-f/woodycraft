<x-app-layout>

    {{-- Bannière accueil --}}
    <div class="relative">
        <img src="{{ asset('images/banniere.jpg') }}" alt="bannière-puzzle" class="w-full h-48 object-cover">
        <div class="absolute inset-0 flex items-center justify-center">
            <h2 class="text-4xl font-extrabold text-white drop-shadow-lg">Accueil</h2>
        </div>
    </div>

    <div class="bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto space-y-10 px-6">

            {{-- Message flash --}}
            @if (session()->has('message'))
                <div class="px-4 py-2 bg-green-100 text-green-700 rounded-md text-center">
                    {{ session('message') }}
                </div>
            @endif

            {{-- Boucle sur les catégories --}}
            @foreach($categories as $categorie)
                <div>
                <h3 class="text-xl font-bold text-gray-700 mb-3 uppercase tracking-wide" style="font-family: 'Lobster', cursive;">
    <a href="{{ route('categories.show', $categorie->id) }}" class="hover:text-sky-500 transition">
        {{ $categorie->nom }}
    </a>
</h3>


                    @if($categorie->puzzles->count() > 0)
                        <div class="flex overflow-x-auto space-x-4 py-4">
                            @foreach($categorie->puzzles as $puzzle)
                                <div class="flex-none w-48 bg-white rounded-xl shadow-lg p-4 text-center">
                                <img src="{{ asset('images/puzzles/' . $puzzle->image) }}" 
                                alt="{{ $puzzle->nom }}" 
                                class="w-32 h-32 object-contain rounded shadow">

                                    <p class="text-gray-800 font-semibold">
    <a href="{{ route('puzzles.show', $puzzle->id) }}" 
       class="hover:text-sky-500 transition">
        {{ $puzzle->nom }}
    </a>
</p>
                                    <p class="text-gray-500">{{ $puzzle->prix }} €</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Aucun puzzle disponible</p>
                    @endif
                </div>
            @endforeach

        </div>
    </div>

    <div class="bg-sky-500 py-6 text-center">
        <p class="text-black font-semibold">© 2025 Woody Craft - Tous droits réservés</p>
    </div>

</x-app-layout>
