@csrf
<div class="space-y-8">
    {{-- Section 1: Basic Info --}}
    <div class="border-b border-border pb-10">
        <h2 class="text-xl font-semibold leading-7 text-foreground">Informações Pessoais</h2>
        <p class="mt-1 text-sm leading-6 text-muted-foreground">Dados principais de identificação do colaborador.</p>

        <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-300">Nome completo</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" value="{{ old('name', $author->name ?? '') }}" required class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-300">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" value="{{ old('email', $author->email ?? '') }}" required class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                </div>
            </div>

            <div class="sm:col-span-6">
                <label for="title" class="block text-sm font-medium leading-6 text-gray-300">Título / Cargo</label>
                <div class="mt-2">
                    <input type="text" name="title" id="title" value="{{ old('title', $author->title ?? '') }}" placeholder="Ex: Teólogo, Cientista Político, Desenvolvedor" class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                </div>
            </div>

            <div class="col-span-full">
                <label for="about" class="block text-sm font-medium leading-6 text-gray-300">Sobre / Biografia</label>
                <div class="mt-2">
                    <textarea id="about" name="about" rows="3" class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">{{ old('about', $author->about ?? '') }}</textarea>
                </div>
                <p class="mt-3 text-sm leading-6 text-muted-foreground">Escreva uma breve biografia sobre o colaborador.</p>
            </div>
            <div class="col-span-full">
                <label for="photo_url" class="block text-sm font-medium leading-6 text-gray-300">URL da Foto</label>
                <div class="mt-2">
                    <input type="text" name="photo_url" id="photo_url" value="{{ old('photo_url', $author->photo_url ?? '') }}" class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                </div>
            </div>
        </div>
    </div>

    {{-- Section 2: Social & Contact --}}
    <div class="border-b border-border pb-12">
        <h2 class="text-xl font-semibold leading-7 text-foreground">Contato e Redes Sociais</h2>
        <p class="mt-1 text-sm leading-6 text-muted-foreground">Links e informações de contato (opcional).</p>

        <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="site" class="block text-sm font-medium leading-6 text-gray-300">Website</label>
                <div class="mt-2">
                    <input type="url" name="site" id="site" value="{{ old('site', $author->site ?? '') }}" placeholder="https://example.com" class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                </div>
            </div>

            <div class="sm:col-span-3">
                <label for="instagram" class="block text-sm font-medium leading-6 text-gray-300">Instagram</label>
                <div class="mt-2">
                    <div class="flex rounded-md bg-background/50 ring-1 ring-inset ring-gray-700 focus-within:ring-2 focus-within:ring-inset focus-within:ring-teal-500">
                        <span class="flex select-none items-center pl-3 text-muted-foreground sm:text-sm">@</span>
                        <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $author->instagram ?? '') }}" class="flex-1 border-0 bg-transparent py-2 pl-1 text-foreground placeholder:text-muted-foreground focus:ring-0 sm:text-sm" placeholder="usuario">
                    </div>
                </div>
            </div>
            <div class="sm:col-span-3">
                <label for="phone" class="block text-sm font-medium leading-6 text-gray-300">Telefone</label>
                <div class="mt-2">
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $author->phone ?? '') }}" class="block w-full bg-background/50 border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('authors.index') }}" class="text-sm font-semibold leading-6 text-gray-300 hover:text-foreground">Cancelar</a>
    <button type="submit" class="group inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-6 h-10 rounded-lg shadow-lg shadow-teal-500/20 transition-all duration-300">
        {{ $submitText ?? 'Salvar' }}
    </button>
</div>
