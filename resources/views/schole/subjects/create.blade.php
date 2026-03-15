<x-layouts.app :title="'Nova matéria - Scholē'">
    <section class="bg-background/70 py-24 md:py-32">
        <div class="container mx-auto px-6">
            <form action="{{ route('schole.subjects.store') }}" method="POST" class="mx-auto max-w-4xl">
                @csrf

                <div class="mb-10">
                    <p class="text-sm uppercase tracking-[0.2em] text-primary">Scholē</p>
                    <h1 class="mt-3 text-3xl font-bold font-serif text-foreground md:text-4xl">Cadastrar nova matéria</h1>
                    <p class="mt-3 text-muted-foreground">
                        Defina o nome da matéria, o curso relacionado e a grande área do conhecimento para facilitar a organização da comunidade.
                    </p>
                </div>

                <div class="space-y-6 rounded-2xl border border-border bg-card/50 p-8 backdrop-blur-sm">
                    <div>
                        <label for="name" class="block text-sm font-medium text-foreground">Nome da matéria</label>
                        <input id="name" name="name" type="text" value="{{ old('name') }}" required class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                        @error('name') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="related_course" class="block text-sm font-medium text-foreground">Curso relacionado</label>
                            <input id="related_course" name="related_course" type="text" value="{{ old('related_course') }}" placeholder="Ex.: Administração, Engenharia Civil" required class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                            @error('related_course') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="science_field" class="block text-sm font-medium text-foreground">Guarda-chuva da ciência</label>
                            <input id="science_field" name="science_field" type="text" value="{{ old('science_field') }}" placeholder="Ex.: Engenharia, Ciências Humanas, CSA" required class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                            @error('science_field') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-foreground">Descrição breve</label>
                        <textarea id="description" name="description" rows="5" placeholder="Explique em poucas linhas o escopo da matéria." class="mt-2 block w-full rounded-lg border border-border bg-background/60 px-4 py-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">{{ old('description') }}</textarea>
                        @error('description') <p class="mt-2 text-sm text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-end gap-4">
                    <a href="{{ route('schole.index') }}" class="text-sm font-semibold text-muted-foreground hover:text-foreground">Cancelar</a>
                    <button type="submit" class="inline-flex h-11 items-center justify-center rounded-lg bg-primary px-6 font-semibold text-foreground shadow-lg shadow-teal-500/20 hover:bg-teal-600">
                        Criar matéria
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
