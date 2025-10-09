{{-- resources/views/livewire/home.blade.php --}}
<?php

use function Livewire\Volt\{state};

state([
    'categories' => [
        [
            'title' => 'Teologia',
            'description' => 'Fé, espiritualidade e questões transcendentais',
            'color' => 'primary',
            'icon' => 'sparkles',
        ],
        [
            'title' => 'Política',
            'description' => 'Poder, governança e organização social',
            'color' => 'accent',
            'icon' => 'users',
        ],
        [
            'title' => 'Economia',
            'description' => 'Recursos, trabalho e sistemas econômicos',
            'color' => 'secondary',
            'icon' => 'trending-up',
        ],
        [
            'title' => 'Sociologia',
            'description' => 'Sociedade, cultura e relações humanas',
            'color' => 'primary',
            'icon' => 'users',
        ],
    ],
]);
?>

<x-layouts.app :title="'Phrónesis – Sabedoria prática'">
    {{-- Hero Section --}}
    <section
        class="relative bg-gradient-to-br from-[#2c3e50] via-[#34495e] to-[#2c3e50] text-white py-24 md:py-32 overflow-hidden">
        {{-- grid background pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0"
                 style="background-image:linear-gradient(rgba(26,188,156,.3) 1px,transparent 1px),linear-gradient(90deg, rgba(26,188,156,.3) 1px,transparent 1px); background-size:60px 60px;"></div>
        </div>

        {{-- decorative elements --}}
        <div class="absolute top-20 right-10 w-72 h-72 border-4 border-primary/20 rounded-full"></div>
        <div class="absolute top-32 right-24 w-48 h-48 border-4 border-accent/20 rounded-full"></div>
        <div
            class="absolute bottom-20 left-10 w-64 h-64 bg-gradient-to-br from-primary/20 to-transparent rounded-full blur-2xl"></div>
        <div
            class="absolute top-1/2 right-0 w-96 h-96 bg-gradient-to-l from-accent/10 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute top-40 left-20 w-16 h-16 border-2 border-primary/30 rotate-45"></div>
        <div class="absolute bottom-40 right-32 w-12 h-12 border-2 border-accent/30 rotate-12"></div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-col lg:flex-row items-center gap-12">

                    {{-- Main copy --}}
                    <div class="flex-1 text-center lg:text-left">
                        <div
                            class="inline-flex items-center gap-2 bg-primary/20 backdrop-blur-sm text-primary px-5 py-2.5 rounded-full mb-8 border-2 border-primary/40 shadow-lg shadow-primary/20">
                            <x-lucide-sparkles class="h-4 w-4"/>
                            <span class="text-sm font-bold tracking-wide">PLATAFORMA DE CONHECIMENTO</span>
                        </div>

                        <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold font-serif mb-6 leading-tight">
                            Sabedoria Prática para um
                            <span class="relative inline-block">
                                <span class="relative z-10 text-primary"> Mundo Complexo</span>
                                <span class="absolute bottom-2 left-0 right-0 h-3 bg-primary/30 -rotate-1"></span>
                            </span>
                        </h1>

                        <p class="text-lg md:text-xl text-white/90 mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                            Explore ideias profundas sobre teologia, política, economia e sociologia de forma clara,
                            dinâmica e acessível.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                            <a href="{{ route('blog.index') }}"
                               class="inline-flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-semibold px-8 h-14 rounded-md shadow-xl shadow-primary/30">
                                Explorar Blog
                                <x-lucide-arrow-right class="ml-2 h-5 w-5"/>
                            </a>
                            <a href="{{ route('forum.index') }}"
                               class="inline-flex items-center justify-center border-2 border-accent text-accent hover:bg-accent hover:text-accent-foreground bg-white/5 backdrop-blur-sm font-semibold px-8 h-14 rounded-md shadow-xl">
                                Participar do Fórum
                            </a>
                        </div>
                    </div>

                    {{-- Phi visual --}}
                    <div class="hidden lg:block relative w-80 h-80">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="relative">
                                <div
                                    class="absolute inset-0 w-80 h-80 border-4 border-primary/20 rounded-full animate-pulse"></div>
                                <div
                                    class="absolute inset-8 w-64 h-64 border-4 border-accent/20 rounded-full animate-pulse"
                                    style="animation-delay:.5s"></div>
                                <div class="relative w-80 h-80 flex items-center justify-center">
                                    <svg viewBox="0 0 100 100" class="w-40 h-40">
                                        <defs>
                                            <linearGradient id="phiGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                <stop offset="0%" stop-color="#1ABC9C"/>
                                                <stop offset="100%" stop-color="#F1C40F"/>
                                            </linearGradient>
                                        </defs>
                                        <text x="50" y="75" font-size="80" font-family="serif" font-weight="bold"
                                              fill="url(#phiGradient)" text-anchor="middle">Φ
                                        </text>
                                    </svg>
                                </div>
                                <div
                                    class="absolute top-0 left-1/2 w-3 h-3 bg-primary rounded-full -translate-x-1/2"></div>
                                <div
                                    class="absolute bottom-0 left-1/2 w-3 h-3 bg-accent rounded-full -translate-x-1/2"></div>
                                <div
                                    class="absolute left-0 top-1/2 w-3 h-3 bg-primary rounded-full -translate-y-1/2"></div>
                                <div
                                    class="absolute right-0 top-1/2 w-3 h-3 bg-accent rounded-full -translate-y-1/2"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- bottom wave --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <path
                    d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                    fill="hsl(var(--background))"/>
            </svg>
        </div>
    </section>

    {{-- Three ways section --}}
    <section class="py-16 md:py-24 bg-gradient-to-b from-background to-muted/30">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4">
                    Três Formas de <span class="text-primary">Aprender</span> e <span
                        class="text-accent">Participar</span>
                </h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto">Nossa plataforma oferece diferentes maneiras
                    de se engajar com o conhecimento</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Blog card --}}
                <div
                    class="border-2 border-primary/30 hover:border-primary hover:shadow-xl hover:shadow-primary/20 transition-all duration-300 relative overflow-hidden group rounded-xl bg-card">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary to-primary/50"></div>
                    <div class="p-6">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary to-primary/70 flex items-center justify-center mb-4 shadow-lg shadow-primary/30 group-hover:scale-110 transition-transform">
                            <x-lucide-book-open class="h-7 w-7 text-white"/>
                        </div>
                        <h3 class="text-2xl font-serif text-primary">Blog</h3>
                        <p class="text-base text-muted-foreground">Conteúdos claros e acessíveis sobre temas
                            complexos</p>
                    </div>
                    <div class="px-6 pb-6">
                        <p class="text-sm text-muted-foreground mb-4 leading-relaxed">Artigos cuidadosamente escritos
                            para tornar ideias profundas compreensíveis para todos, sem perder a riqueza do
                            conteúdo.</p>
                        <a href="{{ route('blog.index') }}"
                           class="inline-flex items-center font-semibold text-primary group/link">
                            Ler artigos
                            <x-lucide-arrow-right
                                class="ml-1 h-4 w-4 group-hover/link:translate-x-1 transition-transform"/>
                        </a>
                    </div>
                </div>

                {{-- Fórum card --}}
                <div
                    class="border-2 border-accent/30 hover:border-accent hover:shadow-xl hover:shadow-accent/20 transition-all duration-300 relative overflow-hidden group rounded-xl bg-card">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-accent to-accent/50"></div>
                    <div class="p-6">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-accent to-accent/70 flex items-center justify-center mb-4 shadow-lg shadow-accent/30 group-hover:scale-110 transition-transform">
                            <x-lucide-message-square class="h-7 w-7 text-accent-foreground"/>
                        </div>
                        <h3 class="text-2xl font-serif text-accent">Fórum</h3>
                        <p class="text-base text-muted-foreground">Espaço para debate e troca de ideias</p>
                    </div>
                    <div class="px-6 pb-6">
                        <p class="text-sm text-muted-foreground mb-4 leading-relaxed">Proponha temas, compartilhe
                            perspectivas e participe de discussões construtivas com outros interessados.</p>
                        <a href="{{ route('forum.index') }}"
                           class="inline-flex items-center font-semibold text-accent group/link">
                            Participar
                            <x-lucide-arrow-right
                                class="ml-1 h-4 w-4 group-hover/link:translate-x-1 transition-transform"/>
                        </a>
                    </div>
                </div>

                {{-- Notícias card --}}
                <div
                    class="border-2 border-secondary/30 hover:border-secondary hover:shadow-xl hover:shadow-secondary/20 transition-all duration-300 relative overflow-hidden group rounded-xl bg-card">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-secondary to-secondary/50"></div>
                    <div class="p-6">
                        <div
                            class="w-14 h-14 rounded-xl bg-gradient-to-br from-secondary to-secondary/70 flex items-center justify-center mb-4 shadow-lg shadow-secondary/30 group-hover:scale-110 transition-transform">
                            <x-lucide-newspaper class="h-7 w-7 text-white"/>
                        </div>
                        <h3 class="text-2xl font-serif text-secondary">Notícias</h3>
                        <p class="text-base text-muted-foreground">Atualizações sobre temas relevantes</p>
                    </div>
                    <div class="px-6 pb-6">
                        <p class="text-sm text-muted-foreground mb-4 leading-relaxed">Fique por dentro das principais
                            notícias e desenvolvimentos nas áreas de teologia, política, economia e sociologia.</p>
                        <a href="{{ route('new.index') }}"
                           class="inline-flex items-center font-semibold text-secondary group/link">
                            Ver notícias
                            <x-lucide-arrow-right
                                class="ml-1 h-4 w-4 group-hover/link:translate-x-1 transition-transform"/>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Knowledge areas --}}
    <section class="py-16 md:py-24 bg-muted/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4">Áreas de Conhecimento</h2>
                <p class="text-muted-foreground text-lg max-w-2xl mx-auto">Exploramos questões fundamentais em quatro
                    grandes áreas</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $colorClasses = [
                        'primary' => 'border-primary/40 hover:border-primary bg-primary/5 hover:bg-primary/10',
                        'accent' => 'border-accent/40 hover:border-accent bg-accent/5 hover:bg-accent/10',
                        'secondary' => 'border-secondary/40 hover:border-secondary bg-secondary/5 hover:bg-secondary/10',
                    ];
                    $iconColor = [
                        'primary' => 'text-primary',
                        'accent' => 'text-accent',
                        'secondary' => 'text-secondary',
                    ];
                @endphp

{{--                @foreach($categories as $category)--}}
{{--                    <div--}}
{{--                        class="text-center hover:shadow-lg transition-all duration-300 border-2 rounded-xl bg-card {{ $colorClasses[$category['color']] ?? '' }}">--}}
{{--                        <div class="p-6">--}}
{{--                            <div class="flex justify-center mb-3">--}}
{{--                                <div class="w-12 h-12 rounded-full bg-background flex items-center justify-center">--}}
{{--                                    @switch($category['icon'])--}}
{{--                                        @case('sparkles')--}}
{{--                                            <x-lucide-sparkles--}}
{{--                                                class="h-6 w-6 {{ $iconColor[$category['color']] ?? '' }}"/>--}}
{{--                                            @break--}}
{{--                                        @case('users')--}}
{{--                                            <x-lucide-users class="h-6 w-6 {{ $iconColor[$category['color']] ?? '' }}"/>--}}
{{--                                            @break--}}
{{--                                        @case('trending-up')--}}
{{--                                            <x-lucide-trending-up--}}
{{--                                                class="h-6 w-6 {{ $iconColor[$category['color']] ?? '' }}"/>--}}
{{--                                            @break--}}
{{--                                    @endswitch--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <h3 class="text-xl font-serif">{{ $category['title'] }}</h3>--}}
{{--                            <p class="text-sm text-muted-foreground leading-relaxed">{{ $category['description'] }}</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
            </div>
        </div>
    </section>

</x-layouts.app>
