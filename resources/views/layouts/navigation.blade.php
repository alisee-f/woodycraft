<nav x-data="{ open: false }" class="bg-sky-500 shadow">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <!-- Logo + liens -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="text-white text-xl font-extrabold tracking-wide" style="font-family: 'Lobster', cursive;">
                    WOODY CRAFT
                </a>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-6">
                    <x-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')" class="text-white hover:text-gray-200">
                        {{ __('Accueil') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Boutons à droite -->
            <div class="flex items-center space-x-3">
                @guest
                    <x-link-button href="{{ route('login') }}" class="bg-white text-sky-600 font-bold hover:bg-gray-100">
                        Se connecter
                    </x-link-button>
                @else
                    <!-- Menu utilisateur -->
                <div class="relative" x-data="{ openUser: false }">
                    <button @click="openUser = !openUser" class="text-white font-medium flex items-center space-x-1 focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openUser" @click.away="openUser = false"
                        class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                Se déconnecter
                            </button>
                        </form>
                    </div>
                </div>

                @endguest

                <x-link-button href="{{ route('paniers.index') }}" class="bg-sky-700 text-white font-bold hover:bg-sky-800">
                Panier ({{ $panierCount }})
                </x-link-button>


            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-white hover:bg-sky-600 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-sky-600">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('categories.index')" :active="request()->routeIs('categories.index')" class="text-white">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
