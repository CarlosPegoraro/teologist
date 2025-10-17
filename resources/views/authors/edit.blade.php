<x-layouts.app :title="'Editar Colaborador: ' . $author->name">
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            <form action="{{ route('authors.update', $author) }}" method="POST">
                @method('PUT')
                {{-- Page Header --}}
                <div class="max-w-4xl mx-auto mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">Editar Colaborador</h1>
                    <p class="mt-2 text-lg text-muted-foreground">Você está editando o perfil de <span class="font-bold text-primary">{{ $author->name }}</span>.</p>
                </div>

                {{-- Form Fields --}}
                <div class="max-w-4xl mx-auto bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border">
                    @include('authors._form', ['submitText' => 'Salvar Alterações'])
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
