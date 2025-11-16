<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Novo Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-10">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if ($errors->any())
                            <div class="mb-4">
                                <div class="font-medium text-red-600">{{ __('Whoops! Algo deu errado.') }}</div>

                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Título -->
                        <div class="mb-4">
                            <label for="title"
                                   class="block text-sm font-medium text-gray-700 dark:text-gray-300">Título</label>
                            <input type="text" name="title" id="title"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 p-3"
                                   required>
                            @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Subtítulo -->
                        <div class="mb-4">
                            <label for="subtitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subtítulo</label>
                            <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 p-3">
                            @error('subtitle')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="subtitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Conteudo
                            </label>

                            <div class="section-item bg-gray-50 dark:bg-gray-900 p-4" id="contentEditor"></div>

                            <input type="hidden" name="content" id="content"
                                   value="{{ old('content', $post->content ?? '') }}"/>

                            @error('subtitle')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Thumbnail -->
                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Imagem
                                de Capa (Thumbnail)</label>
                            <input type="file" name="thumbnail" id="thumbnail"
                                   class="mt-1 block w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-300 dark:hover:file:bg-indigo-800 p-3">
                            @error('thumbnail')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Autor -->
                        <div class="mb-4">
                            <label for="author_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Autor</label>
                            <select name="author_id" id="author_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 p-3"
                                    required>
                                <option value="">Selecione um autor</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Categorias -->
                        <div class="mb-6">
                            <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categorias</label>
                            <select name="categories[]" id="categories" multiple
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-900 dark:border-gray-600 dark:text-gray-300 p-3">
                                @foreach($categories as $category)
                                    <option class="border-b-1 py-2 border-neutral-200"
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-500 mt-1">Segure Ctrl (ou Cmd no Mac) para selecionar mais de
                                uma.</p>
                            @error('categories')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botão de Envio -->
                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.blogs.index') }}"
                               class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mr-4">
                                Cancelar
                            </a>
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Salvar Blog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<script>
    (function () {
        const quill = new Quill('#contentEditor', {
            debug: 'info',
            modules: {toolbar: true},
            placeholder: 'Escreva seu texto...',
            theme: 'snow'
        });

        const hiddenInput = document.getElementById('content');
        const parentForm = document.getElementById('contentEditor')?.closest('form');

        const initial = (hiddenInput?.value || '').trim();
        if (initial) {
            try {
                const maybeDelta = JSON.parse(initial);
                quill.setContents(maybeDelta); // Delta
            } catch (e) {
                // HTML
                quill.clipboard.dangerouslyPasteHTML(initial);
            }
        }

        function syncAsDelta() {
            const delta = quill.getContents();
            hiddenInput.value = JSON.stringify(delta);
        }

        const sync = syncAsDelta;

        let t;
        quill.on('text-change', function () {
            clearTimeout(t);
            t = setTimeout(sync, 150);
        });

        if (parentForm) {
            parentForm.addEventListener('submit', function () {
                sync();
            });
        }
    })();
</script>
