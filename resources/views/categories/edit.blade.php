<x-layouts.app :title="'Editar Categoria: ' . ($category->name ?? '')">
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Page Header --}}
                <div class="max-w-4xl mx-auto mb-12">
                    <nav class="text-sm text-muted-foreground mb-2">
                        <a href="{{ route('admin.categories.index') }}" class="hover:text-foreground">Categorias</a>
                        <span class="mx-2">/</span>
                        <a href="{{ route('categories.show', $category) }}" class="hover:text-foreground">{{ $category->name }}</a>
                        <span class="mx-2">/</span>
                        <span class="text-foreground">Editar</span>
                    </nav>

                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">
                        Editar Categoria
                    </h1>
                    <p class="mt-2 text-lg text-muted-foreground">
                        Atualize as informações e salve para aplicar as alterações.
                    </p>
                </div>

                {{-- Form Fields --}}
                <div class="max-w-4xl mx-auto bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border">
                    @include('categories._form', ['submitText' => 'Salvar Alterações'])
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
