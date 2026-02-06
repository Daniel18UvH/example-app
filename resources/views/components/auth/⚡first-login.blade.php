<div class="flex flex-col gap-6">
    <flux:header>
        <flux:heading size="xl">{{ __('¡Bienvenido a Inteligreen!') }}</flux:heading>
        <flux:subheading>{{ __('Por seguridad, debes cambiar tu contraseña temporal antes de continuar.') }}</flux:subheading>
    </flux:header>

    <form wire:submit="updatePassword" class="flex flex-col gap-6">
        <flux:input 
            wire:model="password" 
            label="Nueva Contraseña" 
            type="password" 
            viewable 
            required 
        />
        
        <flux:input 
            wire:model="password_confirmation" 
            label="Confirmar Contraseña" 
            type="password" 
            viewable 
            required 
        />

        <flux:button type="submit" variant="primary" class="w-full">
            {{ __('Actualizar y Entrar') }}
        </flux:button>
    </form>
</div>