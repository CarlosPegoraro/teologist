<x-layouts.app :title="'Fórum de Discussão – Phrónesis'">

    {{-- Forum Header Section --}}
    <section class="relative bg-background text-foreground py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-muted/30 via-background to-background animate-gradient-xy"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,hsl(var(--secondary)/0.1),_transparent_40%)]"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_70%,hsl(var(--accent)/0.05),_transparent_40%)]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold font-serif mb-4 animate-fade-in-down">Fórum de Discussão</h1>
            <p class="text-lg md:text-xl text-muted-foreground max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 100ms;">
                Um espaço para debate construtivo e troca de ideias.
            </p>
        </div>
    </section>

    {{-- Forum Content Section --}}
    <main class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <h2 class="text-2xl font-bold text-foreground mb-4 md:mb-0">Tópicos Recentes</h2>
                @auth
                    <a href="{{ route('posts.create') }}" class="group w-full md:w-auto inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-6 h-11 rounded-lg shadow-lg shadow-teal-500/20 transition-all duration-300">
                        <x-lucide-plus class="mr-2 h-5 w-5"/>
                        Iniciar Nova Discussão
                    </a>
                @endauth
            </div>

            <div class="bg-card/50 backdrop-blur-sm rounded-xl border border-border/50">
                <ul class="divide-y divide-gray-700/50">
                    @forelse($posts as $post)
                        <li class="p-6 hover:bg-card/40 transition-colors duration-200">
                            <a href="{{ route('posts.show', $post) }}" class="block">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-4">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($post->user->name) }}&size=48&background=1f2937&color=9ca3af" alt="Avatar de {{ $post->user->name }}" class="w-12 h-12 rounded-full hidden sm:block">
                                        <div>
                                            <h3 class="text-lg font-bold text-foreground group-hover:text-primary transition-colors">{{ $post->title }}</h3>
                                            <p class="text-sm text-muted-foreground mt-1">
                                                Iniciado por <span class="font-semibold">{{ $post->user->name }}</span>
                                                <span class="text-muted-foreground mx-1">&middot;</span>
                                                {{ $post->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 ml-4 hidden sm:flex items-center gap-4 text-sm text-muted-foreground">
                                        <div class="flex items-center gap-1.5">
                                            <x-lucide-message-circle class="w-4 h-4" />
                                            <span>{{ $post->comments_count }}</span>
                                        </div>
                                        <div class="flex items-center gap-1.5">
                                            <x-lucide-heart class="w-4 h-4" />
                                            <span>{{ $post->likes }}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="p-8 text-center text-muted-foreground">
                            <x-lucide-message-square-dashed class="mx-auto h-12 w-12" />
                            <p class="mt-4 font-semibold">Nenhuma discussão iniciada ainda.</p>
                            <p class="text-sm">Seja o primeiro a começar uma conversa!</p>
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="mt-12">
                {{ $posts->links() }}
            </div>
        </div>
    </main>
</x-layouts.app>
