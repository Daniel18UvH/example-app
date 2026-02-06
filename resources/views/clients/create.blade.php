<x-layouts::app :title="__('Nuevo Cliente')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-neutral-900 dark:text-white">Registrar Nuevo Cliente</h1>
                <p class="text-sm text-neutral-500">Ingresa los datos para dar de alta en el CRM.</p>
            </div>
            <flux:button href="{{ route('dashboard') }}" variant="subtle">
                Cancelar
            </flux:button>
        </div>

        <div class="w-full max-w-2xl rounded-xl border border-neutral-200 bg-white p-6 dark:border-neutral-700 dark:bg-[#1C1C1E]">
            <form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
                @csrf <flux:field>
                    <flux:label>Nombre del Cliente</flux:label>
                    <flux:input name="name" type="text" placeholder="Ej. Juan Pérez" required />
                    <flux:error name="name" />
                </flux:field>

                <flux:field>
                    <flux:label>Empresa (Opcional)</flux:label>
                    <flux:input name="company" type="text" placeholder="Ej. Industrias Solares SA" />
                    <flux:error name="company" />
                </flux:field>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <flux:field>
                        <flux:label>Correo Electrónico</flux:label>
                        <flux:input name="email" type="email" placeholder="cliente@ejemplo.com" />
                        <flux:error name="email" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Teléfono</flux:label>
                        <flux:input name="phone" type="tel" placeholder="555-000-0000" />
                        <flux:error name="phone" />
                    </flux:field>
                </div>

                <div class="flex justify-end pt-4">
                    <flux:button type="submit" variant="primary">Guardar Cliente</flux:button>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>
