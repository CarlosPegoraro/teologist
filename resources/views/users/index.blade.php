<x-layouts.app :title="'Gerenciamento de Usuários'">
    <section class="relative bg-background text-foreground py-20 md:py-24 overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold font-serif">Gerenciamento de Usuários</h1>
            <p class="text-lg text-gray-300 mt-2">Atribua e gerencie os cargos dos usuários da plataforma.</p>
        </div>
    </section>

    <main class="py-16 bg-background/70">
        <div class="container mx-auto px-6">
            @if (session('success'))
                <div class="bg-primary/10 text-teal-300 border border-teal-500/20 p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-card/50 backdrop-blur-sm rounded-xl border border-border/50 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-card/60">
                    <tr>
                        <th scope="col" class="py-3.5 px-4 text-left text-sm font-semibold text-foreground">Nome</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-foreground">Email</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-foreground">Cargo Atual</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-foreground">Alterar Cargo</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                    @foreach ($users as $user)
                        <tr>
                            <td class="whitespace-nowrap py-4 px-4 text-sm font-medium text-foreground">{{ $user->name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">{{ $user->email }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                    <span class="inline-flex items-center rounded-md bg-gray-700 px-2 py-1 text-xs font-medium text-gray-300">
                                        {{ $user->getRoleNames()->first() ?? 'N/A' }}
                                    </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" class="block w-full max-w-xs bg-background/50 border-gray-600 rounded-md py-1.5 px-2 text-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500 sm:text-sm transition">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" @selected($user->hasRole($role->name))>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="group inline-flex items-center justify-center bg-teal-600 hover:bg-teal-700 text-foreground font-semibold px-3 h-8 rounded-md text-xs transition-all">Salvar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>
        </div>
    </main>
</x-layouts.app>
