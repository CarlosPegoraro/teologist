<?php

use function Livewire\Volt\{state};

state([
    'categories' => [
        [
            'title' => 'Teologia',
            'description' => 'Fé, espiritualidade e questões transcendentais.',
            'color' => 'primary',
            'icon' => 'sparkles',
            'slug' => 'teologia'
        ],
        [
            'title' => 'Política',
            'description' => 'Poder, governança e organização social.',
            'color' => 'accent',
            'icon' => 'users',
            'slug' => 'politica'
        ],
        [
            'title' => 'Economia',
            'description' => 'Recursos, trabalho e sistemas econômicos.',
            'color' => 'secondary',
            'icon' => 'trending-up',
            'slug' => 'economia'
        ],
        [
            'title' => 'Sociologia',
            'description' => 'Sociedade, cultura e relações humanas.',
            'color' => 'primary',
            'icon' => 'building',
            'slug' => 'sociologia'
        ],
    ],
]);

?>

<section class="py-20 md:py-28 bg-background">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4 text-foreground">Áreas de Conhecimento</h2>
            <p class="text-muted-foreground text-lg max-w-2xl mx-auto">Exploramos questões fundamentais em quatro grandes áreas.</p>
        </div>

        @php
            // Mapeamento de classes para um código mais limpo na view
            $colorMap = [
                'primary' => [
                    'border' => 'border-teal-500/20 hover:border-teal-400/50',
                    'icon' => 'text-primary',
                    'glow' => 'glow-teal',
                ],
                'accent' => [
                    'border' => 'border-yellow-500/20 hover:border-yellow-400/50',
                    'icon' => 'text-accent',
                    'glow' => 'glow-yellow',
                ],
                'secondary' => [
                    'border' => 'border-indigo-500/20 hover:border-indigo-400/50',
                    'icon' => 'text-indigo-400',
                    'glow' => 'glow-indigo',
                ],
            ];
        @endphp

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                @php
                    $colors = $colorMap[$category['color']] ?? $colorMap['primary'];
                    $iconComponent = 'lucide-' . $category['icon'];
                @endphp
                <a
                    href="#" {{-- Substitua # pelo seu link de categoria, ex: route('categories.show', $category['slug']) --}}
                class="group relative text-center p-8 rounded-2xl bg-card/40 backdrop-blur-sm border transition-all duration-300 transform hover:-translate-y-2 {{ $colors['border'] }} {{ $colors['glow'] }}"
                    style="animation-delay: {{ 200 + $loop->index * 150 }}ms;"
                >
                    {{-- Glow effect --}}
                    <div class="absolute -inset-px rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <div class="relative z-10 flex flex-col items-center">
                        <div class="flex-shrink-0 mb-5">
                            <div class="w-16 h-16 rounded-full bg-background/50 flex items-center justify-center border border-border/50">
                                <x-dynamic-component :component="$iconComponent" class="h-8 w-8 {{ $colors['icon'] }}" />
                            </div>
                        </div>
                        <h3 class="text-xl font-bold font-serif mb-2 text-foreground">{{ $category['title'] }}</h3>
                        <p class="text-sm text-muted-foreground leading-relaxed">{{ $category['description'] }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
