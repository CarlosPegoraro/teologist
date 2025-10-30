<x-layouts.app :title="'Adicionar Nova Categoria'">
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                {{-- Page Header --}}
                <div class="max-w-4xl mx-auto mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">Adicionar Nova Categoria</h1>
                    <p class="mt-2 text-lg text-muted-foreground">
                        Defina as informações da categoria. O slug pode ser gerado automaticamente a partir do nome.
                    </p>
                </div>

                {{-- Form Fields --}}
                <div class="max-w-4xl mx-auto bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border">
                    @include('categories._form', ['submitText' => 'Cadastrar Categoria'])
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
