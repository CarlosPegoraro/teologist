<x-layouts.app :title="'Scholē'">
    <section class="relative overflow-hidden bg-background pt-24 md:pt-32 pb-16 md:pb-20">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/10 via-background to-accent/10"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,hsl(var(--primary)/0.12),transparent_35%)]"></div>
        </div>

        <div class="container relative z-10 mx-auto px-6">
            <div class="mx-auto max-w-4xl text-center">
                <span class="inline-flex items-center rounded-full border border-border bg-card/60 px-4 py-1 text-sm text-muted-foreground">
                    Comunidade de estudos
                </span>
                <h1 class="mt-6 text-4xl font-bold font-serif text-foreground md:text-5xl">Scholē</h1>
                <p class="mt-4 text-lg text-muted-foreground">
                    Pesquise matérias, descubra materiais enviados pela comunidade e organize estudos por curso e grande área do conhecimento.
                </p>
            </div>

            <div class="mx-auto mt-10 max-w-5xl rounded-2xl border border-border bg-card/60 p-6 backdrop-blur-sm">
                <form method="GET" action="{{ route('schole.index') }}" class="grid gap-4 md:grid-cols-[1fr_auto]">
                    <div>
                        <label for="q" class="mb-2 block text-sm font-medium text-foreground">Buscar matéria</label>
                        <input
                            id="q"
                            name="q"
                            type="text"
                            value="{{ $search }}"
                            placeholder="Ex.: Fundamentos de Microeconomia, Estatística..."
                            class="block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                        >
                    </div>

                    <div class="flex items-end gap-3">
                        <button type="submit" class="inline-flex h-12 items-center justify-center rounded-lg border border-border bg-background/60 px-5 font-semibold text-foreground hover:bg-card">
                            Pesquisar
                        </button>
                        @auth
                            <a href="{{ route('schole.subjects.create') }}" class="inline-flex h-12 items-center justify-center rounded-lg bg-primary px-5 font-semibold text-foreground shadow-lg shadow-teal-500/20 hover:bg-teal-600">
                                Nova matéria
                            </a>
                        @endauth
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="bg-background/70 py-16 md:py-20">
        <div class="container mx-auto px-6">
            <div class="mb-8 flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-foreground">Matérias da comunidade</h2>
                    <p class="mt-2 text-sm text-muted-foreground">
                        {{ $subjects->total() }} matéria(s) encontrada(s){{ $search !== '' ? ' para a busca atual.' : '.' }}
                    </p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse($subjects as $subject)
                    <article class="rounded-2xl border border-border bg-card/50 p-6 backdrop-blur-sm transition hover:-translate-y-1 hover:bg-card/70">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.2em] text-primary">{{ $subject->science_field }}</p>
                                <h3 class="mt-3 text-xl font-semibold text-foreground">
                                    <a href="{{ route('schole.show', $subject) }}" class="hover:text-primary">
                                        {{ $subject->name }}
                                    </a>
                                </h3>
                            </div>
                            <span class="inline-flex rounded-full border border-border px-3 py-1 text-xs text-muted-foreground">
                                {{ $subject->materials_count }} material(is)
                            </span>
                        </div>

                        <p class="mt-4 text-sm text-muted-foreground">
                            Curso relacionado: <span class="font-medium text-foreground">{{ $subject->related_course }}</span>
                        </p>

                        @if($subject->description)
                            <p class="mt-4 line-clamp-3 text-sm text-muted-foreground">{{ $subject->description }}</p>
                        @endif

                        <div class="mt-6 flex items-center justify-between text-sm">
                            <span class="text-muted-foreground">Criada por {{ $subject->user->name ?? 'Comunidade' }}</span>
                            <a href="{{ route('schole.show', $subject) }}" class="font-semibold text-primary hover:underline">
                                Acessar
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-2 xl:col-span-3 rounded-2xl border border-dashed border-border bg-card/30 p-10 text-center">
                        <h3 class="text-xl font-semibold text-foreground">Nenhuma matéria encontrada</h3>
                        <p class="mt-3 text-muted-foreground">
                            Ajuste a busca ou crie a primeira matéria dessa comunidade de estudos.
                        </p>
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $subjects->links() }}
            </div>
        </div>
    </section>
</x-layouts.app>
