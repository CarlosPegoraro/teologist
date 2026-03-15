<x-layouts.app :title="'Blog – Phrónesis'">
    <section class="relative bg-background text-foreground py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-muted/30 via-background to-background animate-gradient-xy"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,hsl(var(--primary)/0.1),_transparent_40%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_70%,hsl(var(--accent)/0.1),_transparent_40%)]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold font-serif mb-4 animate-fade-in-down">Nosso Blog</h1>
            <p class="text-lg md:text-xl text-muted-foreground max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 100ms;">
                Análises e reflexões sobre os pilares da sociedade.
            </p>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            @if($blogs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <x-ui.blog-card :blog="$blog" :loop="$loop" />
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="mt-16">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <x-lucide-search class="mx-auto h-16 w-16 text-muted-foreground" />
                    <h3 class="mt-4 text-xl font-semibold text-foreground">Nenhum artigo encontrado</h3>
                    <p class="mt-2 text-muted-foreground">Ainda estamos preparando nosso conteúdo. Volte em breve!</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
