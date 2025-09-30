<x-app-layout>

    {{-- Bannière accueil avec image --}}
    <div class="relative">
        <img src="{{ asset('images/puzzle-banner.jpg') }}" alt="bannière-puzzle" class="w-full h-48 object-cover">
        <div class="absolute inset-0 flex items-center justify-center">
            <h2 class="text-4xl font-extrabold text-white drop-shadow-lg">
                Accueil
            </h2>
        </div>
    </div>

    {{-- Contenu principal --}}
    <div class="bg-gray-100 py-10">
        <div class="max-w-6xl mx-auto space-y-10 px-6">

            {{-- Message flash --}}
            @if (session()->has('message'))
                <div class="px-4 py-2 bg-green-100 text-green-700 rounded-md text-center">
                    {{ session('message') }}
                </div>
            @endif

            {{-- Section catégorie --}}
            <div>
                <h3 class="text-xl font-bold text-gray-700 mb-3 uppercase tracking-wide" style="font-family: 'Lobster', cursive;">
                    Puzzles 3D Bâtiments
                </h3>
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <span class="font-extrabold text-2xl text-gray-800">
                        CARROUSEL
                    </span>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-700 mb-3 uppercase tracking-wide" style="font-family: 'Lobster', cursive;">
                    Puzzles 3D Véhicules
                </h3>
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <span class="font-extrabold text-2xl text-gray-800">
                        CARROUSEL
                    </span>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-700 mb-3 uppercase tracking-wide" style="font-family: 'Lobster', cursive;">
                    Puzzles 3D Balls
                </h3>
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <span class="font-extrabold text-2xl text-gray-800">
                        CARROUSEL
                    </span>
                </div>
            </div>

            <div>
                <h3 class="text-xl font-bold text-gray-700 mb-3 uppercase tracking-wide" style="font-family: 'Lobster', cursive;">
                    Puzzles 3D Lumineux
                </h3>
                <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                    <span class="font-extrabold text-2xl text-gray-800">
                        CARROUSEL
                    </span>
                </div>
            </div>

        </div>
    </div>

    {{-- Footer bleu --}}
    <div class="bg-sky-500 py-6 text-center">
        <p class="text-black font-semibold">© 2025 Woody Craft - Tous droits réservés</p>
    </div>
</x-app-layout>
