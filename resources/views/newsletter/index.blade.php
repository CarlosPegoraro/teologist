<x-layouts.app :title="'Fórum de Discussão – Phrónesis'">

    {{-- Forum Header Section --}}
    <section class="relative bg-background text-foreground py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute inset-0 bg-gradient-to-br from-muted/30 via-background to-background animate-gradient-xy"></div>
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,hsl(var(--secondary)/0.1),_transparent_40%)]"></div>
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_80%_70%,hsl(var(--accent)/0.05),_transparent_40%)]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold font-serif mb-4 animate-fade-in-down">Mural de Noticias</h1>
            <p class="text-lg md:text-xl text-muted-foreground max-w-2xl mx-auto animate-fade-in-up"
               style="animation-delay: 100ms;">
                Mantenha-se atualizado sobre as principais noticias dos ultimos dias e acompanhe as novidades do mundo.
            </p>
        </div>
    </section>

    {{-- Forum Content Section --}}
    <main class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <h2 class="text-2xl font-bold text-foreground mb-4 md:mb-0">Ultimas Noticias ao Redor do Mundo</h2>
            </div>

            <div class="bg-card/50 backdrop-blur-sm rounded-xl border border-border/50">
                <ul class="divide-y divide-gray-700/50">
                    @forelse($news as $new)
                        <li class="p-6 hover:bg-card/40 transition-colors duration-200">
                            <a href="{{ $new->link }}" target="_blank" class="block">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $new->thumbnail }}" alt="{{ $new->source[0] }}"
                                             class="w-12 h-12 rounded-full hidden sm:block">
                                        <div>
                                            <h3 class="text-lg font-bold text-foreground group-hover:text-primary transition-colors">{{ $new->title }}</h3>
                                            <p class="text-sm text-muted-foreground mt-1">
                                                Pesquisa por <span class="font-semibold">{{ $new->source }}</span>
                                                <span class="text-muted-foreground mx-1"> - </span>
                                                {{ $new->date }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-md text-muted-foreground mt-3">
                                    {{ $new->snippet }}
                                </p>
                            </a>
                        </li>
                    @empty
                        <li class="p-8 text-center text-muted-foreground">
                            <x-lucide-message-square-dashed class="mx-auto h-12 w-12"/>
                            <p class="mt-4 font-semibold">Nenhuma discussão iniciada ainda.</p>
                            <p class="text-sm">Seja o primeiro a começar uma conversa!</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </main>
</x-layouts.app>
