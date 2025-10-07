<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col items-center justify-center text-center px-6">
        <div class="bg-white shadow-lg rounded-2xl p-10 border-t-4 border-sky-500 max-w-lg">
            <h1 class="text-3xl font-extrabold text-sky-600 mb-4">Connexion requise</h1>
            <p class="text-gray-700 mb-6">
                Vous devez être connecté pour accéder à votre panier ou passer commande.
            </p>
            @if (session('message'))
                <div class="bg-sky-100 text-sky-800 px-4 py-2 rounded-md mb-6 border border-sky-300">
                    {{ session('message') }}
                </div>
            @endif


            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" 
                   class="bg-sky-500 text-white px-6 py-2 rounded-lg hover:bg-sky-600 transition">
                    Se connecter
                </a>
                <a href="{{ route('register') }}" 
                   class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                    S'inscrire
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
