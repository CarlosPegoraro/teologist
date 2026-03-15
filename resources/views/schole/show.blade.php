<x-layouts.app :title="$subject->name . ' - Scholē'">
    <main class="bg-background/70 py-24 md:py-32">
        <div class="container mx-auto px-6">
            @if (session('success'))
                <div class="mx-auto mb-8 max-w-5xl rounded-lg border border-teal-500/20 bg-primary/10 p-4 text-teal-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mx-auto max-w-5xl">
                <div class="rounded-3xl border border-border bg-card/50 p-8 backdrop-blur-sm">
                    <div class="flex flex-col gap-6 md:flex-row md:items-start md:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.2em] text-primary">{{ $subject->science_field }}</p>
                            <h1 class="mt-3 text-3xl font-bold font-serif text-foreground md:text-4xl">{{ $subject->name }}</h1>
                            <p class="mt-4 text-muted-foreground">
                                Curso relacionado: <span class="font-semibold text-foreground">{{ $subject->related_course }}</span>
                            </p>
                            @if($subject->description)
                                <p class="mt-4 max-w-3xl text-muted-foreground">{{ $subject->description }}</p>
                            @endif
                        </div>

                        @auth
                            <a href="{{ route('schole.materials.create', $subject) }}" class="inline-flex h-11 items-center justify-center rounded-lg bg-primary px-5 font-semibold text-foreground shadow-lg shadow-teal-500/20 hover:bg-teal-600">
                                Publicar material
                            </a>
                        @endauth
                    </div>

                    <div class="mt-8 grid gap-4 border-t border-border pt-6 text-sm md:grid-cols-3">
                        <div>
                            <p class="text-muted-foreground">Criada por</p>
                            <p class="mt-1 font-semibold text-foreground">{{ $subject->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-muted-foreground">Materiais publicados</p>
                            <p class="mt-1 font-semibold text-foreground">{{ $subject->materials->count() }}</p>
                        </div>
                        <div>
                            <p class="text-muted-foreground">Atualizada em</p>
                            <p class="mt-1 font-semibold text-foreground">{{ $subject->updated_at?->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-foreground">Arquivos e referências da comunidade</h2>
                    </div>

                    <div class="space-y-5">
                        @forelse($subject->materials as $material)
                            <article class="rounded-2xl border border-border bg-card/50 p-6 backdrop-blur-sm">
                                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                    <div class="max-w-3xl">
                                        <div class="flex items-center gap-3">
                                            <span class="inline-flex rounded-full border border-border px-3 py-1 text-xs uppercase tracking-[0.2em] text-muted-foreground">
                                                {{ $material->type === 'upload' ? 'Arquivo' : 'Link' }}
                                            </span>
                                            @if($material->file_extension)
                                                <span class="text-xs text-primary">{{ strtoupper($material->file_extension) }}</span>
                                            @endif
                                        </div>
                                        <h3 class="mt-4 text-xl font-semibold text-foreground">{{ $material->title }}</h3>
                                        <p class="mt-3 text-sm leading-6 text-muted-foreground">{{ $material->description }}</p>
                                        <p class="mt-4 text-xs text-muted-foreground">
                                            Publicado por {{ $material->user->name }} em {{ $material->created_at?->format('d/m/Y H:i') }}
                                        </p>
                                    </div>

                                    <div class="flex min-w-44 flex-col gap-3">
                                        @if($material->type === 'link')
                                            <a href="{{ $material->external_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-11 items-center justify-center rounded-lg border border-border bg-background/60 px-4 font-semibold text-foreground hover:bg-card">
                                                Acessar link
                                            </a>
                                        @elseif($material->file_path)
                                            <a href="{{ route('schole.materials.download', $material) }}" class="inline-flex h-11 items-center justify-center rounded-lg border border-border bg-background/60 px-4 font-semibold text-foreground hover:bg-card">
                                                Baixar arquivo
                                            </a>
                                        @endif

                                        @if($material->file_size)
                                            <p class="text-xs text-muted-foreground">
                                                Tamanho:
                                                {{ number_format($material->file_size / 1024 / 1024, 2, ',', '.') }} MB
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @empty
                            <div class="rounded-2xl border border-dashed border-border bg-card/30 p-10 text-center">
                                <h3 class="text-xl font-semibold text-foreground">Nenhum material publicado ainda</h3>
                                <p class="mt-3 text-muted-foreground">
                                    Essa matéria já está pronta para receber PDFs, links, documentos Word, Excel, PowerPoint e outros arquivos.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.app>
