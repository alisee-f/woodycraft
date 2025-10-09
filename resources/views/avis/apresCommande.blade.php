<x-app-layout>
    <div class="container my-5 mx-auto flex flex-col items-center">
        <h2 class="mb-4 text-lg font-semibold text-center">Merci pour votre commande !</h2>
        <p class="text-center">Vous pouvez laisser un avis sur les puzzles que vous avez achetés :</p>

        @if(session('success'))
            <div class="alert alert-success mt-3 text-center">
                {{ session('success') }}
            </div>
        @endif

        @foreach($panier->appartient as $ligne)
            @php $puzzle = $ligne->puzzle; @endphp

            <div class="card my-4 shadow-sm border rounded-lg w-full max-w-lg">
                <div class="card-body p-4">
                    <h5 class="font-bold text-md mb-2 text-center">{{ $puzzle->nom }}</h5>
                    <p class="text-gray-600 mb-3 text-center">{{ $puzzle->description }}</p>

                    <form action="{{ route('avis.store', $puzzle->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="note-{{ $puzzle->id }}" class="block font-medium mb-1">Note :</label>
                            <select name="note" id="note-{{ $puzzle->id }}" class="border rounded px-2 py-1 w-full">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="commentaire-{{ $puzzle->id }}" class="block font-medium mb-1">Commentaire :</label>
                            <textarea name="commentaire" id="commentaire-{{ $puzzle->id }}" rows="3" class="border rounded px-2 py-1 w-full" required></textarea>
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">
                            Envoyer mon avis
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
