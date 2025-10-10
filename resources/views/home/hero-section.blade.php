<section
    class="relative bg-gradient-to-br from-[#2c3e50] via-[#34495e] to-[#2c3e50] text-white py-24 md:py-32 overflow-hidden">

    {{-- decorative elements --}}
    <div class="absolute top-20 right-10 w-72 h-72 border-4 border-primary/60 rounded-full"></div>
    <div class="absolute top-32 right-24 w-48 h-48 border-4 border-accent/60 rounded-full"></div>
    <div
        class="absolute top-1/2 right-0 w-96 h-96 bg-gradient-to-l from-accent/10 to-transparent rounded-full blur-3xl"></div>
    <div class="absolute top-40 left-20 w-16 h-16 border-2 border-primary/30 rotate-45 border-primary"></div>
    <div class="absolute bottom-40 right-32 w-12 h-12 border-2 border-accent/30 rotate-12 border-accent"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col lg:flex-row items-center gap-12">

                {{-- Main copy --}}
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-emerald-700/30 backdrop-blur-sm text-primary px-6 py-3 rounded-full mb-8 border-2 border-primary shadow-lg shadow-primary/20">
                        <x-lucide-sparkles class="h-4 w-4 text-emerald-300"/>
                        <span class="text-sm font-bold tracking-wide text-emerald-300">ACADEMIA DE ESTUDOS SOCIAIS</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold font-serif mb-6 leading-tight">
                        Simplificando Ideias,
                        <span class="relative inline-block">
                                <span class="relative z-10 text-emerald-400">Criando Pensadores</span>
                                <span class="absolute bottom-2 left-10 right-0 h-2 bg-emerald-400/40 -rotate-1"></span>
                            </span>
                    </h1>

                    <p class="text-lg md:text-xl text-white/90 mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Explore ideias profundas sobre teologia, política, economia e sociologia de forma clara,
                        dinâmica e acessível.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('blog.index') }}"
                           class="inline-flex items-center justify-center bg-primary hover:bg-primary/90 text-white font-semibold px-8 h-14 rounded-md shadow-xl shadow-primary/30">
                            Explorar Blog
                            <x-lucide-arrow-right class="ml-2 h-5 w-5"/>
                        </a>
                        <a href="{{ route('forum.index') }}"
                           class="inline-flex items-center justify-center border-2 border-accent text-accent hover:bg-accent hover:text-yellow-200 bg-white/5 backdrop-blur-sm font-semibold px-8 h-14 rounded-md shadow-xl">
                            Participar do Fórum
                        </a>
                    </div>
                </div>

                {{-- Phi visual --}}
                <div class="hidden lg:block relative w-80 h-80">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="relative">
                            <div
                                class="absolute inset-0 w-80 h-80 border-4 border-primary/60 rounded-full animate-pulse"></div>
                            <div
                                class="absolute inset-8 w-64 h-64 border-4 border-accent/60 rounded-full animate-pulse"
                                style="animation-delay:.5s"></div>
                            <div class="relative w-80 h-80 flex items-center justify-center">
                                <svg viewBox="0 0 100 100" class="w-40 h-40">
                                    <defs>
                                        <linearGradient id="phiGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" stop-color="#1ABC9C"/>
                                            <stop offset="100%" stop-color="#F1C40F"/>
                                        </linearGradient>
                                    </defs>
                                    <text x="50" y="75" font-size="80" font-family="serif" font-weight="bold"
                                          fill="url(#phiGradient)" text-anchor="middle">Φ
                                    </text>
                                </svg>
                            </div>
                            <div
                                class="absolute top-0 left-1/2 w-3 h-3 bg-primary rounded-full -translate-x-1/2"></div>
                            <div
                                class="absolute bottom-0 left-1/2 w-3 h-3 bg-accent rounded-full -translate-x-1/2"></div>
                            <div
                                class="absolute left-0 top-1/2 w-3 h-3 bg-primary rounded-full -translate-y-1/2"></div>
                            <div
                                class="absolute right-0 top-1/2 w-3 h-3 bg-accent rounded-full -translate-y-1/2"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- bottom wave --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path
                d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                fill="hsl(var(--background))"/>
        </svg>
    </div>
</section>
