<x-app-layout>
    <div class="bg-gray-100 min-h-screen flex flex-col items-center py-10">
        
        <!-- En-tête -->
        <div class="bg-white w-full max-w-5xl shadow-md py-4 px-6 flex items-center justify-between mb-8 border-b-4 border-sky-500">
            <a href="{{ route('adresses.show') }}"
               class="text-sky-600 text-sm font-medium flex items-center hover:text-sky-800 transition">
                <span class="mr-1">←</span> Retour à mes adresses
            </a>

            <h1 class="text-2xl font-extrabold text-sky-600 text-center flex-1"
                style="font-family: 'Bungee', cursive;">
                RÉCAPITULATIF DE COMMANDE
            </h1>

            <div class="w-32"></div>
        </div>

        <div class="bg-white w-full max-w-3xl p-8 rounded-xl shadow-lg space-y-8 border border-sky-200">

            <!-- Adresse -->
            <div>
                <h2 class="text-xl font-bold mb-3 text-sky-700">Adresse de livraison</h2>
                @if($adresse)
                    <div class="border border-sky-300 rounded-md bg-sky-50 p-4 text-left">
                        <p><strong>Numéro :</strong> {{ $adresse->numero }}</p>
                        <p><strong>Rue :</strong> {{ $adresse->rue }}</p>
                        <p><strong>Ville :</strong> {{ $adresse->ville }}</p>
                        <p><strong>Code postal :</strong> {{ $adresse->code_postal }}</p>
                        <p><strong>Pays :</strong> {{ $adresse->pays }}</p>
                    </div>
                @else
                    <p class="text-red-500">Aucune adresse enregistrée.</p>
                @endif
            </div>

            <!-- Panier -->
            <div>
                <h2 class="text-xl font-bold mb-3 text-sky-700">Contenu du panier</h2>
                @if($panier && $panier->puzzles->count() > 0)
                    @foreach($panier->puzzles as $puzzle)
                        <div class="flex justify-between items-center border-b py-2">
                            <p>{{ $puzzle->nom }} (x{{ $puzzle->pivot->quantite }})</p>
                            <p>{{ number_format($puzzle->pivot->quantite * $puzzle->prix, 2) }} €</p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600">Votre panier est vide.</p>
                @endif
            </div>

            <!-- Total -->
            <div class="text-right">
                <p class="text-lg font-bold text-sky-700">Total : {{ number_format($total, 2) }} €</p>
            </div>

            <!-- Choix du paiement -->
            <div class="space-y-3">
                <h2 class="text-xl font-bold mb-3 text-center text-sky-700">Choisissez votre mode de paiement</h2>

                <a href="{{ route('paiements.paypal', ['adresse' => $adresse->id ?? null]) }}"
                class="block text-sky-600 border-2 border-sky-500 font-bold py-3 rounded-md text-center hover:bg-sky-500 hover:text-white transition">
                Payer par PayPal
                </a>

                <a href="{{ route('paiements.cheque', ['adresse' => $adresse->id ?? null]) }}"
                class="block text-sky-600 border-2 border-sky-500 font-bold py-3 rounded-md text-center hover:bg-sky-500 hover:text-white transition">
                Payer par chèque (télécharger la facture)
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
