<x-layouts.app :title="$post->title">

    <main class="py-24 md:py-32 bg-background/70">
        <div class="container mx-auto px-6">
            @if (session('success'))
                <div class="max-w-4xl mx-auto bg-primary/10 text-teal-300 border border-teal-500/20 p-4 rounded-lg mb-8">
                    {{ session('success') }}
                </div>
            @endif

            <div class="max-w-4xl mx-auto">
                {{-- Main Post --}}
                <div class="bg-card/50 backdrop-blur-sm rounded-xl border border-border/50 p-8">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&size=48&background=1f2937&color=9ca3af" alt="Avatar de {{ $post->user->name }}" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-semibold text-foreground">{{ $post->user->name }}</p>
                            <p class="text-sm text-muted-foreground">{{ $post->created_at->translatedFormat('d \d\e F, Y \à\s H:i') }}</p>
                        </div>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground mb-6">{{ $post->title }}</h1>
                    <div class="prose prose-invert prose-lg max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                    {{-- Actions: Like, etc. (funcionalidade a ser implementada) --}}
                    <div class="flex items-center gap-4 mt-6 pt-4 border-t border-border/50">
                        <form action="{{ route('posts.like', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="flex items-center gap-1.5 text-muted-foreground hover:text-foreground transition-colors">
                                <x-lucide-heart class="w-5 h-5"/>
                                <span class="font-semibold">{{ $post->likes }}</span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- New Comment Form --}}
                <livewire:post-comments :post="$post" />
            </div>
        </div>
    </main>
</x-layouts.app>
