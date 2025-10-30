@csrf

{{-- Exibição de erros de validação --}}
@if ($errors->any())
    <div class="mb-6 rounded-lg border border-destructive/40 bg-destructive/10 p-4 text-sm text-destructive">
        <p class="font-semibold mb-2">Corrija os erros abaixo:</p>
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div x-data="categoryForm()" x-init="init()" class="space-y-8">
    {{-- Section 1: Informações da Categoria --}}
    <div class="border-b border-border pb-10">
        <h2 class="text-xl font-semibold leading-7 text-foreground">Informações da Categoria</h2>
        <p class="mt-1 text-sm leading-6 text-muted-foreground">
            Nome, slug e detalhes da categoria.
        </p>

        <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            {{-- Nome --}}
            <div class="sm:col-span-3">
                <label for="name" class="block text-sm font-medium leading-6 text-foreground">Nome</label>
                <div class="mt-2">
                    <input
                        type="text"
                        name="name"
                        id="name"
                        x-model="name"
                        x-on:input="maybeGenerateSlug()"
                        value="{{ old('name', $category->name ?? '') }}"
                        required
                        class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                    >
                </div>
            </div>

            {{-- Slug --}}
            <div class="sm:col-span-3">
                <label for="slug" class="block text-sm font-medium leading-6 text-foreground">Slug</label>
                <div class="mt-2">
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        x-model="slug"
                        value="{{ old('slug', $category->slug ?? '') }}"
                        placeholder="ex.: minha-categoria"
                        class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                    >
                    <p class="mt-2 text-xs text-muted-foreground">
                        O slug é usado nas URLs. Você pode editar manualmente se quiser.
                    </p>
                </div>
            </div>

            {{-- Descrição --}}
            <div class="sm:col-span-6">
                <label for="description" class="block text-sm font-medium leading-6 text-foreground">Descrição</label>
                <div class="mt-2">
                    <textarea
                        id="description"
                        name="description"
                        rows="3"
                        class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                    >{{ old('description', $category->description ?? '') }}</textarea>
                </div>
                <p class="mt-3 text-sm leading-6 text-muted-foreground">Breve descrição sobre a categoria.</p>
            </div>
        </div>
    </div>

    {{-- Section 2: Aparência --}}
    <div class="border-b border-border pb-12">
        <h2 class="text-xl font-semibold leading-7 text-foreground">Aparência</h2>
        <p class="mt-1 text-sm leading-6 text-muted-foreground">Escolha a cor de destaque da categoria.</p>

        <div class="mt-8 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 items-end">
            {{-- Picker de Cor --}}
            <div class="sm:col-span-2">
                <label for="color_picker" class="block text-sm font-medium leading-6 text-foreground">Cor</label>
                <div class="mt-2 flex items-center gap-3">
                    <input
                        id="color_picker"
                        type="color"
                        x-model="color"
                        x-on:input="syncHexFromPicker()"
                        class="h-10 w-14 rounded border border-border bg-background/50 p-1"
                    >
                    <div class="h-10 w-10 rounded-lg border border-border" :style="`background: ${color};`"></div>
                </div>
            </div>

            {{-- Hex da Cor --}}
            <div class="sm:col-span-4">
                <label for="color" class="block text-sm font-medium leading-6 text-foreground">Código Hex</label>
                <div class="mt-2">
                    <input
                        type="text"
                        name="color"
                        id="color"
                        x-model="color"
                        x-on:input="normalizeHex()"
                        value="{{ old('color', $category->color ?? '#14b8a6') }}"
                        placeholder="#14b8a6"
                        class="block w-full bg-background/50 border border-border rounded-md py-2 px-3 text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500"
                    >
                </div>
                <p class="mt-2 text-xs text-muted-foreground">Use um valor como <code>#14b8a6</code>.</p>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 flex items-center justify-end gap-x-6">
    <a href="{{ route('admin.categories.index') }}" class="text-sm font-semibold leading-6 text-muted-foreground hover:text-foreground">
        Cancelar
    </a>
    <button type="submit" class="group inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-6 h-10 rounded-lg shadow-lg shadow-teal-500/20 transition-all duration-300">
        {{ $submitText ?? 'Salvar' }}
    </button>
</div>

{{-- Alpine helpers --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('categoryForm', () => ({
            // valores iniciais vindos do old()/model
            name: @json(old('name', $category->name ?? '')),
            slug: @json(old('slug', $category->slug ?? '')),
            color: @json(old('color', $category->color ?? '#14b8a6')),
            userEditedSlug: false,

            init() {
                // detecta edição manual do slug
                this.$watch('slug', (val, old) => {
                    if (val !== this.slugify(this.name)) {
                        this.userEditedSlug = true;
                    }
                });
            },

            maybeGenerateSlug() {
                if (!this.userEditedSlug) {
                    this.slug = this.slugify(this.name);
                }
            },

            slugify(value) {
                return (value || '')
                    .toString()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            },

            syncHexFromPicker() {
                // garante formato #RRGGBB
                this.color = this.normalizeToHex(this.color);
            },

            normalizeHex() {
                this.color = this.normalizeToHex(this.color);
            },

            normalizeToHex(val) {
                let v = (val || '').toString().trim();
                if (!v.startsWith('#')) v = '#' + v;
                if (/^#([0-9a-fA-F]{3})$/.test(v)) {
                    // expande #abc -> #aabbcc
                    v = v.replace(/^#([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])$/, (m, r, g, b) => `#${r}${r}${g}${g}${b}${b}`);
                }
                if (!/^#([0-9a-fA-F]{6})$/.test(v)) {
                    // fallback se inválido
                    v = '#14b8a6';
                }
                return v.toLowerCase();
            },
        }))
    })
</script>
