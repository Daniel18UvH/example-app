<div class="p-6">
    @php
        $isAdmin = in_array(auth()->user()->email, ['satafykerplay@gmail.com', 'admin@prueba.com']);
    @endphp

    <flux:header>
        <flux:heading size="xl" level="1">{{ __('Gestión de Empleados') }}</flux:heading>
        <flux:spacer />
        @if($isAdmin)
            <flux:button wire:click="create" variant="primary" icon="plus">
                {{ __('Nuevo Empleado') }}
            </flux:button>
        @endif
    </flux:header>

    <div class="mt-8 space-y-6">
        <flux:input 
            wire:model.live="search" 
            icon="magnifying-glass" 
            placeholder="Buscar por nombre, email o etiquetas..." 
        />

        @if (session()->has('message'))
            <flux:badge variant="success" size="lg" class="w-full justify-center">{{ session('message') }}</flux:badge>
        @endif
        @if (session()->has('error'))
            <flux:badge variant="danger" size="lg" class="w-full justify-center">{{ session('error') }}</flux:badge>
        @endif

        <flux:table>
            <flux:table.columns>
                <flux:table.column>{{ __('Nombre') }}</flux:table.column>
                <flux:table.column>{{ __('Puesto') }}</flux:table.column>
                <flux:table.column>{{ __('Cuenta') }}</flux:table.column>
                <flux:table.column>{{ __('Estado') }}</flux:table.column>
                <flux:table.column align="end">{{ __('Acciones') }}</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse($employees as $employee)
                    <flux:table.row :key="$employee->id">
                        <flux:table.cell class="font-medium">{{ $employee->full_name }}</flux:table.cell>
                        <flux:table.cell>{{ $employee->position }}</flux:table.cell>
                        <flux:table.cell>
                            @if(\App\Models\User::where('email', $employee->email)->exists())
                                <flux:badge color="zinc" size="sm" icon="check-circle">Activa</flux:badge>
                            @else
                                <flux:badge color="warning" size="sm" icon="x-circle">Pendiente</flux:badge>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge :color="$employee->status === 'Activo' ? 'success' : 'warning'" size="sm">
                                {{ $employee->status }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell align="end">
                            <flux:button.group>
                                <flux:button wire:click="show({{ $employee->id }})" variant="ghost" icon="eye" size="sm" />
                                @if($isAdmin)
                                    <flux:button wire:click="edit({{ $employee->id }})" variant="ghost" icon="pencil-square" size="sm" />
                                    <flux:button 
                                        wire:confirm="¿Seguro que quieres eliminar a este empleado y su cuenta de acceso?" 
                                        wire:click="delete({{ $employee->id }})" 
                                        variant="ghost" icon="trash" color="danger" size="sm" 
                                    />
                                @endif
                            </flux:button.group>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="5" class="text-center text-zinc-500 py-10 italic">
                            {{ __('No hay empleados registrados o no tienes permisos para verlos.') }}
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <flux:modal wire:model="isOpen" class="min-w-[30rem]">
        <div class="space-y-6">
            <flux:heading size="lg">{{ $isViewing ? 'Ver Detalle' : 'Formulario de Empleado' }}</flux:heading>
            
            <div class="grid grid-cols-2 gap-4">
                <flux:input label="Nombre" wire:model="full_name" :disabled="$isViewing" />
                <flux:input label="Email" wire:model="email" type="email" :disabled="$isViewing" />
                <flux:input label="Puesto" wire:model="position" :disabled="$isViewing" />
                <flux:input label="Etiquetas" placeholder="Ej: Ventas, Remoto" wire:model="tags" :disabled="$isViewing" />
                <flux:input label="Teléfono" wire:model="phone" :disabled="$isViewing" />
                <flux:select label="Estado" wire:model="status" :disabled="$isViewing">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </flux:select>
            </div>

            <div class="flex gap-2 justify-end">
                <flux:button wire:click="closeModal" variant="ghost">Cerrar</flux:button>
                @if(!$isViewing && $isAdmin)
                    <flux:button wire:click="store" variant="primary">Guardar</flux:button>
                @endif
            </div>
        </div>
    </flux:modal>
</div>