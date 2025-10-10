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

            @foreach($categories as $category)
                <div
                    class="text-center hover:shadow-lg transition-all duration-300 border-2 rounded-xl bg-card {{ $colorClasses[$category['color']] ?? '' }}">
                    <div class="p-6">
                        <div class="flex justify-center mb-3">
                            <div class="w-12 h-12 rounded-full bg-background flex items-center justify-center">
                                @switch($category['icon'])
                                    @case('sparkles')
                                        <x-lucide-sparkles
                                            class="h-6 w-6 {{ $iconColor[$category['color']] ?? '' }}"/>
                                        @break
                                    @case('users')
                                        <x-lucide-users class="h-6 w-6 {{ $iconColor[$category['color']] ?? '' }}"/>
                                        @break
                                    @case('trending-up')
                                        <x-lucide-trending-up
                                            class="h-6 w-6 {{ $iconColor[$category['color']] ?? '' }}"/>
                                        @break
                                @endswitch
                            </div>
                        </div>
                        <h3 class="text-xl font-serif">{{ $category['title'] }}</h3>
                        <p class="text-sm text-muted-foreground leading-relaxed">{{ $category['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
