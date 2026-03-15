<section class="relative bg-background text-foreground py-32 md:py-40 overflow-hidden">
    {{-- Background Effects --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-muted/30 via-background to-background animate-gradient-xy"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_80%,hsl(var(--primary)/0.1),_transparent_40%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_30%,hsl(var(--accent)/0.1),_transparent_40%)]"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl mx-auto text-center">

            <div
                class="inline-block animate-fade-in-down mb-6"
                style="animation-delay: 100ms;"
            >
                <span class="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full border border-primary/20 text-sm font-medium tracking-wide">
                    <x-lucide-sparkles class="h-4 w-4"/>
                    ACADEMIA DE ESTUDOS SOCIAIS
                </span>
            </div>

            <h1
                class="text-4xl md:text-6xl font-bold font-serif mb-6 leading-tight animate-fade-in-down"
                style="animation-delay: 200ms;"
            >
                Simplificando Ideias, <span class="text-primary">Criando Pensadores</span>
            </h1>

            <p
                class="text-lg md:text-xl text-muted-foreground mb-10 leading-relaxed max-w-3xl mx-auto animate-fade-in-up"
                style="animation-delay: 300ms;"
            >
                Explore ideias profundas sobre teologia, política, economia e sociologia de forma clara, dinâmica e acessível.
            </p>

            <div
                class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up"
                style="animation-delay: 400ms;"
            >
                <a
                    href="{{ route('blogs.index') }}"
                    class="group inline-flex items-center justify-center bg-primary/60 hover:bg-primary/70 text-primary-foreground hover:text-emerald-100 font-semibold px-8 h-12 rounded-lg shadow-lg shadow-primary/20 transition-all duration-300 transform hover:-translate-y-1"
                >
                    Explorar Blog
                    <x-lucide-arrow-right class="ml-2 h-5 w-5 transform transition-transform duration-300 group-hover:translate-x-1"/>
                </a>
                <a
                    href="{{ route('posts.index') }}"
                    class="group inline-flex items-center justify-center border-2 border-accent hover:border-accent hover:bg-accent/10 text-accent hover:text-accent-foreground font-semibold px-8 h-12 rounded-lg transition-all duration-300 transform hover:-translate-y-1"
                >
                    Participar do Fórum
                    <x-lucide-users class="ml-2 h-5 w-5 transform transition-transform duration-300 group-hover:scale-110"/>
                </a>
            </div>

        </div>
    </div>
</section>
