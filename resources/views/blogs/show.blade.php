<x-layouts.app :title="$blog->title">

    {{-- Article Header with Background Image --}}
    <header
        class="relative text-foreground py-24 md:py-40 flex items-center justify-center text-center bg-cover bg-center"
        style="background-image: url('{{ $blog->thumbnail }}')">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>
        <div class="relative container mx-auto px-6 animate-fade-in-up">
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-wrap gap-2 justify-center mb-4">
                    @foreach($blog->categories as $category)
                        <span
                            class="px-3 py-1 text-sm font-semibold bg-primary/80 rounded-full">{{ $category->name }}</span>
                    @endforeach
                </div>
                <h1 class="text-4xl md:text-6xl font-bold font-serif mb-4">{{ $blog->title }}</h1>
                <p class="text-lg md:text-xl text-gray-300 mb-8">{{ $blog->subtitle }}</p>
                <div class="flex items-center justify-center gap-4">
                    <img
                        src="{{ $blog->author->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($blog->author->name) }}"
                        alt="Foto de {{ $blog->author->name }}" class="w-12 h-12 rounded-full border-2 border-white/50">
                    <div>
                        <p class="font-semibold">{{ $blog->author->name }}</p>
                        <p class="text-sm text-muted-foreground">{{ $blog->created_at->translatedFormat('d \d\e F, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Article Content --}}
    <article class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            {{-- The 'prose' class from Tailwind Typography is key here for beautiful article formatting --}}
            <div class="prose prose-invert prose-lg max-w-3xl mx-auto">
                <blockquote class="text-2xl font-bold mb-4">{{ $blog->about }}</blockquote>

                @foreach($blog->contents()->orderBy('order')->get() as $content)
                    <div class="text-md mb-4">
                        {!! $content->content !!}
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- Author Bio Section --}}
    <section class="py-16 bg-background border-t border-gray-800">
        <div class="container mx-auto px-6 max-w-3xl">
            <div class="flex flex-col sm:flex-row items-center gap-6 bg-card/50 p-8 rounded-xl">
                <img
                    src="{{ $blog->author->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($blog->author->name) }}"
                    alt="Foto de {{ $blog->author->name }}" class="w-24 h-24 rounded-full flex-shrink-0">
                <div class="text-center sm:text-left">
                    <h3 class="text-xs uppercase font-semibold text-muted-foreground tracking-wider">Escrito por</h3>
                    <p class="text-2xl font-bold font-serif text-foreground mt-1">{{ $blog->author->name }}</p>
                    <p class="text-muted-foreground mt-2">{{ $blog->author->bio }}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Back to Blog Link --}}
    <div class="py-12 text-center bg-background/70">
        <a href="{{ route('blogs.index') }}"
           class="group inline-flex items-center text-primary font-semibold transition-all duration-300 hover:text-teal-300">
            <x-lucide-arrow-left
                class="mr-2 h-5 w-5 transform transition-transform duration-300 group-hover:-translate-x-1"/>
            Voltar para o Blog
        </a>
    </div>

</x-layouts.app>
