<x-layouts.app :title="$author->name . ' – Phrónesis'">

    {{-- Author Profile Header --}}
    <section class="relative bg-background text-foreground py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50 via-background to-stone-100 dark:from-gray-800 dark:via-gray-900 dark:to-black animate-gradient-xy"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,_rgba(30,200,150,0.12),_transparent_40%)] dark:bg-[radial-gradient(circle_at_20%_80%,_rgba(30,200,150,0.1),_transparent_40%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_30%,_rgba(241,196,15,0.14),_transparent_40%)] dark:bg-[radial-gradient(circle_at_80%_30%,_rgba(241,196,15,0.1),_transparent_40%)]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                <div class="flex-shrink-0 animate-fade-in-down">
                    <img src="{{ $author->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($author->name).'&size=160&background=1f2937&color=9ca3af' }}"
                         alt="Foto de {{ $author->name }}"
                         class="w-40 h-40 rounded-full border-4 border-border/50">
                </div>
                <div class="text-center md:text-left animate-fade-in-up">
                    <h1 class="text-4xl md:text-5xl font-bold font-serif mb-2">{{ $author->name }}</h1>
                    <p class="text-xl font-semibold text-primary mb-4">{{ $author->title }}</p>
                    <p class="text-muted-foreground max-w-2xl leading-relaxed">{{ $author->about }}</p>
                    {{-- Social Links --}}
                    <div class="flex justify-center md:justify-start gap-4 mt-6">
                        @if($author->site)
                            <a href="{{ $author->site }}" target="_blank" class="text-muted-foreground hover:text-foreground transition-colors">
                                <x-lucide-globe class="w-6 h-6" />
                                <span class="sr-only">Site</span>
                            </a>
                        @endif
                        @if($author->instagram)
                            <a href="https://instagram.com/{{ $author->instagram }}" target="_blank" class="text-muted-foreground hover:text-foreground transition-colors">
                                <x-lucide-instagram class="w-6 h-6" />
                                <span class="sr-only">Instagram</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Author's Articles --}}
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold font-serif text-foreground mb-12">Artigos de {{ $author->name }}</h2>

            @if($blogs->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <div class="animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms;">
                            {{-- Reusing the same blog card style for consistency --}}
                            <a href="{{ route('blogs.show', $blog) }}"
                               class="group block bg-card/50 backdrop-blur-sm rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-border/50 hover:border-teal-500/50">
                                <div class="relative">
                                    <img src="{{ $blog->thumbnail }}" alt="Imagem para {{ $blog->title }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4 flex flex-wrap gap-2">
                                        @foreach($blog->categories->take(2) as $category)
                                            <span class="px-2 py-1 text-xs font-semibold text-foreground bg-primary/80 rounded">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h2 class="text-xl font-bold font-serif mb-2 text-foreground leading-snug group-hover:text-primary transition-colors duration-300">{{ $blog->title }}</h2>
                                    <p class="text-muted-foreground text-sm">{{ $blog->created_at->translatedFormat('d \d\e F, Y') }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-16 border-2 border-dashed border-border rounded-xl">
                    <x-lucide-file-text class="mx-auto h-12 w-12 text-muted-foreground" />
                    <h3 class="mt-4 text-xl font-semibold text-foreground">Nenhum artigo publicado</h3>
                    <p class="mt-2 text-muted-foreground">{{ $author->name }} ainda não publicou nenhum artigo.</p>
                </div>
            @endif
        </div>
    </section>

</x-layouts.app>
