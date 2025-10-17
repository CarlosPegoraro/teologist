<x-layouts.app :title="'Adicionar Novo Colaborador'">
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6">
            <form action="{{ route('authors.store') }}" method="POST">
                {{-- Page Header --}}
                <div class="max-w-4xl mx-auto mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">Adicionar Novo Colaborador</h1>
                    <p class="mt-2 text-lg text-muted-foreground">Preencha os dados abaixo para cadastrar um novo autor na plataforma.</p>
                </div>

                {{-- Form Fields --}}
                <div class="max-w-4xl mx-auto bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border">
                    @include('authors._form', ['submitText' => 'Cadastrar Colaborador'])
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
