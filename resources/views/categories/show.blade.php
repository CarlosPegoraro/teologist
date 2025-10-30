<x-layouts.app :title="$category->name">
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            {{-- Header + Ações --}}
            <div class="max-w-5xl mx-auto mb-8 flex items-start justify-between gap-4">
                <div>
                    <nav class="text-sm text-muted-foreground mb-2">
                        <a href="{{ route('admin.categories.index') }}" class="hover:text-foreground">Categorias</a>
                        <span class="mx-2">/</span>
                        <span class="text-foreground">{{ $category->name }}</span>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">
                        {{ $category->name }}
                    </h1>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Criada em {{ $category->created_at?->format('d/m/Y H:i') }} • Atualizada em {{ $category->updated_at?->format('d/m/Y H:i') }}
                    </p>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.categories.edit', $category) }}"
                       class="inline-flex items-center justify-center h-10 px-4 rounded-lg border border-border bg-card/60 hover:bg-card text-foreground">
                        Editar
                    </a>

                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                          onsubmit="return confirm('Tem certeza que deseja excluir esta categoria? Esta ação não pode ser desfeita.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center justify-center h-10 px-4 rounded-lg bg-destructive/90 hover:bg-destructive text-destructive-foreground">
                            Excluir
                        </button>
                    </form>
                </div>
            </div>

            {{-- Card de Detalhes --}}
            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2 bg-card/50 backdrop-blur-sm p-6 rounded-xl border border-border">
                    <h2 class="text-lg font-semibold text-foreground">Detalhes</h2>
                    <dl class="mt-6 divide-y divide-border">
                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-muted-foreground">Nome</dt>
                            <dd class="text-sm text-foreground col-span-2">{{ $category->name }}</dd>
                        </div>

                        <div class="py-4 grid grid-cols-3 gap-4 items-center">
                            <dt class="text-sm font-medium text-muted-foreground">Slug</dt>
                            <dd class="text-sm text-foreground col-span-2 flex items-center gap-2">
                                <code class="px-2 py-1 rounded bg-muted/50 border border-border">{{ $category->slug }}</code>
                                <button x-data @click="navigator.clipboard.writeText('{{ $category->slug }}')"
                                        type="button"
                                        class="text-xs px-2 h-7 rounded-md border border-border hover:bg-card">
                                    Copiar
                                </button>
                            </dd>
                        </div>

                        <div class="py-4 grid grid-cols-3 gap-4">
                            <dt class="text-sm font-medium text-muted-foreground">Descrição</dt>
                            <dd class="text-sm text-foreground col-span-2">
                                {{ $category->description ?: '—' }}
                            </dd>
                        </div>

                        <div class="py-4 grid grid-cols-3 gap-4 items-center">
                            <dt class="text-sm font-medium text-muted-foreground">Cor</dt>
                            <dd class="col-span-2 flex items-center gap-3">
                                @php $hex = $category->color ?: '#14b8a6'; @endphp
                                <span class="inline-block h-8 w-8 rounded-lg border border-border"
                                      style="background: {{ $hex }}"></span>
                                <code class="text-sm px-2 py-1 rounded bg-muted/50 border border-border">{{ $hex }}</code>
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Resumo --}}
                <div class="bg-card/50 backdrop-blur-sm p-6 rounded-xl border border-border">
                    <h3 class="text-lg font-semibold text-foreground">Resumo</h3>
                    <div class="mt-4 space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground">Blogs vinculados</span>
                            <span class="font-medium text-foreground">{{ $category->blogs->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-muted-foreground">ID</span>
                            <span class="font-mono">{{ $category->id }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Relações: Blogs --}}
            <div class="max-w-5xl mx-auto mt-10">
                <div class="bg-card/50 backdrop-blur-sm p-6 rounded-xl border border-border">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-foreground">
                            Blogs desta categoria
                        </h2>
                        <a href="{{ route('blogs.index') }}" class="text-sm text-teal-500 hover:underline">
                            Ver todos os blogs
                        </a>
                    </div>

                    @if($category->blogs->isEmpty())
                        <p class="mt-4 text-sm text-muted-foreground">Nenhum blog vinculado a esta categoria.</p>
                    @else
                        <ul class="mt-4 divide-y divide-border">
                            @foreach ($category->blogs as $blog)
                                <li class="py-3 flex items-center justify-between">
                                    <div>
                                        <a href="{{ route('blogs.show', $blog) }}"
                                           class="font-medium hover:underline text-foreground">
                                            {{ $blog->title ?? ('Blog #'.$blog->id) }}
                                        </a>
                                        @if(!empty($blog->excerpt))
                                            <p class="text-sm text-muted-foreground line-clamp-1">
                                                {{ $blog->excerpt }}
                                            </p>
                                        @endif
                                    </div>
                                    <span class="text-xs text-muted-foreground">
                                        {{ $blog->created_at?->format('d/m/Y') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Voltar --}}
            <div class="max-w-5xl mx-auto mt-8">
                <a href="{{ route('admin.categories.index') }}"
                   class="inline-flex items-center justify-center h-10 px-4 rounded-lg border border-border bg-card/60 hover:bg-card text-foreground">
                    Voltar para a listagem
                </a>
            </div>
        </div>
    </section>
</x-layouts.app>
