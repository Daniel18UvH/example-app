<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 p-6 flex flex-col justify-center dark:border-neutral-700">
                <p class="text-sm font-medium text-neutral-500">Total Clientes</p>
                <p class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">
                    {{ $totalClients }}
                </p>
                <div class="absolute right-4 top-4 opacity-10">
                    <flux:icon.users class="size-12" />
                </div>
            </div>

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 p-6 flex flex-col justify-center dark:border-neutral-700">
                <p class="text-sm font-medium text-neutral-500">Usuarios Activos</p>
                <p class="mt-2 text-4xl font-bold text-neutral-900 dark:text-white">
                    {{ $activeProjects }}
                </p>
            </div>

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800/50">
                <flux:button href="{{ route('clients.create') }}" icon="plus" variant="primary">
                    Registrar Cliente
                </flux:button>
            </div>
        </div>

        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="flex h-full flex-col">
                <div class="border-b border-neutral-200 px-6 py-4 dark:border-neutral-700">
                    <h3 class="font-bold text-neutral-900 dark:text-white">Últimos Registros</h3>
                </div>

                <div class="flex-1 overflow-auto p-0">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-neutral-50 text-neutral-500 dark:bg-neutral-800">
                            <tr>
                                <th class="px-6 py-3 font-medium">Nombre</th>
                                <th class="px-6 py-3 font-medium">Empresa</th>
                                <th class="px-6 py-3 font-medium">Estado</th>
                                <th class="px-6 py-3 font-medium text-right">Fecha</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                            @forelse($recentClients as $client)
                                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition-colors">
                                    <td class="px-6 py-3 font-medium text-neutral-900 dark:text-white">
                                        {{ $client->name }}
                                    </td>
                                    <td class="px-6 py-3 text-neutral-500">
                                        {{ $client->company ?? 'Particular' }}
                                    </td>
                                    <td class="px-6 py-3">
                                        <flux:badge size="sm" :color="$client->status === 'Activo' ? 'green' : 'zinc'">
                                            {{ $client->status }}
                                        </flux:badge>
                                    </td>
                                    <td class="px-6 py-3 text-right text-neutral-400">
                                        {{ $client->created_at->format('d M') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-neutral-400">
                                        No hay clientes registrados aún.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts::app>
