<x-layouts.app :title="'Nossos Colaboradores – Phrónesis'">

    {{-- Authors Header Section --}}
    <section class="relative bg-background text-foreground py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 via-gray-900 to-black animate-gradient-xy"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_70%,_rgba(30,200,150,0.1),_transparent_40%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_30%,_rgba(241,196,15,0.1),_transparent_40%)]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold font-serif mb-4 animate-fade-in-down">Nossos Colaboradores</h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 100ms;">
                Conheça as mentes por trás de nossas análises e reflexões.
            </p>
        </div>
    </section>

    {{-- Authors Grid Section --}}
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            @if($authors->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($authors as $author)
                        <div class="animate-fade-in-up text-center" style="animation-delay: {{ $loop->index * 100 }}ms;">
                            <a href="{{ route('authors.show', $author) }}" class="group block bg-card/50 backdrop-blur-sm rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-2 border border-transparent hover:border-teal-500/50">
                                <img src="{{ $author->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($author->name).'&size=128&background=1f2937&color=9ca3af' }}"
                                     alt="Foto de {{ $author->name }}"
                                     class="w-32 h-32 rounded-full mx-auto mb-4 border-4 border-border/50 group-hover:border-teal-500/50 transition-colors duration-300">
                                <h2 class="text-xl font-bold font-serif text-foreground group-hover:text-primary transition-colors duration-300">{{ $author->name }}</h2>
                                <p class="text-primary text-sm font-semibold mt-1">{{ $author->title }}</p>
                                <p class="text-xs text-muted-foreground mt-2">{{ $author->blogs_count }} {{ Str::plural('artigo', $author->blogs_count) }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="mt-16">
                    {{ $authors->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <x-lucide-users class="mx-auto h-16 w-16 text-muted-foreground" />
                    <h3 class="mt-4 text-xl font-semibold text-foreground">Nenhum colaborador encontrado</h3>
                    <p class="mt-2 text-muted-foreground">Estamos formando nossa equipe. Volte em breve!</p>
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
