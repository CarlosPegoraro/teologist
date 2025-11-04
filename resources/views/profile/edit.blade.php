<x-layouts.app :title="'Meu Perfil'">
    <section class="py-16 md:py-24 bg-background/70" x-data="{ showPass: false, showPassConf: false }">
        <div class="container mx-auto px-6 max-w-4xl">
            {{-- Header --}}
            <div class="mb-10">
                <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">Meu Perfil</h1>
                <p class="mt-2 text-sm text-muted-foreground">
                    Atualize suas informações de conta. A troca de senha é opcional.
                </p>
            </div>

            {{-- Alerts --}}
            @if (session('success'))
                <div
                    class="mb-6 rounded-lg border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="mb-6 rounded-lg border border-destructive/40 bg-destructive/10 p-4 text-sm text-destructive">
                    <p class="font-semibold mb-2">Corrija os erros abaixo:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" class="space-y-10">
                @csrf
                @method('PUT')

                {{-- Seção: Dados Pessoais --}}
                <div class="bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border">
                    <h2 class="text-xl font-semibold text-foreground">Dados Pessoais</h2>
                    <p class="mt-1 text-sm text-muted-foreground">Nome, e-mail e data de nascimento.</p>

                    <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-foreground">Nome</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                            >
                        </div>

                        <div class="sm:col-span-4">
                            <label for="email"
                                   class="block text-sm font-medium leading-6 text-foreground">E-mail</label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                            >
                            <p class="mt-2 text-xs text-muted-foreground">
                                @if($user->email_verified_at)
                                    Verificado em {{ $user->email_verified_at->format('d/m/Y H:i') }}
                                @else
                                    E-mail ainda não verificado.
                                @endif
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="birth_date" class="block text-sm font-medium leading-6 text-foreground">Data de
                                Nascimento</label>
                            <input
                                type="date"
                                id="birth_date"
                                name="birth_date"
                                value="{{ old('birth_date', $user->birth_date) }}"
                                class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                            >
                        </div>
                    </div>
                </div>

                {{-- Seção: Segurança (Senha) --}}
                <div class="bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border">
                    <h2 class="text-xl font-semibold text-foreground">Segurança</h2>
                    <p class="mt-1 text-sm text-muted-foreground">
                        Para trocar sua senha, preencha os campos abaixo. Deixe em branco para manter a senha atual.
                    </p>

                    <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm font-medium leading-6 text-foreground">Nova
                                senha</label>
                            <div class="mt-2 relative">
                                <input
                                    :type="showPass ? 'text' : 'password'"
                                    id="password"
                                    name="password"
                                    autocomplete="new-password"
                                    class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 pr-10 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                >
                                <button type="button" @click="showPass = !showPass"
                                        class="absolute inset-y-0 right-0 px-3 text-sm text-muted-foreground hover:text-foreground">
                                    <span x-show="!showPass">Mostrar</span>
                                    <span x-show="showPass">Ocultar</span>
                                </button>
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="password_confirmation"
                                   class="block text-sm font-medium leading-6 text-foreground">Confirmar nova
                                senha</label>
                            <div class="mt-2 relative">
                                <input
                                    :type="showPassConf ? 'text' : 'password'"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                    class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 pr-10 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                >
                                <button type="button" @click="showPassConf = !showPassConf"
                                        class="absolute inset-y-0 right-0 px-3 text-sm text-muted-foreground hover:text-foreground">
                                    <span x-show="!showPassConf">Mostrar</span>
                                    <span x-show="showPassConf">Ocultar</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Opcional: pedir senha atual se sua política exigir --}}
                    {{--
                    <div class="mt-6 sm:col-span-3">
                        <label for="current_password" class="block text-sm font-medium leading-6 text-foreground">Senha atual</label>
                        <input type="password" id="current_password" name="current_password"
                               class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                    </div>
                    --}}
                </div>

                @if(auth()->user()->roles()->first()?->name === 'author')
                    @php($author = auth()->user()->author)
                    <div class="bg-card/50 backdrop-blur-sm p-8 rounded-xl border border-border">
                        <h2 class="text-xl font-semibold text-foreground">Dados do Autor</h2>
                        <p class="mt-1 text-sm text-muted-foreground">Site, Instagram, Telefone, Sobre e Titulo.</p>

                        <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="site"
                                       class="block text-sm font-medium leading-6 text-foreground">Site</label>
                                <input
                                    type="text"
                                    id="site"
                                    name="site"
                                    value="{{ old('site', $author->site) }}"
                                    required
                                    class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                >
                            </div>

                            <div class="sm:col-span-4">
                                <label for="instagram"
                                       class="block text-sm font-medium leading-6 text-foreground">Instagram</label>
                                <input
                                    type="text"
                                    id="instagram"
                                    name="instagram"
                                    value="{{ old('instagram', $author->instagram) }}"
                                    required
                                    class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                >
                            </div>
                            <div class="sm:col-span-4">
                                <label for="phone"
                                       class="block text-sm font-medium leading-6 text-foreground">Telefone</label>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone', $author->phone) }}"
                                    required
                                    class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                >
                            </div>
                            <div class="sm:col-span-4">
                                <label for="title"
                                       class="block text-sm font-medium leading-6 text-foreground">Titulo</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    value="{{ old('title', $author->title) }}"
                                    required
                                    class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                >
                            </div>
                            <div class="sm:col-span-4">
                                <label for="about"
                                       class="block text-sm font-medium leading-6 text-foreground">Uma breve descrição sobre você</label>
                                <input
                                    type="text"
                                    id="about"
                                    name="about"
                                    value="{{ old('about', $author->about) }}"
                                    required
                                    class="mt-2 block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                >
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="flex items-center justify-between">
                    <a href="{{ url()->previous() }}"
                       class="text-sm font-medium text-muted-foreground hover:text-foreground">Cancelar</a>
                    <button type="submit"
                            class="inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-6 h-10 rounded-lg shadow-lg shadow-teal-500/20 transition-all duration-300">
                        Salvar alterações
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
