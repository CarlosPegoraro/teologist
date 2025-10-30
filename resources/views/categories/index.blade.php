<x-layouts.app :title="'Categorias'">
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6 max-w-6xl">
            {{-- Header + Ações --}}
            <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">Categorias</h1>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Gerencie as categorias utilizadas em blogs e posts.
                    </p>
                </div>

                <a href="{{ route('admin.categories.create') }}"
                   class="inline-flex items-center justify-center h-10 px-4 rounded-lg bg-primary hover:bg-teal-600 text-foreground font-semibold shadow-lg shadow-teal-500/20">
                    Nova Categoria
                </a>
            </div>

            {{-- Filtros / Busca --}}
            <form method="GET" action="{{ route('admin.categories.index') }}" class="mb-6">
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label class="block text-sm font-medium text-foreground mb-1">Buscar</label>
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Nome ou slug…"
                            class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                        >
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-foreground mb-1">Ordenar por</label>
                        <select
                            name="sort"
                            class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                        >
                            @php $sort = request('sort','recent'); @endphp
                            <option value="recent" @selected($sort==='recent')>Mais recentes</option>
                            <option value="name_asc" @selected($sort==='name_asc')>Nome (A→Z)</option>
                            <option value="name_desc" @selected($sort==='name_desc')>Nome (Z→A)</option>
                            <option value="blogs_desc" @selected($sort==='blogs_desc')>Mais blogs vinculados</option>
                        </select>
                    </div>

                    <div class="sm:col-span-1 flex items-end">
                        <button type="submit"
                                class="inline-flex w-full items-center justify-center h-10 px-4 rounded-lg border border-border bg-card/60 hover:bg-card text-foreground">
                            Filtrar
                        </button>
                    </div>
                </div>
            </form>

            {{-- Tabela --}}
            <div class="overflow-hidden rounded-xl border border-border bg-card/50 backdrop-blur-sm">
                <table class="min-w-full divide-y divide-border">
                    <thead>
                    <tr class="text-left text-sm text-muted-foreground">
                        <th class="px-4 py-3 font-medium">Nome</th>
                        <th class="px-4 py-3 font-medium hidden md:table-cell">Slug</th>
                        <th class="px-4 py-3 font-medium">Cor</th>
                        <th class="px-4 py-3 font-medium hidden sm:table-cell">Blogs</th>
                        <th class="px-4 py-3 font-medium hidden lg:table-cell">Criada em</th>
                        <th class="px-4 py-3 font-medium text-right">Ações</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-4 py-3">
                                <a href="{{ route('categories.show', $category) }}"
                                   class="font-medium text-foreground hover:underline">
                                    {{ $category->name }}
                                </a>
                            </td>

                            <td class="px-4 py-3 hidden md:table-cell">
                                <code class="text-xs px-2 py-1 rounded bg-muted/50 border border-border">
                                    {{ $category->slug }}
                                </code>
                            </td>

                            <td class="px-4 py-3">
                                @php $hex = $category->color ?: '#14b8a6'; @endphp
                                <div class="inline-flex items-center gap-2">
                                    <span class="h-5 w-5 rounded border border-border" style="background: {{ $hex }}"></span>
                                    <code class="text-xs">{{ $hex }}</code>
                                </div>
                            </td>

                            <td class="px-4 py-3 hidden sm:table-cell">
                                <span class="inline-flex items-center rounded-full border border-border px-2 py-0.5 text-xs">
                                    {{ $category->blogs_count ?? $category->blogs->count() }}
                                </span>
                            </td>

                            <td class="px-4 py-3 hidden lg:table-cell text-sm text-muted-foreground">
                                {{ $category->created_at?->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}"
                                       class="inline-flex items-center justify-center h-9 px-3 rounded-md border border-border bg-card/60 hover:bg-card text-foreground text-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                          onsubmit="return confirm('Excluir a categoria \"{{ $category->name }}\"? Esta ação não pode ser desfeita.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center h-9 px-3 rounded-md bg-destructive/90 hover:bg-destructive text-destructive-foreground text-sm">
                                        Excluir
                                    </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-muted-foreground">
                                Nenhuma categoria encontrada.
                                <a href="{{ route('admin.categories.create') }}" class="underline hover:no-underline">Criar a primeira</a>.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginação --}}
            <div class="mt-6">
                {{ $categories->appends(request()->query())->links() }}
            </div>
        </div>
    </section>
</x-layouts.app>
