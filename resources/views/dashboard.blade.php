<x-layouts.app :title="'Painel Administrativo – Phrónesis'">
    <section class="relative bg-background text-foreground py-20 md:py-24 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute inset-0 bg-gradient-to-br from-amber-50 via-background to-stone-100 dark:from-gray-800 dark:via-gray-900 dark:to-black animate-gradient-xy"></div>
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,_rgba(30,200,150,0.12),_transparent_40%)] dark:bg-[radial-gradient(circle_at_20%_20%,_rgba(30,200,150,0.1),_transparent_40%)]"></div>
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_80%_70%,_rgba(241,196,15,0.14),_transparent_40%)] dark:bg-[radial-gradient(circle_at_80%_70%,_rgba(241,196,15,0.1),_transparent_40%)]"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold font-serif mb-2 animate-fade-in-down">Painel Administrativo</h1>
            <p class="text-lg text-muted-foreground animate-fade-in-up" style="animation-delay: 100ms;">
                Olá, {{ Auth::user()->name }}. Bem-vindo de volta!
            </p>
        </div>
    </section>

    <main class="py-16 bg-background/70">
        <div class="container mx-auto px-6">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                {{-- Total Blogs --}}
                <div class="bg-card/50 backdrop-blur-sm rounded-xl p-6 flex items-center gap-6 border border-border/50">
                    <div class="p-3 rounded-full bg-primary/10">
                        <x-lucide-newspaper class="w-8 h-8 text-primary"/>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-foreground">{{ $stats['blogs'] }}</p>
                        <p class="text-sm text-muted-foreground">Artigos Publicados</p>
                    </div>
                </div>
                {{-- Total Authors --}}
                <div class="bg-card/50 backdrop-blur-sm rounded-xl p-6 flex items-center gap-6 border border-border/50">
                    <div class="p-3 rounded-full bg-yellow-500/10">
                        <x-lucide-users class="w-8 h-8 text-accent"/>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-foreground">{{ $stats['authors'] }}</p>
                        <p class="text-sm text-muted-foreground">Colaboradores</p>
                    </div>
                </div>
                {{-- Total Forum Posts --}}
                <div class="bg-card/50 backdrop-blur-sm rounded-xl p-6 flex items-center gap-6 border border-border/50">
                    <div class="p-3 rounded-full bg-indigo-500/10">
                        <x-lucide-message-square class="w-8 h-8 text-indigo-400"/>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-foreground">{{ $stats['posts'] }}</p>
                        <p class="text-sm text-muted-foreground">Posts no Fórum</p>
                    </div>
                </div>
                {{-- Total Categories --}}
                <div class="bg-card/50 backdrop-blur-sm rounded-xl p-6 flex items-center gap-6 border border-border/50">
                    <div class="p-3 rounded-full bg-pink-500/10">
                        <x-lucide-tag class="w-8 h-8 text-pink-400"/>
                    </div>
                    <div>
                        <p class="text-4xl font-bold text-foreground">{{ $stats['categories'] }}</p>
                        <p class="text-sm text-muted-foreground">Categorias</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions & Recent Activity --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Quick Actions --}}
                <div class="lg:col-span-1 bg-card/50 backdrop-blur-sm rounded-xl p-6 border border-border/50 h-fit">
                    <h2 class="text-xl font-bold text-foreground mb-4">Ações Rápidas</h2>
                    <div class="space-y-3">
                        <a href="{{ route('admin.blogs.create') }}"
                           class="w-full text-center block bg-card hover:bg-card/80 text-foreground font-semibold py-3 px-4 rounded-lg transition-colors">Novo
                            Artigo</a>
                        @hasrole('admin')
                        <a href="{{ route('admin.authors.create') }}"
                           class="w-full text-center block bg-card hover:bg-card/80 text-foreground font-semibold py-3 px-4 rounded-lg transition-colors">Novo
                            Colaborador</a>
                        <a href="{{ route('admin.categories.create') }}"
                           class="w-full text-center block bg-card hover:bg-card/80 text-foreground font-semibold py-3 px-4 rounded-lg transition-colors">Nova
                            Categoria</a>
                        <a href="{{ route('admin.users.index') }}"
                           class="w-full text-center block bg-yellow-600/20 hover:bg-yellow-600/30 text-yellow-300 font-semibold py-3 px-4 rounded-lg transition-colors border border-yellow-600/30">Gerenciar
                            Usuários</a>
                        @endhasrole
                    </div>
                </div>

                {{-- Recent Activity --}}
                <div class="lg:col-span-2 bg-card/50 backdrop-blur-sm rounded-xl p-6 border border-border/50">
                    <h2 class="text-xl font-bold text-foreground mb-4">Atividade Recente</h2>
                    <ul class="space-y-4">
                        @forelse($recentBlogs as $blog)
                            <li class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <img
                                        src="{{ $blog->author->photo_url ?? 'https://ui-avatars.com/api/?name='.urlencode($blog->author->name).'&size=40&background=1f2937&color=9ca3af' }}"
                                        alt="Foto de {{ $blog->author->name }}" class="w-10 h-10 rounded-full">
                                    <div>
                                        <a href="{{ route('blogs.show', $blog) }}"
                                           class="font-semibold text-foreground hover:text-primary transition-colors">{{ $blog->title }}</a>
                                        <p class="text-sm text-muted-foreground">por {{ $blog->author->name }}</p>
                                    </div>
                                </div>
                                <span
                                    class="text-sm text-muted-foreground flex-shrink-0 ml-4">{{ $blog->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li class="text-center py-8 text-muted-foreground">
                                <p>Nenhuma atividade recente para mostrar.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>
