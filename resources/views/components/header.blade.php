<header x-data="{ mobileMenuOpen: false }"
        class="fixed top-0 left-0 right-0 z-40 bg-background/70 backdrop-blur-lg border-b border-border">
    <nav class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" wire:navigate>
                    <x-app-logo class="w-auto h-8 text-foreground"/>
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('blogs.index') }}" wire:navigate
                   class="text-sm font-semibold {{ request()->routeIs('blogs.*') ? 'text-foreground' : 'text-muted-foreground' }} hover:text-foreground transition-colors">Blog</a>
                <a href="{{ route('authors.index') }}" wire:navigate
                   class="text-sm font-semibold {{ request()->routeIs('authors.*') ? 'text-foreground' : 'text-muted-foreground' }} hover:text-foreground transition-colors">Colaboradores</a>
                {{-- Adicione a rota do fórum aqui quando tiver --}}
                {{-- <a href="#" class="text-sm font-semibold text-muted-foreground hover:text-foreground transition-colors">Fórum</a> --}}
            </div>

            {{-- Auth & User Menu (Desktop) --}}
            <div class="hidden md:flex items-center justify-end">
                @guest
                    <a href="{{ route('login') }}" wire:navigate
                       class="text-sm font-semibold text-gray-300 hover:text-foreground transition-colors mr-4">Login</a>
                    <a href="{{ route('register') }}" wire:navigate
                       class="inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-4 h-9 rounded-md text-sm transition-colors">Registrar</a>
                @endguest

                @auth
                    <div class="flex items-center space-x-4">
                        <button @click="theme = (theme === 'dark' ? 'light' : 'dark')"
                                class="text-muted-foreground hover:text-foreground transition-colors">
                            <x-lucide-sun class="h-6 w-6" x-show="theme === 'dark'" style="display: none;"/>
                            <x-lucide-moon class="h-6 w-6" x-show="theme === 'light'" style="display: none;"/>
                        </button>
                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen"
                                    class="flex items-center space-x-2 focus:outline-none">
                                <span class="text-sm font-semibold text-foreground">{{ Auth::user()->name }}</span>
                                <img class="h-8 w-8 rounded-full"
                                     src="{{ Auth::user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&size=32&background=1f2937&color=9ca3af' }}"
                                     alt="User avatar">
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                                 x-transition:enter-end="opacity-100 transform translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform translate-y-0"
                                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                                 class="absolute right-0 mt-2 w-48 bg-card rounded-md shadow-lg py-1 border border-border"
                                 style="display: none;">

                                @hasanyrole('admin|supervisor|author')
                                <a href="{{ route('admin.dashboard') }}"
                                   class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-foreground">Dashboard</a>
                                @endhasanyrole
                                <a href="{{ route('profile.edit') }}"
                                   class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-foreground">Configurações</a>
                                <div class="border-t border-border my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full text-left block px-4 py-2 text-sm text-red-400 hover:bg-red-500/20 hover:text-red-300">
                                        Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-muted-foreground hover:text-foreground focus:outline-none">
                    <x-lucide-menu class="h-6 w-6" x-show="!mobileMenuOpen"/>
                    <x-lucide-x class="h-6 w-6" x-show="mobileMenuOpen" style="display: none;"/>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" class="md:hidden" style="display: none;">
            <div class="pt-4 pb-3 border-t border-border">
                <div class="space-y-1 px-2">
                    <a href="{{ route('blogs.index') }}" wire:navigate
                       class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('blogs.*') ? 'bg-gray-700 text-foreground' : 'text-muted-foreground' }} hover:bg-card hover:text-foreground">Blog</a>
                    <a href="{{ route('authors.index') }}" wire:navigate
                       class="block rounded-md px-3 py-2 text-base font-medium {{ request()->routeIs('authors.*') ? 'bg-gray-700 text-foreground' : 'text-muted-foreground' }} hover:bg-card hover:text-foreground">Colaboradores</a>
                </div>
                <div class="mt-3 border-t border-border pt-3">
                    @guest
                        <div class="space-y-1 px-2">
                            <a href="{{ route('login') }}"
                               class="block rounded-md px-3 py-2 text-base font-medium text-muted-foreground hover:bg-card hover:text-foreground">Login</a>
                            <a href="{{ route('register') }}"
                               class="block rounded-md px-3 py-2 text-base font-medium text-muted-foreground hover:bg-card hover:text-foreground">Registrar</a>
                        </div>
                    @endguest
                    @auth
                        <div class="px-5 flex items-center">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full"
                                     src="{{ Auth::user()->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&size=40&background=1f2937&color=9ca3af' }}"
                                     alt="">
                            </div>
                            <div class="ml-3">
                                <div class="text-base font-medium text-foreground">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-muted-foreground">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1 px-2">
                            @hasanyrole('admin|supervisor|author')
                            <a href="{{ route('admin.dashboard') }}"
                               class="block rounded-md px-3 py-2 text-base font-medium text-muted-foreground hover:bg-card hover:text-foreground">Dashboard</a>
                            @endhasanyrole
                            <a href="{{ route('profile.edit') }}"
                               class="block rounded-md px-3 py-2 text-base font-medium text-muted-foreground hover:bg-card hover:text-foreground">Configurações</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left block rounded-md px-3 py-2 text-base font-medium text-muted-foreground hover:bg-card hover:text-foreground">
                                    Sair
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
</header>
