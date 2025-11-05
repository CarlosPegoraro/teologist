<x-layouts.app :title="'Usuários & Cargos'">
    <section class="py-16 md:py-24 bg-background/70">
        <div class="container mx-auto px-6 max-w-6xl">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-2 md:flex-row md:items-end md:justify-between">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold font-serif text-foreground">Usuários</h1>
                    <p class="mt-2 text-sm text-muted-foreground">Gerencie o cargo (role) de cada usuário.</p>
                </div>
            </div>

            {{-- Alerts --}}
            @if(session('success'))
                <div class="mb-6 rounded-lg border border-emerald-500/30 bg-emerald-500/10 p-4 text-sm text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-destructive/40 bg-destructive/10 p-4 text-sm text-destructive">
                    <p class="font-semibold mb-2">Corrija os erros abaixo:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tabela --}}
            <div class="overflow-hidden rounded-xl border border-border bg-card/50 backdrop-blur-sm">
                <table class="min-w-full divide-y divide-border">
                    <thead>
                    <tr class="text-left text-sm text-muted-foreground">
                        <th class="px-4 py-3 font-medium">Usuário</th>
                        <th class="px-4 py-3 font-medium hidden md:table-cell">E-mail</th>
                        <th class="px-4 py-3 font-medium">Cargo atual</th>
                        <th class="px-4 py-3 font-medium text-right">Ação</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                    @forelse($users as $user)
                        @php
                            $currentRole = $user->roles->pluck('name')->first(); // um cargo por vez
                            $availableRoles = $roles->where('guard_name', $user->guard_name ?? 'web');
                        @endphp
                        <tr x-data>
                            <td class="px-4 py-3">
                                <div class="font-medium text-foreground">{{ $user->name }}</div>
                                <div class="text-xs text-muted-foreground md:hidden">{{ $user->email }}</div>
                            </td>

                            <td class="px-4 py-3 hidden md:table-cell text-sm text-muted-foreground">
                                {{ $user->email }}
                            </td>

                            <td class="px-4 py-3">
                                <form
                                    action="{{ route('admin.users.update', $user) }}"
                                    method="POST"
                                    x-data="{ changed: false }"
                                    class="flex items-center gap-2"
                                >
                                    @csrf
                                    @method('PUT')

                                    <select
                                        name="role"
                                        class="block w-56 border border-border text-accent rounded-md py-2 px-3 focus:ring-2 focus:ring-inset focus:ring-teal-500"
                                        @change="changed = true"
                                    >
                                        <option value="" disabled {{ $currentRole ? '' : 'selected' }}>
                                            Selecione um cargo…
                                        </option>

                                        @foreach($availableRoles as $role)
                                            <option value="{{ $role->name }}" @selected($currentRole === $role->name)>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit"
                                            :disabled="!changed"
                                            class="inline-flex items-center justify-center h-9 px-3 rounded-md border border-border bg-card/60 hover:bg-card text-foreground text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                                        Atualizar
                                    </button>
                                </form>
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end">
                                    @if($currentRole)
                                        <span class="inline-flex items-center rounded-full border border-border px-2 py-0.5 text-xs">
                                                {{ $currentRole }}
                                            </span>
                                    @else
                                        <span class="text-xs text-muted-foreground">Sem cargo</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-sm text-muted-foreground">
                                Nenhum usuário encontrado.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginação --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </section>
</x-layouts.app>
