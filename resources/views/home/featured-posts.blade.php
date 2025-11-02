@php
    // Dados de exemplo. No futuro, você buscará isso do seu banco de dados.
    $featuredBlogs = \App\Models\Blog::latest('created_at')->limit(3)->get();

    $colorMap = [
        'primary' => ['bg' => 'bg-primary', 'text' => 'text-teal-300'],
        'accent' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-300'],
        'secondary' => ['bg' => 'bg-indigo-500', 'text' => 'text-indigo-300'],
    ];
@endphp

<section class="py-20 md:py-28 bg-background/50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4 text-foreground">Artigos em Destaque</h2>
            <p class="text-muted-foreground text-lg max-w-2xl mx-auto">Mergulhe em nossas análises mais recentes sobre temas complexos.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($featuredBlogs as $blog)
                <x-ui.blog-card :blog="$blog" :loop="$loop" />
            @endforeach
        </div>
    </div>
</section>
