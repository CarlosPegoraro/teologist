@php
    // Dados de exemplo. No futuro, você buscará isso do seu banco de dados.
    $featuredPosts = [
        [
            'image' => 'https://images.unsplash.com/photo-1515524738708-327f6b0037a7?q=80&w=1974&auto=format&fit=crop',
            'category' => 'Teologia',
            'title' => 'A Natureza do Bem e do Mal nas Tradições Abraâmicas',
            'excerpt' => 'Uma análise comparativa sobre como o judaísmo, o cristianismo e o islamismo abordam a dualidade fundamental da moralidade humana.',
            'color' => 'primary',
            'url' => '#',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1523289318362-d0c242582848?q=80&w=2070&auto=format&fit=crop',
            'category' => 'Política',
            'title' => 'Democracia Direta vs. Representativa: Qual o Futuro?',
            'excerpt' => 'Explorando os prós e contras de cada sistema e o impacto da tecnologia na participação cidadã.',
            'color' => 'accent',
            'url' => '#',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1612178991541-b48cc8e92a1d?q=80&w=2070&auto=format&fit=crop',
            'category' => 'Economia',
            'title' => 'O Impacto da Renda Básica Universal na Sociedade',
            'excerpt' => 'Debatendo os efeitos potenciais de uma das propostas econômicas mais discutidas da atualidade.',
            'color' => 'secondary',
            'url' => '#',
        ],
    ];

    $colorMap = [
        'primary' => ['bg' => 'bg-teal-500', 'text' => 'text-teal-300'],
        'accent' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-300'],
        'secondary' => ['bg' => 'bg-indigo-500', 'text' => 'text-indigo-300'],
    ];
@endphp

<section class="py-20 md:py-28 bg-gray-900/50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16 animate-fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4 text-white">Artigos em Destaque</h2>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto">Mergulhe em nossas análises mais recentes sobre temas complexos.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($featuredPosts as $post)
                @php $colors = $colorMap[$post['color']]; @endphp
                <div class="group animate-fade-in-up" style="animation-delay: {{ $loop->index * 150 }}ms;">
                    <a href="{{ $post['url'] }}" class="block bg-gray-800/60 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative">
                            <img src="{{ $post['image'] }}" alt="Imagem para o post {{ $post['title'] }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black/30"></div>
                            <span class="absolute top-4 left-4 px-3 py-1 rounded-full text-sm font-semibold text-white {{ $colors['bg'] }}">{{ $post['category'] }}</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold font-serif mb-3 text-white leading-snug">{{ $post['title'] }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">{{ $post['excerpt'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
