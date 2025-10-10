<section class="py-16 md:py-24 bg-gradient-to-b from-background to-muted/30">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4 font-reading">
                Três Formas de <span class="text-primary">Aprender</span> e <span
                    class="text-accent">Participar</span>
            </h2>
            <p class="text-muted-foreground text-lg max-w-2xl mx-auto">Nossa plataforma oferece diferentes maneiras
                de se engajar com o conhecimento</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <x-card :icon="'book-open'" :title="'Blog'"
                    :route="'blog.index'" :linkMessage="'Ler artigos'" :color="'primary'">
                Artigos cuidadosamente escritos
                para tornar ideias profundas compreensíveis para todos, sem perder a riqueza do
                conteúdo.
            </x-card>

            <x-card :icon="'message-square'" :title="'Fórum'"
                    :route="'forum.index'" :linkMessage="'Participar'" :color="'accent'">
                Proponha temas, compartilhe perspectivas e participe de discussões construtivas com outros interessados.
            </x-card>

            <x-card :icon="'newspaper'" :title="'Notícias'"
                    :route="'new.index'" :linkMessage="'Ver notícias'" :color="'secondary'">
                Fique por dentro das principais
                notícias e desenvolvimentos nas áreas de teologia, política, economia e sociologia.
            </x-card>

        </div>
    </div>
</section>
