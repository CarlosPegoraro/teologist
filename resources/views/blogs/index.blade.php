<x-layouts.app :title="'Blog – Phrónesis'">

    {{-- Blog Header Section --}}
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

    {{-- Blog Grid Section --}}
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            @if($blogs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <div class="animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms;">
                            <a href="{{ route('blogs.show', $blog) }}"
                               class="group block bg-card/50 backdrop-blur-sm rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-border/50 hover:border-teal-500/50">
                                {{-- Image & Category --}}
                                <div class="relative">
                                    <img src="{{ $blog->thumbnail }}" alt="Imagem para {{ $blog->title }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4 flex flex-wrap gap-2">
                                        @foreach($blog->categories->take(2) as $category)
                                            <span class="px-2 py-1 text-xs font-semibold text-foreground bg-primary/80 rounded">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- Content --}}
                                <div class="p-6">
                                    <h2 class="text-xl font-bold font-serif mb-2 text-foreground leading-snug group-hover:text-primary transition-colors duration-300">{{ $blog->title }}</h2>
                                    <p class="text-muted-foreground text-sm mb-4">{{ $blog->subtitle }}</p>
                                    {{-- Author --}}
                                    <div class="flex items-center gap-3 pt-4 border-t border-border/50">
                                        <img src="{{ $blog->author->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($blog->author->name).'&color=7F9CF5&background=EBF4FF' }}" alt="Foto de {{ $blog->author->name }}" class="w-10 h-10 rounded-full">
                                        <div>
                                            <p class="font-semibold text-foreground text-sm">{{ $blog->author->name }}</p>
                                            <p class="text-xs text-muted-foreground">{{ $blog->created_at->translatedFormat('d \d\e F, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
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
