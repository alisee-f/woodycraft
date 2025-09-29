<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editer un catégorie') }}
        </h2>
    </x-slot>

    <x-puzzles-card>
        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('categories.update', $categorie->id) }}" method="post">
            @csrf
            @method('put')

            <!-- Titre -->
            <div>
                <x-input-label for="nom" :value="__('Nom')" />
                <x-text-input 
                    id="nom" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="nom" 
                    :value="old('nom', $categorie->nom)" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Send') }}
                </x-primary-button>
            </div>
        </form>
    </x-puzzles-card>
</x-app-layout>
