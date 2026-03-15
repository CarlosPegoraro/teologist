<x-layouts.app :title="'Iniciar Nova Discussão'">
    <section class="py-24 md:py-32 bg-background/70">
        <div class="container mx-auto px-6">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="max-w-4xl mx-auto">
                    {{-- Page Header --}}
                    <div class="mb-12 text-center md:text-left">
                        <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">Iniciar Nova Discussão</h1>
                        <p class="mt-2 text-lg text-muted-foreground">Compartilhe sua ideia ou pergunta com a comunidade.</p>
                    </div>

                    {{-- Form Fields --}}
                    <div class="bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium leading-6 text-muted-foreground">Título da Discussão</label>
                            <div class="mt-2">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                       class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                            </div>
                            @error('title') <span class="text-red-400 text-sm mt-2">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium leading-6 text-muted-foreground">Sua Mensagem</label>
                            <div class="mt-2">
                                <textarea id="content" name="content" rows="8" required class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">{{ old('content') }}</textarea>
                            </div>
                            @error('content') <span class="text-red-400 text-sm mt-2">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-x-6">
                        <a href="{{ route('posts.index') }}" class="text-sm font-semibold leading-6 text-muted-foreground hover:text-foreground">Cancelar</a>
                        <button type="submit" class="group inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-6 h-10 rounded-lg shadow-lg shadow-teal-500/20 transition-all duration-300">
                            Publicar Discussão
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
