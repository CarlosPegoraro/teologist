<x-layouts.app :title="'Novo material - ' . $subject->name">
    <section class="bg-background/70 py-24 md:py-32">
        <div class="container mx-auto px-6">
            <form action="{{ route('schole.materials.store', $subject) }}" method="POST" enctype="multipart/form-data" class="mx-auto max-w-4xl">
                @csrf

                <div class="mb-10">
                    <p class="text-sm uppercase tracking-[0.2em] text-primary">Scholē / {{ $subject->name }}</p>
                    <h1 class="mt-3 text-3xl font-bold font-serif text-foreground md:text-4xl">Publicar novo material</h1>
                    <p class="mt-3 text-muted-foreground">
                        Todo post de material precisa de título e breve descrição. Você pode enviar um arquivo ou cadastrar um link externo.
                    </p>
                </div>

                <div class="space-y-6 rounded-2xl border border-border bg-card/50 p-8 backdrop-blur-sm">
                    <div>
                        <label for="title" class="block text-sm font-medium text-foreground">Título</label>
                        <input id="title" name="title" type="text" value="{{ old('title') }}" required class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                        @error('title') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-foreground">Breve descrição</label>
                        <textarea id="description" name="description" rows="5" required class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">{{ old('description') }}</textarea>
                        @error('description') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <span class="block text-sm font-medium text-foreground">Tipo do material</span>
                        <div class="mt-3 grid gap-4 md:grid-cols-2">
                            <label class="rounded-xl border border-border bg-background/50 p-4">
                                <input type="radio" name="type" value="upload" class="mr-2" {{ old('type', 'upload') === 'upload' ? 'checked' : '' }}>
                                <span class="font-semibold text-foreground">Arquivo</span>
                                <p class="mt-2 text-sm text-muted-foreground">Envie PDF, Word, Excel, PowerPoint, CSV, TXT e formatos semelhantes.</p>
                            </label>

                            <label class="rounded-xl border border-border bg-background/50 p-4">
                                <input type="radio" name="type" value="link" class="mr-2" {{ old('type') === 'link' ? 'checked' : '' }}>
                                <span class="font-semibold text-foreground">Link externo</span>
                                <p class="mt-2 text-sm text-muted-foreground">Cadastre uma referência hospedada fora da plataforma.</p>
                            </label>
                        </div>
                        @error('type') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="file" class="block text-sm font-medium text-foreground">Arquivo</label>
                            <input id="file" name="file" type="file" class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground">
                            <p class="mt-2 text-xs text-muted-foreground">Limite de 20 MB.</p>
                            @error('file') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="external_url" class="block text-sm font-medium text-foreground">Link externo</label>
                            <input id="external_url" name="external_url" type="url" value="{{ old('external_url') }}" placeholder="https://..." class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                            @error('external_url') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4">
                    <a href="{{ route('schole.show', $subject) }}" class="text-sm font-semibold text-muted-foreground hover:text-foreground">Cancelar</a>
                    <button type="submit" class="inline-flex h-11 items-center justify-center rounded-lg bg-primary px-6 font-semibold text-foreground shadow-lg shadow-teal-500/20 hover:bg-teal-600">
                        Publicar material
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
