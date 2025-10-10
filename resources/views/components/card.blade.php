@props([
    'icon',
    'title',
    'subTitle',
    'route',
    'routeParams' => [],
    'linkMessage',
    'color' => 'primary', // Pode ser 'primary', 'accident', ou 'secondary'
])

@php
    $colorClasses = match ($color) {
        'accent' => [
            'border' => 'border-accent/30 hover:border-accent',
            'shadow' => 'hover:shadow-accent/20',
            'gradient_bar' => 'from-accent to-accent/50',
            'gradient_icon' => 'from-accent to-accent/70',
            'shadow_icon' => 'shadow-accent/30',
            'text' => 'text-accent',
            'icon_text' => 'text-white',
        ],
        'secondary' => [
            'border' => 'border-secondary/30 hover:border-secondary',
            'shadow' => 'hover:shadow-secondary/20',
            'gradient_bar' => 'from-secondary to-secondary/50',
            'gradient_icon' => 'from-secondary to-secondary/70',
            'shadow_icon' => 'shadow-secondary/30',
            'text' => 'text-secondary',
            'icon_text' => 'text-white',
        ],
        default => [
            'border' => 'border-primary/30 hover:border-primary',
            'shadow' => 'hover:shadow-primary/20',
            'gradient_bar' => 'from-primary to-primary/50',
            'gradient_icon' => 'from-primary to-primary/70',
            'shadow_icon' => 'shadow-primary/30',
            'text' => 'text-primary',
            'icon_text' => 'text-white',
        ],
    };
@endphp

<div
    @class([
        'border-2 transition-all duration-300 relative overflow-hidden group rounded-xl bg-card hover:shadow-xl',
        $colorClasses['border'],
        $colorClasses['shadow'],
    ])>
    <div @class(['absolute top-0 left-0 right-0 h-1 bg-gradient-to-r', $colorClasses['gradient_bar']])></div>
    <div class="p-6">
        <div
            @class([
                'w-14 h-14 rounded-xl bg-gradient-to-br flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform',
                $colorClasses['gradient_icon'],
                $colorClasses['shadow_icon'],
            ])>
            <x-dynamic-component :component="'lucide-' . $icon" :class="\Illuminate\Support\Arr::toCssClasses(['h-7 w-7', $colorClasses['icon_text']])" />
        </div>
        <h3 @class(['text-2xl font-primary', $colorClasses['text']])>{{ $title }}</h3>
    </div>
    <div class="px-6 pb-6">
        <p class="text-sm text-muted-foreground mb-4 leading-relaxed font-reading">{{ $slot }}</p>
        <a href="{{ route($route, $routeParams) }}"
            @class(['inline-flex items-center font-semibold group/link', $colorClasses['text']])>
            {{ $linkMessage }}
            <x-lucide-arrow-right class="ml-1 h-4 w-4 group-hover/link:translate-x-1 transition-transform"/>
        </a>
    </div>
</div>
