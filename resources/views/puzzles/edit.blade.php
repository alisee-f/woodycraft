<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editer un puzzle') }}
        </h2>
    </x-slot>

    <x-puzzles-card>
        <!-- Message de réussite -->
        @if (session()->has('message'))
            <div class="mt-3 mb-4 list-disc list-inside text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('puzzles.update', $puzzle->id) }}" method="post">
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
                    :value="old('nom', $puzzle->nom)" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <!-- Categorie -->
            <div class="mt-4">
                <x-input-label for="categorie" :value="__('Categorie')" />
                <x-textarea 
                    class="block mt-1 w-full" 
                    id="categorie" 
                    name="categorie"
                >{{ old('categorie', $puzzle->categorie) }}</x-textarea>
                <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea 
                    class="block mt-1 w-full" 
                    id="description" 
                    name="description"
                >{{ old('description', $puzzle->description) }}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="image" :value="__('Image')" />
                <x-text-input 
                    id="image" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="image" 
                    :value="old('image', $puzzle->image)" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="prix" :value="__('Prix')" />
                <x-text-input 
                    id="prix" 
                    class="block mt-1 w-full" 
                    type="text" 
                    name="prix" 
                    :value="old('prix', $puzzle->prix)" 
                    required 
                    autofocus 
                />
                <x-input-error :messages="$errors->get('prix')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ml-3">
                    {{ __('Send') }}
                </x-primary-button>
            </div>
        </form>
    </x-puzzles-card>
</x-app-layout>
