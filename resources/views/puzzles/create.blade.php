<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un puzzle') }}
        </h2>
    </x-slot>

    <x-puzzles-card>
        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('puzzles.store') }}" method="POST">
            @csrf

            <!-- Nom -->
            <div class="mt-4">
                <x-input-label for="nom" :value="__('Nom')" />
                <x-text-input 
                    id="nom" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="nom" 
                    :value="old('nom')" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <!-- Catégorie -->
            <div class="mt-4">
                <x-input-label for="categorie_id" :value="__('Catégorie')" />
                <select 
                    id="categorie_id" 
                    name="categorie_id" 
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" 
                    required
                >
                    <option value="">{{ __('-- Choisir une catégorie --') }}</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('categorie_id')" class="mt-2" />
            </div>

            <!-- Description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-text-input 
                    id="description" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="description" 
                    :value="old('description')" 
                    required 
                />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <!-- Image -->
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image (URL)')" />
                <x-text-input 
                    id="image" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="image" 
                    :value="old('image')" 
                    required 
                />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <!-- Prix -->
            <div class="mt-4">
                <x-input-label for="prix" :value="__('Prix (€)')" />
                <x-text-input 
                    id="prix" 
                    class="block mt-1 w-full" 
                    type="number" 
                    step="0.01" 
                    name="prix" 
                    :value="old('prix')" 
                    required 
                />
                <x-input-error :messages="$errors->get('prix')" class="mt-2" />
            </div>

            <!-- Bouton de soumission -->
            <div class="flex items-center justify-end mt-6">
                <x-primary-button>
                    {{ __('Enregistrer') }}
                </x-primary-button>
            </div>
        </form>
    </x-puzzles-card>
</x-app-layout>
