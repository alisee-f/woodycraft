<x-app-layout>

    {{-- Bannière catégorie --}}
    <div class="relative">
        <img src="{{ asset('images/banniere.jpg') }}" 
             alt="bannière-catégorie" 
             class="w-full h-48 object-cover">
        <div class="absolute inset-0 flex items-center justify-center">
            <h2 class="text-4xl font-extrabold text-white drop-shadow-lg uppercase tracking-widest">
                {{ $categorie->nom }}
            </h2>
        </div>
    </div>

    {{-- Produits --}}
    <div class="bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">

                @forelse($categorie->puzzles as $puzzle)
                    <div class="bg-white rounded-xl shadow-lg p-4 text-center">
                        {{-- Image produit --}}
                        <img src="{{ asset('images/puzzles/'.$puzzle->image) }}" 
                             alt="{{ $puzzle->nom }}" 
                             class="w-full h-32 object-cover rounded-md mb-3">

                        {{-- Nom produit (ligne 1) --}}
                        <p class="text-gray-800 font-semibold">
    <a href="{{ route('puzzles.show', $puzzle->id) }}" 
       class="hover:text-sky-500 transition">
        {{ $puzzle->nom }}
    </a>
</p>

                        {{-- Nom produit (ligne 2, style sous-titre) --}}
                        <p class="text-gray-500 text-sm uppercase tracking-wide">
    {{ $puzzle->nom }}
</p>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">
                        Aucun produit disponible dans cette catégorie.
                    </p>
                @endforelse

            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="bg-sky-500 py-6 text-center">
        <p class="text-black font-semibold">© 2025 Woody Craft - Tous droits réservés</p>
    </div>

</x-app-layout>
