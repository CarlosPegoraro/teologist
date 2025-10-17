<section class="py-20 md:py-28 bg-background/50">
    <div class="container mx-auto px-6">
        <div
            class="text-center mb-16 animate-fade-in-up"
            data-anim-delay="0"
        >
            <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4 text-foreground">
                Três Formas de <span class="text-primary">Aprender</span> e <span class="text-accent">Participar</span>
            </h2>
            <p class="text-muted-foreground text-lg max-w-2xl mx-auto">
                Nossa plataforma oferece diferentes maneiras de se engajar com o conhecimento.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <x-card
                :icon="'book-open'"
                :title="'Blog'"
                :route="'blogs.index'"
                :linkMessage="'Ler artigos'"
                :color="'primary'"
                class="animate-fade-in-up"
                style="animation-delay: 200ms;"
            >
                Artigos cuidadosamente escritos para tornar ideias profundas compreensíveis para todos, sem perder a riqueza do conteúdo.
            </x-card>

            <x-card
                :icon="'message-square'"
                :title="'Fórum'"
                :route="'posts.index'"
                :linkMessage="'Participar'"
                :color="'accent'"
                class="animate-fade-in-up"
                style="animation-delay: 350ms;"
            >
                Proponha temas, compartilhe perspectivas e participe de discussões construtivas com outros interessados.
            </x-card>

            <x-card
                :icon="'newspaper'"
                :title="'Notícias'"
                :route="'posts.index'"
                :linkMessage="'Ver notícias'"
                :color="'secondary'"
                class="animate-fade-in-up md:col-span-2 lg:col-span-1"
                style="animation-delay: 500ms;"
            >
                Fique por dentro das principais notícias e desenvolvimentos nas áreas de teologia, política, economia e sociologia.
            </x-card>
        </div>
    </div>
</section>
